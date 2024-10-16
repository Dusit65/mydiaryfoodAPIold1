<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET"); //POST, PUT, DELETE
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../connectdb.php";
require_once "./../models/diaryfood.php";

//สร้าง Instance (Object/ตัวแทน)
$connDB = new ConnectDB();
$diaryfood = new Diaryfood($connDB->getConnectionDB());

//เรียกใช้ฟังก์ชันดึงข้อมูลทั้งหมดจากตาราง diaryfood_tb
$result = $diaryfood->getAllDiaryfood();

//ตรวจสอบข้อมูลจากการเรัยกใช้ฟังก์ชันตรวจสอบชื่อผู้ใช้ รหัสผ่าน
if ($result->rowCount() > 0) {
    $resultInfo = array();

    //Extract ข้อมูลที่ได้มาจากคำสั่ง SQL เก็บในตัวแปร
    while ($resultData = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($resultData);
        //สร้างตัวแปรอาร์เรย์เก็บข้อมูล
        $resultArray = array(
            "message" => "1",
            "foodId" => $foodId,
            "foodShopname" => $foodShopname
        );
        array_push($resultInfo, $resultArray);
    }


    echo json_encode($resultInfo, JSON_UNESCAPED_UNICODE);
// echo json_encode(array("message" => "เข้าสู่ระบบ!!"));
} else {
    $resultInfo = array();
    $resultArray = array(
        "message" => "0"
    );
    array_push($resultInfo, $resultArray);
    echo json_encode(array("message" => "0"));
}