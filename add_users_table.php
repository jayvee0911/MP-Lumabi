<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include '../../essentials/connection.php';

$conn = new Connection();

if(!$conn->connect()) die('Configuration error');
//else echo 'successful connection'; //must delete this upon finalization

$to_decode = json_decode(file_get_contents("php://input"));
$ID = $to_decode->ID;
$username = $to_decode->username;
$name = $to_decode->name;
$address = $to_decode->address;
$contact = $to_decode->contact;

$add_table = "INSERT INTO users_tbl(ID, username, name, address, contact) VALUES ('$ID','$username','$name','$address','$contact')";
    if(mysqli_query($conn->connect(), $add_table)){
         echo json_encode(array('Message' => 'Table successfully added.'));
    } else {
         echo json_encode(array('Message' => 'Table username is already exist!'));
}
    
$conn->close($conn->connect());
?>