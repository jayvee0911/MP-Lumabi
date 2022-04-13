<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include '../../essentials/connection.php';

$conn = new Connection();

if(!$conn->connect()) die('Configuration error');
//else echo 'successful connection'; //must delete this upon finalization

$to_decode = json_decode(file_get_contents("php://input"));

$read_all_tables = "SELECT ID, username, name, address, contact FROM users_tbl";
$result = mysqli_query($conn->connect(), $read_all_tables);
$check_result = mysqli_num_rows($result);

    if($check_result > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        echo json_encode(array('ID' =>  $row["ID"] , 'username' =>  $row["username"], 'name' =>  $row["name"], 'address' =>  $row["address"], 'contact' =>  $row["contact"]));
    }
}

$conn->close($conn->connect());
?>