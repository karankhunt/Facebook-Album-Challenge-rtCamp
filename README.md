In that Web Application user Show the Album Image of their Facebook Application. First of they can Authenticate Facebook Login and then After they can show their Facebook Album Image on the Webpage and also see the Photos in the Slider, Download the Albums and move Albums to the Google Drive with Google Sign in option.

## Part 1:

User Login to the Website using Facebook credential. Asking for permission of name,email,photos. Application retrieve all the Album Image of the Login User.

Album's will be display with a thumbnail and name. whenever user click the thumbnai then Preview that Album Image in a Fullscreen Slideshow.

## Part 2:

A 'Download This Album' button is Putting on Every Album thumbnail whenever the User click on that button then in the background process all the Image of that album is Put on folder and create the zip of that Album with the name of Album name on a server.

As soon as user Click that button the progressbar will running while the process may take time for creating the Zip.

When the Zip is Creating then user will get the Link for Download the Album.

A checkbox is displayed in each album.user can select multiple checkbox and when the user click the 'Selected Album Download' button then All the selected Album put on the Folder and creating the zip.

'Download All Albums' button also Available to the Top of Page.through that button you can dowanload all the Album in a zip.

All the Time while Download Process is running the ProgressBar is Progress Continuesly.

## Part 3:

A 'Move' button is display on every Album thumbnail and when the User click that button the Album Image is move on the Google Drive. But the user is Sign into Google for the First Time for moving the album into the Google Drive. After that Google can not Take Any Permission for Moving the Album to the google drive.

a checkbox is displayed in each album for multiple file moving. Using the checkbox user can select multiple Album and click the 'Move to Selected Album' then all the Selected Album move to the Google drive of the User.

'Move All' button is Top of the Page. It can Move all the Album to the Google Drive.

## Importance :

* A clear responsive web application which was work on Any devices Like Desktop, Mobile, Tablet.
* Used the custom Design for better Enhancement without using any CSS Framework.
* Create the Custom Progress Bar to Display while the Zip is Creating on Server.


## Platforms : PHP 

### Framework : Codeignitor

### Scripting Language : JQuery AJAX, JavaScript

### Library Used :

#### Facebook PHP SDK - https://github.com/darkwhispering/facebook-sdk-codeigniter   
#### Google Drive API - https://developers.google.com/drive/api/v3/quickstart/php

#### Scrutinizer (Coding Standard) - https://scrutinizer-ci.com/g/karankhunt/Facebook-Album-Challenge-rtCamp/
## How to use :

=> First Sign in to the https://developers.facebook.com/

=> Create an App
        From the Menu Select Apps 
        -> add a new App 
        -> Enter the Display Name and Email id -> create App ID
        -> Go to the Settings -> Basic 
        -> Enter App Domains
        -> Enter Privacy Policy Url
        -> Enter App icon
        -> Choose Category
        -> Add Platform

=> By Default Facebook give Only Name,Email,Gender,Profile Pic Data to the User.

=> if you want to all photos permission of users then you need to approve your facebook app first.

=> Download my App from Github and unzip.

=> Put this Code into Your Server and if You want to run this App into Localhost then put this in root directory 
        => Wamp -> www 
        => xampp -> htdocs

=> Go to application/config/facebook.php and config the below value to your value.
        => put your app id, app secret key, login url, logout url

=> Run Your Project (^.^).