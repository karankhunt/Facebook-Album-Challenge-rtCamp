$(document).ready(function(){
       
    var container = $('.container').offset().top;
    var headerProfile = true;
    
    $(window).scroll(function() { //when window is scrolled
        if(container > (container - $(window).scrollTop()))
        {
            if(headerProfile) {
                $(".profile > .profileImage").css({"left":"0vw"}).find("img");
                $(".profile > .profileName").css({"padding":".625rem 10rem"});
                $(".header").css({"background-color":"rgba(0, 0, 0, 0.7)"});
                $(".menu > ul > li").css({"background-color":"rgba(0, 0, 0, 0.7)"});
                setTimeout(function(){ 
                    $(".profile > .profileImage").css({"top":"0vw"}).find("img").css({"width":"8vw","height":"8vw"});
                }, 1000); 
                headerProfile = false;
            }
        } else {
            if(!headerProfile) {
                $(".profile > .profileImage").css({"top":"15vh"}).find("img").css({"width":"14vw","height":"14vw"});            
                $(".profile > .profileName").css({"padding":".625rem 0rem"});
                $(".header").css({"background-color":"rgba(0, 0, 0, 0.3)"});
                $(".menu > ul > li").css({"background-color":"rgba(0, 0, 0, 0.3)"});
                setTimeout(function(){                 
                    $(".profile > .profileImage").css({"left":"38vw"}).find("img");
                }, 1000); 
                headerProfile = true;
            }
        }
    });

    $(".gallary-row").on("click", "label", function() {
        if($(this).find("input[type='checkbox']").prop("checked") == true) {
            $(this).find("i").removeClass("fa fa-square-o");
            $(this).find("i").addClass("fa fa-check-square-o");
        } else {
            $(this).find("i").removeClass("fa fa-check-square-o");
            $(this).find("i").addClass("fa fa-square-o");
        }
    });

    
    $(".gallary-row").on("click", "i.downloadAlbum", function(){

        // alert(user_Id);
        var dataUrl = baseUrl+"/download?"+$(this).attr("data-url");

        var params = (new URL(dataUrl)).searchParams;
        var albumname = params.get('albumName');

        progressBar();
        $.ajax({
            url: dataUrl,
            type: "GET",
            success:function(dd){
                $(".download-link").html("");
                 $(".download-link").append("<a href='https://rtcampkaran.myfoodstore.in/assets/download/"+user_Id+"/"+albumname+".zip' onclick='closeDownload();'>Download</a>")
            }
        });    
    });

    $(".menu").on("click", "a.downloadSelectedAlbum", function(){
        downloadSelectedAlbums(); 
    });

    $(".menu").on("click", "a.downloadAllAlbum", function(){        
        $(".container .gallary-img-name > label > input[type='checkbox']").prop("checked", true);
        downloadSelectedAlbums();
    });

    $(".container > .grid-container").on("click", ".grid-item", function() {
        var imgUrl = $(this).css("background-image").trim();
        imgUrl = imgUrl.substring(5, imgUrl.length - 2);   
        // $(".imageModal").css({"opacity": '1'});     
        // $(".imageModal").animate({height: $(".imageModal > center > img").height}, 1000 );
        $(".imageModal > center > img").attr("src", imgUrl);
    });

});


function downloadSelectedAlbums() {
    var dataUrl = baseUrl+"/downloadSelected";
    var selectedAlbums = [];

    $(".container .gallary-img-name > label").find("input:checked").each(function (i, ob) { 
        var album = {
            "id": $(ob).val(),
            "name" : $(ob).attr("data-album-name")
        };
        selectedAlbums.push(album);
    });

    $(".container .gallary-img-name > label > input[type='checkbox']").prop("checked", false);
    $(".container .gallary-img-name > label > input[type='checkbox']").siblings("i").removeClass("fa fa-check-square-o");
    $(".container .gallary-img-name > label > input[type='checkbox']").siblings("i").addClass("fa fa-square-o");

    progressBar();
    $.ajax({
        url: dataUrl,
        type: "POST",
        data : { "selectedAlbums" : selectedAlbums },
            success:function(dd){
                document.getElementById("zip-link").style.display = "block";
                 $(".download-link").append("<a href='https://rtcampkaran.myfoodstore.in/assets/download/"+user_Id+"/selectedAlbums.zip' onclick='closeDownload();'>Download</a>")
            }
    }); 
}





function openslider(id,name)
{
    // alert(id + name);
    document.getElementById("slider").style.display = "block";

    var dataUrl = baseUrl+"/albumPlay?albumId="+id;
    
   $.ajax({
        url: dataUrl,
        type: "GET",
        success: function(data){
            $(".sider").html("");
            
            data = JSON.parse(data);
            for(i=0; i<data.length; i++)
            {
                $(".sider").append('<div class="side" ><img src="'+data[i]["source"]+'"></div>')
            }
            

            total = (document.getElementById("sider").childElementCount*100);
            document.getElementById("sider").style.width = (total+5)+"vw";
            
            

        }
    });

}

function closeslider()
{
    document.getElementById("slider").style.display = "none";   
}


var playSide;
var playFlag = true;   
var left = 0; 
var total;
function playSider(event) {

    if(playFlag) {
        event.target.classList.remove("fa-play");   
        event.target.classList.add("fa-pause");   
        playSide = setInterval(function(){ 
            left += 100;        
            if (left==total) {
                left = 0;
            }
            side();        
        }, 2000);   
        playFlag = false; 
    } else {
        clearInterval(playSide);  
        event.target.classList.remove("fa-pause");   
        event.target.classList.add("fa-play");   
        playFlag = true;
    }
}

function nextSide() {  
    clearInterval(playSide);  
    left += 100;    
    if (left==total) {
        left = 0;
    }
    side();    
}

function prevSide() {
    clearInterval(playSide);
    if (left==0) {
        left = total-100;
    }
    else
    {
        left -= 100;   
    }
    side();    
    
}

function side(){
    document.getElementById("sider").style.marginLeft = "-"+left+"vw";    
}
function closeDownload(){
    document.getElementById("zip-link").style.display = "none";
}
function progressBar(){
    document.getElementById("zip-link").style.display = "block";
        var c=1; 
        var id = setInterval(fill,20);
        function fill(){
            if(c >= 100)
            {   
                c=1;
                document.getElementById("fill-up").style.width = c+"%";
            }
            else{
                c++;
                document.getElementById("fill-up").style.width = c+"%";    
            }
        }
}