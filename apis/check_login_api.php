<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET"); //POST, PUT, DELETE
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../connectdb.php";
require_once "./../models/Member.php";

//create instant object
$connDB = new ConnectDB();
$member = new Member($connDB->getConnectionDB());

//receive value from client 
$data = json_decode(file_get_contents("php://input"));

//set value to Model variable
$member->memUsername = $data->memUsername;
$member->memPassword = $data->memPassword;

//call checking username and password function
$result = $member ->checkLogin();

//data check from all checking username and password function
if($result->rowCount() > 0){
    //extract data from sql instruction 
    $resultData = $result->fetch(PDO::FETCH_ASSOC);
    extract ($resultData);
    //create array variable store data
    $resultArray = array(
        "message"=>"1",
        "memId"=>strval($memId),
        "memFullName"=>$memFullName,
        "memEmail"=>$memEmail,
        "memUsername"=>$memUsername,
        "memPassword"=>$memPassword,
        "memAge"=>strval($memAge)
    );
    echo json_encode($resultArray, JSON_UNESCAPED_UNICODE);
    // echo json_encode(array("message" => "ชื่อผู้ใช้งานและรหัสผ่านถูกต้อง"));
}else{
    echo json_encode(array("message" => "0"));
}

?>