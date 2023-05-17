<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMail/src/Exception.php';
require 'PHPMail/src/PHPMailer.php';
require 'PHPMail/src/SMTP.php';

$mail=new PHPMailer(true);
$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username= 'supervisorrlms@gmail.com';
$mail->Password='opcdvismmtbgpmpb';
$mail->SMTPSecure='ssl';
$mail->Port=465;

$mail->setFrom('supervisorrlms@gmail.com');


?>