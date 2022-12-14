<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once 'vendor/autoload.php';
include_once "config.php";

function send_message($tophonenumber, $fromphonenumber, $subject, $body, $isHTML) {

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
$mail->SMTPAuth = true;
//to view proper logging details for success and error messages
// $mail->SMTPDebug = 1;
$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
$mail->Username = GMAIL_ACCOUNT;   //email
$mail->Password = GMAIL_APP_PASSWORD;   //16 character obtained from app password created
$mail->Port = 465;                    //SMTP port
$mail->SMTPSecure = "ssl";
$from_email=GMAIL_ACCOUNT;
$from=GMAIL_USER_NAME;

//sender information
$mail->setFrom($from_email, $from);

//receiver phone number  and name
//
//
//
//number@txt.att.net (SMS)
//number@smsmyboostmobile.com (SMS)
//number@sms.cricketwireless.net (SMS)
//number@messaging.sprintpcs.com (SMS)
//number@tmomail.net (SMS and MMS)
//number@email.uscc.net (SMS)
//number@vtext.com (SMS)
//number@vmobl.com (SMS)

 
$carriergatewayaddress = $carrier  
$mail->addAddress($to_phonenumber, $to);
for each phonenumber( + "@" = $carriergatewayaddress )


 
 
$mail->isHTML($isHTML);
 
$mail->Subject = $subject;
$mail->Body    = $body;

// Send mail   
if (!$mail->send()) {
    echo 'Message  not sent an error was encountered: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}

$mail->smtpClose();
}


?>
