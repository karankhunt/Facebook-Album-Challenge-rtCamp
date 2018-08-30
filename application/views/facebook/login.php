<?php
/**
 * PHP version 7.1
 * Facebook PHP SDK for CodeIgniter 3
 *
 * Library wrapper for Facebook PHP SDK. Check user login status, publish to feed
 * and more with easy to use CodeIgniter syntax.
 *
 * This library requires the Facebook PHP SDK to be installed with Composer, and that CodeIgniter
 * config is set to autoload the vendor folder. More information in the CodeIgniter user guide at
 * http://www.codeigniter.com/userguide3/general/autoloader.html?highlight=composer
 *
 * It also requires CodeIgniter session library to be correctly configured.
 *
 * @category Libraries
 * @package  CodeIgniter
 * @author   Mattias Hedman <username@example.com>
 * @license  https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt MIT 
 * @version  CVS: <3.3.1>
 * @link     https://github.com/darkwhispering/facebook-sdk-codeigniter
 */
if ($this->facebook->is_authenticated()) {
	header('location: https://rtcampkaran.myfoodstore.in/facebookApi/albums');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facebook Album Challenge - rtCamp | Login</title>
    <link rel="icon" href="<?php echo base_url('assets/images/rtcamp.png') ?>" sizes="192x192" />    
    <link href="<?php echo base_url('assets/css/style.css')?>" rel = "stylesheet" type = "text/css"  />    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="loginbody">
    <div class="login-container">
        <div class="login-box">
            <div class="lock-img">
                <div class="box-img pulse">
                    <img src="https://www.freeiconspng.com/uploads/lock-icon-png-10.png" alt="">
                </div>
            </div>
            <div class="info">
                <ul>
                    <li><i class="fa fa-circle"></i> Login using Facebook.</li>
                    <li><i class="fa fa-circle"></i> See the FaceBook Album Images.</li>
                    <li><i class="fa fa-circle"></i> View the FaceBook Album Images into SlideShow.</li>
                    <li><i class="fa fa-circle"></i> Download the Facebook Albums.</li>
                    <li><i class="fa fa-circle"></i> Move Albums to the Google Drive.</li>
                </ul>                
            </div>
            <div class="button">
                <?php if ( ! $this->facebook->is_authenticated()) { ?>
                <a href="<?php echo $this->facebook->login_url(); ?>"><i class="fa fa-facebook" aria-hidden="true"></i> Login With Facebook </a>
                <?php } ?>
                <a href="https://rtcampkaran.myfoodstore.in/policy.html" target="_blank">Privacy Policy</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
</body>
</html>