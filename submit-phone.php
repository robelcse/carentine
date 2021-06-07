<?php
session_start();
include 'db.php';
require "includes/twilio/Twilio/autoload.php";
use Twilio\Rest\Client;
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
    $response = array();
    $stmt = $sql->prepare("select * from blocked_ip where ip=?");
    $stmt->bindParam(1, $ip, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>=3){
        $response['message'] = '<div class="alert alert-danger">Blocked, you have entered too many wrong pin codes.</div>';
        $response['error'] = 1;
        echo json_encode($response);
        die();
    }
    
    $stmt = $sql->prepare("select * from helper_helpee where helper_phone=? OR helpee_phone=?");
    $stmt->bindParam(1, $phone, PDO::PARAM_STR);
    $stmt->bindParam(2, $phone, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()>=10){
        $response['message'] = '<div class="alert alert-danger">You can only engage with only 10 numbers.</div>';
        $response['error'] = 1;
        echo json_encode($response);
        die();
    }
    
    
    
    $postid = $_POST['postid'];
    $stmt = $sql->prepare("select * from users where phone=?");
    $stmt->bindParam(1, $phone, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    if($stmt->rowCount()==0){
        $response['phone_exists'] = 0;
        $code = mt_rand(100000, 500000);
        //$response['code'] = $code;
        $_SESSION['code'] = $code;
        $_SESSION['phone'] = $phone;
        $client = new Client($sid, $token);
        $client->messages->create(
            '+61'.substr($phone, 1),
            array(
                'from' => $twilio_number,
                'body' => "Your Carentine PIN number is: $code. Please keep this PIN number for future verification"
            )
        );
    }else{
        $stmt = $sql->prepare("select * from posts where id=?");
        $stmt->bindParam(1, $postid, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        $postphone = $row['phone'];
        $stmt = $sql->prepare("select * from helper_helpee where helper_phone=? OR helpee_phone=?");
        $stmt->bindParam(1, $phone, PDO::PARAM_INT);
        $stmt->bindParam(2, $phone, PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount()==5){
            $response['message'] = '<div class="alert alert-danger">You can only engage with 5 people.</div>';
            $response['error'] = 1;
        }else{
            $response['phone_exists'] = 1;
            $response['post_phone'] = $postphone.' '.getRatings($postphone);
        }
    }
    
    echo json_encode($response);
    die();
}

if(isset($_POST['code'])){
    $response = array();
    $code = $_POST['code'];
    $postid = $_POST['postid'];
    $phone = $_SESSION['phone'];
    if($code==$_SESSION['code']){
        $query = "INSERT into users (phone, password) VALUES (?, ?)";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $phone, PDO::PARAM_STR);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->execute();
        $stmt = $sql->prepare("select * from posts where id=?");
        $stmt->bindParam(1, $postid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        
        $posttype = $row['post_type'];
        if($posttype=='wanttohelp'){
            $helper_phone = $row['phone'];
            $helpee_phone = $phone;
        }else{
            $helper_phone = $phone;
            $helpee_phone = $row['phone'];
        }
        
        $stmt = $sql->prepare("select * from helper_helpee where (helper_phone=? AND helpee_phone=?) OR (helper_phone=? AND helpee_phone=?)");
        $stmt->bindParam(1, $helper_phone, PDO::PARAM_STR);
        $stmt->bindParam(2, $helpee_phone, PDO::PARAM_STR);
        $stmt->bindParam(3, $helpee_phone, PDO::PARAM_STR);
        $stmt->bindParam(4, $helper_phone, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()==0){
            $query = "INSERT into helper_helpee (helper_phone, helpee_phone) VALUES (?, ?)";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(1, $helper_phone, PDO::PARAM_STR);
            $stmt->bindParam(2, $helpee_phone, PDO::PARAM_STR);
            $stmt->execute(); 
        }
        
        $response['post_phone'] = $row['phone'].' '.getRatings($row['phone']);
        $response['error'] = 0;
        echo json_encode($response);
    }else{
        $date = date('Y-m-d');
        $query = "INSERT into blocked_ip (ip, date) VALUES (?, ?)";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(1, $ip, PDO::PARAM_STR);
        $stmt->bindParam(2, $date, PDO::PARAM_STR);
        $stmt->execute();
        $response['message'] = '<div class="alert alert-danger">Verification code is incorrect, please try again.</div>';
        $response['error'] = 1;
        echo json_encode($response);
    }
}


function getRatings($postphone){
    global $sql;
    $stmt = $sql->prepare("select AVG(rating) as avg from ratings where postphone = ?");
    $stmt->bindParam(1, $postphone, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    $avg = $row['avg'];
    return '<i class="fa fa-star" style="color:orange"></i>'.number_format($avg, 2);
}


?>