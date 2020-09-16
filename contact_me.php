<?php
//packages and files for PHPMailer and SMTP protocol
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//----------Citations-----------
//Web site explaining How to Send an Email via Gmail SMTP Server using PHP.
//https://pepipost.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/

//clone this first in project directory
//https://github.com/PHPMailer/PHPMailer/
//run the folowing composer command in the terminal after cloning the above 
//composer require phpmailer/phpmailer

//erros encountered and fixes 
//https://serverfault.com/questions/635139/how-to-fix-send-mail-authorization-failed-534-5-7-14



// Check for empty fields
if(empty($_POST['email'])) {
    http_response_code(500);
    echo'email is empty';
    exit();
  }

    //Initialize PHP Mailer and set SMTP as mailing protocol
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    //set required parameters for making an SMTP connection throught SSL
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       =  587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "antoneli2811@gmail.com";
    $mail->Password   = "Volar1996";

    //required parameters for email header and body
    $to = $_POST['email'];
    $mail->IsHTML(true);
    $mail->AddAddress($to);
    $mail->SetFrom("noreply@Favbbnames.com", "Favorite Baby Names");
    $mail->AddReplyTo("noreply@Favbbnames.com", "Myron Zambrano");
    $mail->Subject = "Thank you for subscribing";
    $content = "<b> Subscribed!.</b>";

    //Send the email and catch required exceptions
    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {
        echo "Email sent successfully";
    }

    //for XAMPP development
    //header("refresh:1; url=http://localhost:8080/FavoriteBabyNames/");
    header("refresh:1; url=http://lamp.cse.fau.edu/~mzambrano2016/p6/index.php");


// //Check for empty fields
// if( isset($_POST['sendMessageButton'])) {
//     $to = $_POST['email'];
//     $subject = "Thank you for subcribing";
//     $body= "Subcribed!";
    
//     $headers ="From: Favorite Baby Names";  
//     $headers .="Reply-To: mzambrano2016@fau.edu";  
//     $headers .="Content-type: text/html\r\n";

// if(!mail($to, $subject, $body, $headers))
//    http_response_code(500);

// }

// echo 'Thank you for your submission';
// //for XAMPP development
// //header("refresh:1; url=http://localhost:8080/FavoriteBabyNames/");
// header("refresh:1; url=http://lamp.cse.fau.edu/~mzambrano2016/p6/index.php");
