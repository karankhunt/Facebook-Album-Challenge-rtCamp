var progressBarProcess=1;
$(document).ready(function() {
    // Change the Checkbox from check to uncheck and Reverse process
    $(".gallary-row").on("click", "label", function() {
        if($(this).find("input[type='checkbox']").prop("checked") == true) {
            $(this).find("i").removeClass("fa fa-square-o");
            $(this).find("i").addClass("fa fa-check-square-o");
        } else {
            $(this).find("i").removeClass("fa fa-check-square-o");
            $(this).find("i").addClass("fa fa-square-o");
        }
    });
});
function downloadSelectedAlbums() {

    progressBar();
    var dataUrl = baseUrl+"/downloadSelected"; //Download URL
    var selectedAlbums = [];
    $(".container .gallary-img-name > label").find("input:checked").each(function (i, ob) { 
        var idName = $(ob).val().split("~/~");
        var album = {
            "id": idName[0],
            "name" : idName[1]
        };
        selectedAlbums.push(album);
    });
    $(".container .gallary-img-name > label > input[type='checkbox']").prop("checked", false);
    $(".container .gallary-img-name > label > input[type='checkbox']").siblings("i").removeClass("fa fa-check-square-o");
    $(".container .gallary-img-name > label > input[type='checkbox']").siblings("i").addClass("fa fa-square-o");    
    $.ajax({
        url: dataUrl,
        type: "POST",
        data : { "selectedAlbums" : selectedAlbums },
            success:function(dd){
                document.getElementById("zip-link").style.display = "block";
                clearInterval(progressBarProcess);
                $("#fill-up").css("width","100%");
                $("#download-button > a").show();
                 $("#download-button > a").prop("href", "https://rtcampkaran.myfoodstore.in/assets/download/"+user_Id+"/selectedAlbums.zip");
            }
    }); 
}
function albumDownload(albumId,albumName, userId) {
    var dataUrl = baseUrl+"/download?albumId="+albumId+"&albumName="+albumName;    
    progressBar(); // Start the ProgressBar
    $.ajax({
        url: dataUrl,
        type: "GET",
        success:function(dd){
            clearInterval(progressBarProcess);
            $("#fill-up").css("width","100%");
            $("#download-button > a").show();             
             $("#download-button > a").prop("href", "https://rtcampkaran.myfoodstore.in/assets/download/"+userId+"/"+albumName+".zip"); // Append the Download link For Download
        }
    }); 
}
function openslider(id,name) {
    document.getElementById("slider").style.display = "block";  //Visible the Slider
    $("body").css({"overflow":"hidden"});
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
            // fill the Slider with Album Image
        }
    });
 
    // GoInFullscreen($("#slider").get(0));
    
}
function GoInFullscreen(element) {
    if(element.requestFullscreen)
        element.requestFullscreen();
    else if(element.mozRequestFullScreen)
        element.mozRequestFullScreen();
    else if(element.webkitRequestFullscreen)
        element.webkitRequestFullscreen();
    else if(element.msRequestFullscreen)
        element.msRequestFullscreen();
}

function closeslider() {
    document.getElementById("slider").style.display = "none";   
    $("body").css({"overflow":"auto"});
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
        }, 2000);   //Play the Slide show with 2 Second Delay
        playFlag = false; 
    } else {
        clearInterval(playSide);  //Stop the Slide show
        event.target.classList.remove("fa-pause");   
        event.target.classList.add("fa-play");   
        playFlag = true;
    }
}
function nextSide() {  
    clearInterval(playSide);  
    left += 100;    //Move to the Next Image Slide
    if (left==total) {
        left = 0;
    }
    side();    
}

function prevSide() {
    clearInterval(playSide);
    if (left==0) {
        left = total-100; //Move to the Last Image Slide
    }
    else
    {
        left -= 100;   //Move to the Previous Image Slide
    }
    side();        
}
function side() {
    document.getElementById("sider").style.marginLeft = "-"+left+"vw";   //Move to the According Event Image Slide 
}
function closeDownload() {    
    $("#zip-link").css("display","none"); //Hide the Download button
    $("#download-button > a").hide();
}
function progressBar() {
    document.getElementById("zip-link").style.display = "block"; //Display the ProgressBar
        var c=1; 
        progressBarProcess = setInterval(fill,20);
        function fill(){
            if(c >= 100)
            {   
                c=1;
                $("#fill-up").css("width",c+"%"); //Loop in the ProgressBar
            }
            else
            {
                c++;
                $("#fill-up").css("width",c+"%"); //Processing in the ProgressBar
            }
        }
}
function allAlbumDownload() {
    $(".container .gallary-img-name > label > input[type='checkbox']").prop("checked", true); // Checked All Albums for Download
    downloadSelectedAlbums(); // Download Selected Album
}

function moveAllAlbumtoDrive() {
    $(".container .gallary-img-name > label > input[type='checkbox']").prop("checked", true); // Checked All Checkbox For Move to Google Drive
    $('#albums').submit();  // Form submitted for moving to Google Drive
}