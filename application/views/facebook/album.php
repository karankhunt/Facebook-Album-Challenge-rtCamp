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
    <header class="header">
        <div class="container">
            <div class="profile-section">
                <div class="profile-img"><img src="<?php echo $_SESSION["picture"] ?>" alt="profilepicture"/></div>
                <div class="profile-name"><?php echo $_SESSION["name"] ?> </div> 
                <div class="logout" style="margin-left: 10px;align-self: center;"> 
                    <a class="" href="<?php echo base_url('FacebookApi/logout') ?>" style="color:#fff;text-decoration: none;font-weight: bold;">Logout</a>
                </div>
            </div>
        </div>
    </header>

    
    <section class="gallary-section">
    <div class="container">
        <div class="gallary-row">
            <?php foreach($album["data"] as $img) { ?>

                    <div class="gallary-col">
                        <div class="gallary-img-div">
                            <img src='<?php print_r($img["source"]); ?>' alt="gallary img">
                            
                            
                        </div>
                    </div>                  
                <?php } ?>
            
        </div>
    </div>
</section>


    <!-- <div class="container">
        <div class="containerHeader">
            <?php echo $_GET['albumName']; ?> ALBUM
        </div>
        <div class="gridContainer">
            <?php foreach($album["data"] as $img) { ?>                
                <div class="gridItem">
                    <div class="image" style="background-image: url('<?php print_r($img["source"]); ?>'); border-radius: 0.5rem;" >                                       
                    </div>                               
                </div>
            <?php } ?> 
        </div>
    </div> -->

    <!-- <div class="imageModal">
        <center>
            <img src="" alt="">
        </center>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

    <script>
        var baseUrl = "<?= base_url('FacebookApi') ?>";       
    </script>
    <script src="<?php echo base_url('assets/js/myScript.js') ?>" ></script>    
</body>
</html>
