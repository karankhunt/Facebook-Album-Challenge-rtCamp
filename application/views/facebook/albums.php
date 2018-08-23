<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- <link href="<?php echo base_url('assets/css/myStyle.css') ?>" rel = "stylesheet" type = "text/css"  /> -->
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel = "stylesheet" type = "text/css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="header-fixed">
        <header class="header">
            <div class="container">
                <div class="profile-section">
                    <div class="profile-img">
                        <img src="<?php echo $_SESSION["picture"] ?>" alt="profilepicture"/>
                    </div>
                    <div class="profile-name"><?php echo $_SESSION["name"] ?> </div> 
                    <div class="logout" style="margin-left: 20px;align-self: center;"> 
                        <a class="" href="<?php echo base_url('FacebookApi/logout') ?>" style="color:#fff;text-decoration: none;font-weight: bold;">Logout <i class="fa fa-sign-out"></i> </a>
                    </div>
                </div>
            </div>
        </header>
        <header class="menu" style="margin-bottom: 100px;">
            <div class="container">
                <div class="menu-list">
                    <ul>
                        <li>
                            <a href="javascript:;" title="Download Selected Albums" class="downloadSelectedAlbum">
                                <i class="fa fa-download"></i> Selected Download
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" title="Download All Albums" class="downloadAllAlbum">
                                <i class="fa fa-download"></i> All Download
                            </a>
                        </li>
                        <li>
                            <a  href="javascript:;" title="Backup Selected Albums">
                                <i class="fa fa-google"></i> Selected Move
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" title="Backup All Albums">
                                <i class="fa fa-download"></i> All Move
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div style="clear: both;"></div>    
    </div>


    <div style="clear: both;"></div>

    
    

<section class="gallary-section">
    <div class="container">
        <div class="gallary-row">
            <?php foreach($albums["albums"]["data"] as $album) { ?> 
                <?php if($album["count"] != 0) { ?>  
                    <div class="gallary-col">
                        <div class="gallary-img-div">
                            <img src='<?php print_r($album["picture"]["data"]["url"]); ?>' alt="gallary img">
                            <div class="gallary-img-name">
                                <label>
                                    <input type="checkbox" name="selectedAlbums[]" value="<?php echo $album['id']; ?>" data-album-name="<?php echo $album["name"] ?>" > 
                                    <i class="fa fa-square-o" aria-hidden="true" style="font-size:20px;vertical-align: middle;"></i>
                                <?php print_r($album["name"].' ('.$album["count"].')'); ?>
                                </label>
                            </div>
                            <div class="gallary-icon-view">
                                <a href="<?php echo base_url('FacebookApi/googleDrive?albumId='.$album['id'].'&albumName='.$album['name'])?>">                              
                                    <i class="fa fa-google" title="Move to Google Drive"></i>    
                                </a>
                                
                            </div>
                            <div class="gallary-icon-view gallary-icon-view-2">
                                <a href="<?php echo base_url('FacebookApi/album?albumId='.$album['id'].'&albumName='.$album['name'])?>"><i class="fa fa-file-image-o" title="Show Album Images"></i></a>
                            </div>
                            <div class="gallary-icon-view gallary-icon-view-3" onclick="openslider('<?php echo $album['id'] ?>','<?php echo $album['name'] ?>');">
                                <i class="fa fa-play" title="Album SlideShow"></i>
                            </div>
                            <div class="gallary-icon-view gallary-icon-view-4">

                                <i class="fa fa-download downloadAlbum"  data-url="<?php echo 'albumId='.$album['id'].'&albumName='.$album["name"]; ?>" title="Download this Album" ></i>
                                
                            </div>
                        </div>
                    </div>                  
                <?php } ?>
            <?php } ?> 
        </div>
    </div>
</section>

<div class="slider" id="slider">
    
    <div class="closebtn">
        <font style="color:#fff;" onclick="closeslider();"><i class="fa fa-close"></i></font>
    </div>

    <div class="subslider" id="">
            <div class="left-side arrow" onclick="prevSide();"></div>
            <div class="playbtn" ><i class="fa fa-play" onclick="playSider(event);"></i></div>
            <div class="sider" id="sider" > 
                
            </div>
            <div class="right-side arrow" onclick="nextSide();"></div>
    </div>
</div>

<div class="zip-link" id="zip-link">
    <div class="zip-download">
        <div align="right">
            <i class="fa fa-close" onclick="closeDownload();"></i>
        </div>
        <div>
            <h2>Download Link</h2>
        </div>
        <hr>
        <br>
        <div class="download-link" >
              <div class="progress-bar">
                  <div class="fill-up" id="fill-up">
                      
                  </div>
              </div>
        </div>
        
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

    <script>
        var baseUrl = "<?= base_url('FacebookApi') ?>";   
        var user_Id = "<?php echo $_SESSION['userId']; ?>";    
    </script>
    <script src="<?php echo base_url('assets/js/myScript.js') ?>" ></script>    
</body>
</html>