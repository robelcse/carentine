<?php
//Database Connection
//$sql = new mysqli('localhost', 'carentin_carenti', 'D2SHjD-FRxiw', 'carentin_carentine');
function connect() {
    $username = 'root';
    $password = '';
    $mysqlhost = 'localhost';
    $dbname = 'carentin_carentine';
    $pdo = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
    if($pdo){
        //make errors throw exceptions
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }else{
        die("Could not create PDO connection.");
    }
}

$sql = connect(); 


//Twilio Keys
$sid = 'ACb594405d1d3bc931c875d01e492c9f09';
$token = 'e3c4b3ef19d7d1ba91350d342186e783';
$twilio_number = '+12058398574';
?>