<?php
 //ดึงข้อมูล
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET"); //POST, PUT, DELETE
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../connectdb.php";
require_once "./../models/diaryfood.php";

$connDB = new ConnectDB();
$diaryfood = new Diaryfood($connDB->getConnectionDB());

$data = json_decode(file_get_contents("php://input"));

$diaryfood->memId = $data->memId;

$result = $diaryfood->getAllDiaryFoodByMemId();

if($result->rowCount() > 0){
    //มี
    $resultInfo = array();
    //Extract ข้อมูลที่ได้มาจากคำสั่ง SQL เก็บในตัวแปร
    while ($resultData = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($resultData);
        //สร้างตัวแปรอาร์เรย์เก็บข้อมูล
        $resultArray = array(
            "message" => "1",
            "foodId" => strval($foodId),
            "foodShopname" => $foodShopname,
            "foodMeal" => strval($foodMeal),
            "foodImage" => $foodImage,
            "foodPay" => strval($foodPay),
            "foodDate" => $foodDate,
            "foodProvince" => $foodProvince,
            "foodLat" => strval($foodLat),
            "foodLng" => strval($foodLng),
            "memId" => strval($memId)

        );
    
        array_push($resultInfo, $resultArray);
    }

    echo json_encode($resultInfo, JSON_UNESCAPED_UNICODE);
}else{
    //ไม่มี
    echo json_encode(array("message" => "0"));
}
?>