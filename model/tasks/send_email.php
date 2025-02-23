<?php

use PHPMailer\PHPMailer\PHPMailer;

const MAIL_PATH      = 'PHPMailer/vendor/';
const MAIL_HOST      = 'mail.psychx.io';
const MAIL_SENDER    = 'system@psychx.io';
const MAIL_PASS      = 'Pass4SystemPsychX11!!';
const MAIL_SRC       = MAIL_PATH . 'phpmailer/phpmailer/src/';

require_once MAIL_SRC . 'Exception.php';
require_once MAIL_SRC . 'PHPMailer.php';
require_once MAIL_SRC . 'SMTP.php';

require_once MAIL_PATH . 'autoload.php';

function email($email, $subject, $header, $message)
{
    global $error;

    $sender = MAIL_SENDER;

    $mail               = new PHPMailer();
    $mail->isSMTP();
    $mail->Host         = MAIL_HOST;
    $mail->SMTPAuth     = TRUE;
    $mail->SMTPSecure   = 'ssl';
    $mail->Port         = 465;
    $mail->isHTML(true);
    $mail->Username     = $sender;
    $mail->Password     = MAIL_PASS;

    $mail->Subject      = $subject;
    $mail->SetFrom($sender, $header);

    $mail->Body         = $message;
    $mail->AddAddress($email);


    if (!$mail->Send()) {
        $mail->smtpClose();
        return $error[] = 127;
    }

    $mail->smtpClose();

    return "success";
}


define('APP_NAME', 'RentPesa');

$email      = 'annaodhiambo@gmail.com';
$subject    = APP_NAME . ' Cron Test';
$name       = APP_NAME;
$body       = '<p style="font-family:Poppins, sans-serif;"> ';
$body       .= 'Testing cron job';
$body       .= '</p>';

email($email, $subject, $name, $body);
