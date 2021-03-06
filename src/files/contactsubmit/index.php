<?php

require "./vendor/class.smtp.php";
require "./vendor/class.phpmailer.php";
require "./conf.php";

$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = $mailconf["host"];
$mail->Username = $mailconf["username"];
$mail->Password = $mailconf["password"];
$mail->SMTPSecure = $mailconf["security"];
$mail->Port = $mailconf["port"];

$message = "";

foreach($_POST as $item => $contents){
  $message .= $item . ": " . $contents . "\n";
}

$mail->setFrom($mailconf["fromaddress"], "Website Contact Form");
$mail->addAddress($mailconf["toaddress"], "Website Contact");
$mail->addReplyTo($_POST["contact"], $_POST["name"]);

$mail->Subject = "Website Contact Page Message";
$mail->Body = $message;

$mail->send();
