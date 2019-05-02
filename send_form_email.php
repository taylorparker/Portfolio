<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/send.min.css"/>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Contact Taylor</title>
</head>
<body>
  
<?php
if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "taylorparker2013@gmail.com";
    $email_subject = "You have a new contact!";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $first_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $company = $_POST['company']; // not required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(strlen($message) < 2) {
    $error_message .= 'The message you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }


$email_message = "
    <html>
        <head>
        <title>New Portfolio Contact</title>
        </head>
    <body>
    <section style='background-color: #74b9ff; height: 100%; margin: auto; text-align: center; width: 100%'>
        <div>
            <p style='color: white; font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 15px;'>You have a new contact!</p>
            <p style='color: white; font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 15px;'>Name: ".clean_string($first_name)."</p>
            <p style='color: white; font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 15px;'>Email: ".clean_string($email_from)."</a></p>
            <p style='color: white; font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 15px;'>Company: ".clean_string($company)."</p>
        </div>
        <div style='max-width: 40%;margin: auto;'>
            <p style='color: white; font-family: Arial, Helvetica, sans-serif; font-size: 20px; padding: 15px;'>".clean_string($message)."</p>
        </div>
    </section>
    </body>
    </html>";

// create email headers
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: taylor@taylorparker.me' . "\r\n";
mail($email_to, $email_subject, $email_message, $headers);
?>

<!-- include your own success html here -->

<div class="send">
  <h1>Thank you for contacting me. I will be in touch with you soon.</h1>

  <div class="project-button-holder">
    <a href="index.html">
      <div class="project-button">Return To Homepage</div>
    </a>
  </div>
</div>

<?php

}
?>

</body>
</html>