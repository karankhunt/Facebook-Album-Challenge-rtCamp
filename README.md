In that My website you can Show your Album Image of Your Facebook Profile. First of You can Authenticate Facebook Login and then After You can show Your Facebook Album Image on the Webpage and You can also see the Photos in the Slider.

Part 1:

User Login to the Website using Facebook credential. Asking for permission of name,email,photos. Application retrieve all the Album Image of the Login User.

Part 2:

Album's will be display with a thumbnail and name. whenever user click the thumbnai then Preview that Album Image in a Fullscreen Slideshow.

A 'Download Album Link' is Putting on Each Album thumbnail whenever the User click on that button then in the background process all the Image of that album is Put on folder and create the zip of that Album with the name of Album name.

A checkbox is displayed in each album. when the user click the 'Selected Album Download' then All the selected Album put on the Folder and creating the zip.

'Download All Albums' link also Available to the Top of Page.using that you can dowanload all the Album into zip.

All the Time while Download Process is not Completing the Spinner is Loading Continuesly.

Part 3:

A 'Move' Link is display on Each Album thumbnail and when the User click that link the Album Image is move on the Google Drive. But the user is Sign into Google for the First Time for moving the album into the Google Drive.After that Google can not Take Any Permission for Moving the Album to the google drive.

Using the checkbox user can select multiple Album and click the 'Move to Selected Album' then all the Selected Album move to the Google drive of the User.

'Move All' link is Top of the Page. It can Move all the Album to the Google Drive.

Importance :

A clear responsive web application which was work on Any devices Like Desktop, Mobile, Tablet.
Used the custom Design for better Enhancement without using any CSS Framework.
Create the Custom Progress Bar to Display while the Zip is Creating on Server.


Platforms : PHP 

Framework : Codeignitor

Scripting Language : JQuery AJAX, JavaScrip

Library Used :

    Facebook PHP SDK
    Google Drive API

How to use :

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