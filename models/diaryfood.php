<?php

class DiaryFood
{
    // ตัวแปรที่เก็บการติดต่อฐานข้อมูล
    private $connDB;

    // ตัวแปรที่ทำงานกับคอลัมน์ในตาราง 
    public $foodId;
    public $foodShopname;
    public $foodMeal;
    public $foodImage;
    public $foodPay;
    public $foodDate;
    public $foodProvince;
    public $foodLat;
    public $foodLng;
    public $memId;
    //ตัวแปรสารพัดประโยชน์
    public $message;

    //constructor
    public function __construct($connDB)
    {
        $this->connDB = $connDB;
    }
    //function get all data from tb
    public function getAllDiaryfood()
    {
        //ตัวแปรเก็บคำสั่ง SQL
        $strSQL = "SELECT * FROM diaryfood_tb";

        //สร้างตัวแปรที่ใช้ทำงานกับคำสั่ง SQL
        $stmt = $this->connDB->prepare($strSQL);

        //สั่งให้ SQL ทำงาน
        $stmt->execute();

        //ส่งค่าผลการทำงานกลับไปยังจุดเรียกใช้ฟังก์ชันนี้
        return $stmt;
    }

    //function get all data from tb
    public function getAllDiaryFoodByMemId()
    {
        $strSQL = "SELECT * FROM diaryfood_tb WHERE memId = :memId";
        $this->memId = intval(htmlspecialchars(strip_tags($this->memId)));
        $stmt = $this->connDB->prepare($strSQL);
        $stmt->bindParam(":memId", $this->memId);
        $stmt->execute();
        return $stmt;
    }

    //function get all data member from meal
    public function getAllFoodByMemMeal()
    {
        $strSQL = "SELECT * FROM diaryfood_tb WHERE memId = :memId AND foodMeal = :foodMeal";
        $this->memId = intval(htmlspecialchars(strip_tags($this->memId)));
        $this->foodMeal = intval(htmlspecialchars(strip_tags($this->foodMeal)));

        $stmt = $this->connDB->prepare($strSQL);

        $stmt->bindParam(":memId", $this->memId);
        $stmt->bindParam(":foodMeal", $this->foodMeal);
        $stmt->execute();
        return $stmt;
    }
    //function add data new register user
    public function insertDiaryFood()
    {
        $strSQL = "INSERT INTO diaryfood_tb
    (foodShopname,foodMeal,foodImage,foodPay,foodDate,foodProvince,foodLat,foodLng,memId)
    VALUES
    (:foodShopname,:foodMeal,:foodImage,:foodPay,:foodDate,:foodProvince,:foodLat,:foodLng,:memId)";
        $this->foodShopname = htmlspecialchars(strip_tags($this->foodShopname));
        $this->foodMeal = intval(htmlspecialchars(strip_tags($this->foodMeal)));
        $this->foodImage = htmlspecialchars(strip_tags($this->foodImage));
        $this->foodPay = intval(htmlspecialchars(strip_tags($this->foodPay)));
        $this->foodDate = htmlspecialchars(strip_tags($this->foodDate));
        $this->foodProvince = htmlspecialchars(strip_tags($this->foodProvince));
        $this->foodLat = htmlspecialchars(strip_tags($this->foodLat));
        $this->foodLng = htmlspecialchars(strip_tags($this->foodLng));
        $this->memId = intval(htmlspecialchars(strip_tags($this->memId)));

        $stmt = $this->connDB->prepare($strSQL);

        $stmt->bindParam(":foodShopname", $this->foodShopname);
        $stmt->bindParam(":foodMeal", $this->foodMeal);
        $stmt->bindParam(":foodImage", $this->foodImage);
        $stmt->bindParam(":foodPay", $this->foodPay);
        $stmt->bindParam(":foodDate", $this->foodDate);
        $stmt->bindParam(":foodProvince", $this->foodProvince);
        $stmt->bindParam(":foodLat", $this->foodLat);
        $stmt->bindParam(":foodLng", $this->foodLng);
        $stmt->bindParam(":memId", $this->memId);
        $stmt->execute();

        //สั่งsqlให้ทำงาน
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //function update diaryfood
    public function updateDiaryfood()
    {
        $strSQL = "";
        if ($this->foodImage == "") {
            $strSQL =   "UPDATE 
            diaryfood_tb SET 
            foodShopname = :foodShopname,
            foodMeal = :foodMeal,
            foodPay = :foodPay,
            foodDate = :foodDate,
            foodProvince = :foodProvince,
            foodLat = :foodLat,
            foodLng = :foodLng
            WHERE foodId = :foodId AND memId = :memId";
        } else {
            $strSQL =   "UPDATE diaryfood_tb SET 
            foodShopname = :foodShopname,
            foodMeal = :foodMeal,
            foodImage = :foodImage,
            foodPay = :foodPay,
            foodDate = :foodDate,
            foodProvince = :foodProvince,
            foodLat = :foodLat,
            foodLng = :foodLng
            WHERE foodId = :foodId AND memId = :memId";
        }

        $this->foodId = intval(htmlspecialchars(strip_tags($this->foodId)));
        $this->foodShopname = htmlspecialchars(strip_tags($this->foodShopname));
        $this->foodMeal = intval(htmlspecialchars(strip_tags($this->foodMeal)));
        
        if ($this->foodImage != "") {
        $this->foodImage = htmlspecialchars(strip_tags($this->foodImage));
        }

        $this->foodPay = intval(htmlspecialchars(strip_tags($this->foodPay)));
        $this->foodDate = htmlspecialchars(strip_tags($this->foodDate));
        $this->foodProvince = htmlspecialchars(strip_tags($this->foodProvince));
        $this->foodLat = htmlspecialchars(strip_tags($this->foodLat));
        $this->foodLng = htmlspecialchars(strip_tags($this->foodLng));
        $this->memId = intval(htmlspecialchars(strip_tags($this->memId)));

        $stmt = $this->connDB->prepare($strSQL);

        $stmt->bindParam(":foodId", $this->foodId);
        $stmt->bindParam(":foodShopname", $this->foodShopname);
        $stmt->bindParam(":foodMeal", $this->foodMeal);

        if ($this->foodImage != "") {
        $stmt->bindParam(":foodImage", $this->foodImage);
        }

        $stmt->bindParam(":foodPay", $this->foodPay);
        $stmt->bindParam(":foodDate", $this->foodDate);
        $stmt->bindParam(":foodProvince", $this->foodProvince);
        $stmt->bindParam(":foodLat", $this->foodLat);
        $stmt->bindParam(":foodLng", $this->foodLng);
        $stmt->bindParam(":memId", $this->memId);


        //สั่งsqlให้ทำงาน
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //function delete diaryfood
    public function deleteDiaryfood()
    {
        $strSQL = "DELETE FROM diaryfood_tb WHERE foodId = :foodId";
        $this->foodId = intval(htmlspecialchars(strip_tags($this->foodId)));
        $stmt = $this->connDB->prepare($strSQL);
        $stmt->bindParam(":foodId", $this->foodId);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
