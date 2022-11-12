<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Methods: POST");

error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

require_once('../includes/libs.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $data = file_get_contents('php://input');
    $object = json_decode($data);

    $to = "miraclealao24@gmail.com";
    $from_email = $database->sanitize($object->email);


    $phone_number = $database->sanitize($object->phoneNumber);
    $subject = $database->sanitize($object->subject);
    $sender = $database->sanitize($object->fname . " " . $object->lname);
    $message = $database->sanitize($object->message);
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: " . $sender . " <" . $from_email . ">\r\n" .
        'Reply-To: ' . $from_email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    $body = "Dear WordAlive, <br/>" . "You can further contact me on " . $phone_number . "<br/>" . $message;
    if (mail($to, $subject, $body, $headers)) {
        $res = $database->mail($sender, $from_email, $subject, $body, $phone_number);
        http_response_code(200);
        echo json_encode(
            array(
            "type" => "Success",
            "title" => "Success",
            "message" => "Message sent successfully."
        )
        );
    }
    else {
        http_response_code(404);
        echo json_encode(
            array(
            "type" => "Fail",
            "title" => "Error",
            "message" => "Message not sent, please try again."
        )
        );
    }
    exit;
endif;
    
?>