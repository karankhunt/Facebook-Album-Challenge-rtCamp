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
    <div class="img-preview-slide" id="img-preview-slide">
        <div class="img-preview-box" id="img-preview-box">
            <div style="margin-bottom:10px;">
                <i class="fa fa-close" style="color:#333;padding:5px 7px;font-size:20px;border:2px #fff solid;border-radius:100%;background:#fff;" onclick="closePreview();"></i>
            </div>
            <div id="img-preview">
            
            </div>

        </div>
    </div>

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
        <header class="menu">
            <div class="container">
                <div class="menu-list">
                    <ul>
                        <li>
                            <a href="https://rtcampkaran.myfoodstore.in/FacebookApi/albums/" title="Go Back" class="downloadSelectedAlbum" >
                                <i class="fa fa-arrow-left"></i> Go Back
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </header>
        <div style="clear: both;"></div>    
    </div>

    
    <section class="gallary-section">
    <div class="container">
        <div class="gallary-row">
            <?php foreach ($album["photos"]["data"] as $img) { ?>

                    <div class="gallary-col" onclick="displayPreview('<?php print_r($img["images"][0]["source"]); ?>');">
                        <div class="gallary-img-div">
                            <img src='<?php print_r($img["images"][0]["source"]); ?>' alt="gallary img">
                            
                            
                        </div>
                    </div>                  
                <?php } ?>
            
        </div>
    </div>
</section>






    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

    <script>
        var baseUrl = "<?= base_url('FacebookApi') ?>";       
    </script>
    <script src="<?php echo base_url('assets/js/myScript.js') ?>" ></script>    
</body>
</html>
