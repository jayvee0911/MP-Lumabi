<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include '../../essentials/connection.php';

$conn = new Connection();

if(!$conn->connect()) die('Configuration error');
//else echo 'successful connection'; //must delete this upon finalization

$to_decode = json_decode(file_get_contents("php://input"));
$username = $to_decode->username;


$check_user = "SELECT * FROM users_tbl WHERE username = '$username'";
$response = mysqli_query($conn->connect(), $check_user);
    if(mysqli_num_rows($response)>0){
        echo json_encode(array('Message' => 'Input username already exists.'));
    } else {
        echo json_encode(array('Message' => 'Error! Input username is not found.'));
    }
 