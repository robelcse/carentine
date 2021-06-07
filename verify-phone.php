<?php
session_start();
include 'db.php';
require "includes/twilio/Twilio/autoload.php";
use Twilio\Rest\Client;
if(isset($_POST['phone'])){
    $response = array();
    $phone = $_POST['phone'];
    $stmt = $sql->prepare("select * from users where phone=?");
    $stmt->bindParam(1, $phone, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    if($stmt->rowCount()==0){
        $response['phone_exists'] = 0;
        $code = mt_rand(100000, 500000);
        $_SESSION['code'] = $code;
        $_SESSION['phone'] = $phone;
        //$response['code'] = $code;
        $client = new Client($sid, $token);
        $client->messages->create(
            '+61'.substr($phone, 1),
            array(
                'from' => $twilio_number,
                'body' => "Your Carentine PIN is: $code. Please keep this PIN for future verification."
            )
        );
    }else{
        $response['phone_exists'] = 1;
        $_SESSION['userid'] = $row['id'];
    }
    
    echo json_encode($response);
    die();
}

if(isset($_POST['code'])){
    $response = array();
    $code = $_POST['code'];
    $phone = $_SESSION['phone'];
    if($code==$_SESSION['code']){
        $query = "INSERT into users (phone, password) VALUES (?, ?)";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $phone, PDO::PARAM_STR);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->execute();
        $response['error'] = 0;
        $_SESSION['userid'] = $sql->lastInsertId();
        echo json_encode($response);
    }else{
        $response['message'] = '<div class="alert alert-danger">Verification PIN is incorrect, please try again.</div>';
        $response['error'] = 1;
        echo json_encode($response);
    }
}
?>