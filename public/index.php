<?php

// Recipient's email address
$to = "kimmwau@gmail.com";

// Email subject
$subject = "Test Email";

// Email message content
$message = "This is a test email sent using PHP.";

// Email headers
$headers = "From: testworld@example.com\r\n";
$headers .= "Reply-To: sender@example.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Set parameters for sending email using port 587
ini_set("SMTP", "smtp.example.com");
ini_set("smtp_port", "587");

// Attempt to send the email
if (mail($to, $subject, $message, $headers)) {
    echo "Email was successfully sent.";
} else {
    echo "Failed to send email.";
}


echo "hi";
die();
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
