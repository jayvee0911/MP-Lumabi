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

$check_id = "SELECT * FROM users_tbl WHERE ID = '$ID'";
    $result = mysqli_query($conn->connect(), $check_id);
    if(mysqli_num_rows($result)>0){
$up_table = "UPDATE users_tbl SET username = '$username', name='$name', address='$address', contact='$contact' WHERE ID = '$ID'"; 
    if(mysqli_query($conn->connect(), $up_table)){
        echo json_encode(array('Message' => 'Table has been updated.', 'ID'=>$ID));
} 
    } else {
        http_response_code(400);
        echo json_encode(array('Message' => 'Error! Input ID is not found.'));
}

$conn->close($conn->connect());
?>