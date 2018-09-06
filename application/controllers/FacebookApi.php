<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacebookApi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('zip');
		$this->load->model("FacebbokApiModel", "api");


	}
	public function index()
	{
		$this->load->view('facebook/login'); // Login View
	}
	public function albums()
	{
		//$data['albums'] = $this->api->getFacebookData('/me?fields=id,name,birthday,gender,age_range,picture.height(500).width(500),albums{count,name,picture}'); //GET the Facebook Data (userid,name,birthday,age,profile pic, album Image,album Name)

		$data['albums'] = $this->api->getFacebookData('me?fields=id,name,birthday,gender,age_range,picture.height(500).width(500),albums.fields(id,name,count,cover_photo{images{source}})');
		$_SESSION["userId"] = $data["albums"]["id"];
		$_SESSION["name"] = $data["albums"]["name"];
		$_SESSION["picture"] = $data["albums"]["picture"]["data"]["url"];			
		$this->load->view('facebook/albums', $data);
	}
	public function album()
	{
		$data['album'] = $this->api->getFacebookData("/{$_GET['albumId']}?fields=photos{images{source}}"); // GET the Album Images of the Particular Album.
		$this->load->view('facebook/album', $data);
	}
	public function albumPlay()
	{
		$data['album'] = $this->api->getFacebookData("/{$_GET['albumId']}/photos?fields=source"); // GET the Album Images of the Particular Album For Play the Slideshow.		
		print_r(json_encode($data['album']['data']));
	}
	public function download()
	{
		$zip = new ZipArchive;
		$userId = $_SESSION["userId"];
		$data['album'] = $this->api->getFacebookData("/{$_GET['albumId']}?fields=photos{images{source}}");
		// echo "<pre>";
		// print_r($data['album']);
		// die();
		$userPath = "./assets/download/{$userId}/";			
		$path = "{$userPath}{$_GET['albumName']}.zip";
		
		if(!is_dir($userPath)){
			mkdir($userPath);
		}		
		
		if ($zip->open($path, ZipArchive::CREATE)) {			
			foreach ($data["album"]["photos"]["data"] as $index => $img) {
				$image = "{$img['id']}.jpg";

				$downloadFile = file_get_contents($img["images"][0]["source"]);
				$zip->addFromString($image, $downloadFile);				
			}
			$zip->close();	
		}
		
		echo $path;		
	}

	public function downloadSelected()
	{
		$zip = new ZipArchive;
		$userId = $_SESSION["userId"];

		$userPath = "./assets/download/{$userId}/";		
		$path = "{$userPath}selectedAlbums.zip";		
		
		if(!is_dir($userPath)){
			mkdir($userPath);							
		}		
		
		if ($zip->open($path, ZipArchive::CREATE)) {
			foreach ($_POST["selectedAlbums"] as $key => $value) {								
				$data['album'] = $this->api->getFacebookData("/{$value['id']}?fields=photos{images{source}}");	
						
				foreach ($data["album"]["photos"]["data"] as $index => $img) {
					$image = "{$value['name']}/{$img['id']}.jpg";
					
					$downloadFile = file_get_contents($img["images"][0]["source"]);
					$zip->addFromString($image, $downloadFile);					
				}
			}			
			$zip->close();	
		}	

		echo $path;	
	}
	public function getClient()
	{
		$client = new Google_Client();
		$client->setAuthConfig('client_secrets.json');
		$client->addScope(array('https://www.googleapis.com/auth/drive.readonly', 'https://www.googleapis.com/auth/drive.file','https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
		//add the Google Scope for moving Album to the google drive.
		return $client;
	}
	public function createClient()
	{
		$client = $this->getClient();
		if (isset($_SESSION['access_token'])) {
			$rootFolder = "facebook_{$_SESSION['name']}_albums";

			$client = $this->getClient();
			$client->setAccessToken($_SESSION['access_token']);    
			$service = new Google_Service_Drive($client);

			$optParams = array(
				'q' => "mimeType='application/vnd.google-apps.folder' and name='{$rootFolder}'"				
			);
			$results = $service->files->listFiles($optParams);
			
			if(count($results->getFiles())==0) {
				$fileMetadata = new Google_Service_Drive_DriveFile(array(
					'name' => $rootFolder,
					'mimeType' => 'application/vnd.google-apps.folder'));
				$file = $service->files->create($fileMetadata, array(
					'fields' => 'id'));				
				$_SESSION['rootFolderId'] = $file->id;							
			} else {				
				$_SESSION['rootFolderId'] = $results->getFiles()[0]["id"];
			}
			header('Location: '.base_url().'FacebookApi/googleDrive');		
		} else {				
			$redirect_uri = base_url().'FacebookApi/varifyClient';			
			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));	
		}
	}
	public function varifyClient()
	{
		$client = $this->getClient();
		$client->setRedirectUri(base_url().'FacebookApi/varifyClient'); 		
		if (! isset($_GET['code'])) {
			$auth_url = $client->createAuthUrl();
			header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
		} else {
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			$redirect_uri = base_url().'FacebookApi/createClient';
			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}
	}
	public function googleDrive()
	{               
		if (!isset($_SESSION["selectedAlbums"])) {
            if(isset($_POST["selectedAlbums"])) {
                $selectedAlbumPost = [];
                foreach ($_POST["selectedAlbums"] as $value) {
                    $idName = explode("~/~", $value);
                    $post = array(
                        "id"=>$idName[0],
                        "name"=>$idName[1]
                    );
                    $selectedAlbumPost[] = $post; 
                }
                $_SESSION["selectedAlbums"] = $selectedAlbumPost;
            } else if(isset($_GET["albumId"]) && isset($_GET["albumName"])) {
                $_SESSION["selectedAlbums"][] = array( "id"=>$_GET["albumId"], "name"=> $_GET["albumName"] );
            }
            print_r($_SESSION["selectedAlbums"]);
            	
			$this->createClient();		
		} else {
            $rootFolderId = $_SESSION['rootFolderId'];
            $selectedAlbums = $_SESSION["selectedAlbums"];

            $client = $this->getClient();
			$client->setAccessToken($_SESSION['access_token']);    
            $service = new Google_Service_Drive($client);
            
            foreach ($selectedAlbums as $selectedAlbum) {              
                
                $folder = $selectedAlbum['name'];
                $folderId = "";
                                
                $optParams = array(
                	'q' => "mimeType='application/vnd.google-apps.folder' and name='{$folder}' and '{$rootFolderId}' in parents"				
                );
                $results = $service->files->listFiles($optParams);
                
                if(count($results->getFiles())==0) {
                	$optParams = array(
                		'name' => $folder,
                		'mimeType' => 'application/vnd.google-apps.folder',
                		'parents' => array($rootFolderId)		
                	);
                	$fileMetadata = new Google_Service_Drive_DriveFile($optParams);

                	$file = $service->files->create($fileMetadata, array('fields' => 'id'));
                    
                	$folderId = $file->id;								
                } else {
                	$folderId = $results->getFiles()[0]["id"];					
                } 
				
				$data['album'] = $this->api->getFacebookData("/{$selectedAlbum['id']}?fields=photos{images{source}}");										
                
                foreach ($data["album"]["photos"]["data"] as $album) {

                	$optParams = array(
                		'q' => "mimeType='image/jpeg' and name='{$album['id']}.jpg' and '{$folderId}' in parents"				
                	);
                	$results = $service->files->listFiles($optParams);
                    
                	if(count($results->getFiles())==0) {
                		$fileMetadata = new Google_Service_Drive_DriveFile(array(
                			'name' => "{$album['id']}.jpg",
                			'parents' => array($folderId)
                		));
                		$content = file_get_contents($album["images"][0]["source"]);
                		$file = $service->files->create($fileMetadata, array(
                			'data' => $content,
                			'mimeType' => 'image/jpeg',
                			'uploadType' => 'multipart',
                			'fields' => 'id'));
                		// printf("File ID: %s <br/>", $file->id);
                	}				
                }
            }
            
            unset($_SESSION["selectedAlbums"]);
			$redirect_uri = base_url().'FacebookApi/albums';
			header('Location: ' . $redirect_uri);			
		}
	}
	public function moveAllToGoogle()
	{
		$albums = $this->api->getFacebookData('/me?fields=id,name,birthday,gender,age_range,picture.height(500).width(500),albums{count,name,picture}');
		foreach($albums["albums"]["data"] as $album)
		{
			echo $album["id"].",".$album["name"]."<br>";
			$this->googleDrive($album["id"],$album["name"]);
		}
	}
	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('FacebookApi', redirect);
	}
}
