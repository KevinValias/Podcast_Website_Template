<?php

if(!$_POST) exit;

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

// Fields from Soundcast contact form. If you need more fields, just add a variable with the "name"
$name     = $_POST['name'];
$email    = $_POST['email'];
$subject  = $_POST['subject'];
$message  = $_POST['message'];

if(get_magic_quotes_gpc()) {
	$message = stripslashes($message);
}

// Enter the email address that you want to emails to be sent to.
// Change the address to your real email
$address = "contact@yourdomain.com";

// This will be the "subject" of the email
$e_subject = "Contact Form from $name";

// Configuration
// Here we build the email body and sent headers for email
// If you want, feel free to change your email body
$e_body = "You have a new messagem from $name: $subject" . PHP_EOL . PHP_EOL;
$e_content = "\"$message\"" . PHP_EOL . PHP_EOL;
$e_reply = "Contact $name via email: $email";

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

if(mail($address, $e_subject, $msg, $headers)) {

	// Send to ajax a success data

	echo json_encode("success");

} else {
	
	// Send to ajax a error data

	echo json_encode("error");

}