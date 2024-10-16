<?php
class Member
{
    // ตัวแปรที่เก็บการติดต่อฐานข้อมูล
    private $connDB;

    // ตัวแปรที่ทำงานกับคอลัมน์ในตาราง 
    public $memId;
    public $memFullName;
    public $memEmail;
    public $memUsername;
    public $memPassword;
    public $memAge;
    //ตัวแปรสารพัดประโยชน์
    public $message;

    //constructor
    public function __construct($connDB)
    {
        $this->connDB = $connDB;
    }
    //----------------------------------------------------------
    //function การทำงานที่ล้อกับส่วนของ apis
    public function checkLogin()
    {

        //ตัวแปรคำสั่งsql
        $strSQL = "SELECT * FROM member_tb WHERE memUsername = :memUsername AND memPassword = :memPassword";

        //ตรวจสอบค่าที่ส่งมาจาก Client/User ก่อนที่จะกำหนดให้กับ parameter (:???????)
        $this->memUsername = htmlspecialchars(strip_tags($this->memUsername));
        $this->memPassword = htmlspecialchars(strip_tags($this->memPassword));

        //สร้างตัวแปรสที่ใช้ทำงานกับคำสั่งsql
        $stmt = $this->connDB->prepare($strSQL);
        //เอาที่ผ่านตรวจสอบแล้วไปกำหนดให้กับ parameter

        $stmt->bindParam(":memUsername", $this->memUsername);
        $stmt->bindParam(":memPassword", $this->memPassword);

        //สั่งsqlให้ทำงาน
        $stmt->execute();
        //ส่งค่าการทำงานกลับไปยังจุดเรียกใช้งานฟังก์ชั่น 
        return $stmt;
    }

    //function add data new register user
    public function registerMember()
    {
        //ตัวแปรคำสั่งsql
        $strSQL = "INSERT INTO member_tb
        (memFullName,memEmail,memUsername,memPassword,memAge) 
        VALUES
        (:memFullName,:memEmail,:memUsername,:memPassword,:memAge)";
        
    $this->memFullName = htmlspecialchars(strip_tags($this->memFullName));
    $this->memEmail = htmlspecialchars(strip_tags($this->memEmail));
    $this->memUsername = htmlspecialchars(strip_tags($this->memUsername));
    $this->memPassword = htmlspecialchars(strip_tags($this->memPassword));
    $this->memAge = intval(htmlspecialchars(strip_tags($this->memAge)));

    //สร้างตัวแปรสที่ใช้ทำงานกับคำสั่งsql
    $stmt = $this->connDB->prepare($strSQL);

    //เอาที่ผ่านตรวจสอบแล้วไปกำหนดให้กับ parameter 

    $stmt->bindParam(":memFullName", $this->memFullName);
    $stmt->bindParam(":memEmail", $this->memEmail);
    $stmt->bindParam(":memUsername", $this->memUsername);
    $stmt->bindParam(":memPassword", $this->memPassword);
    $stmt->bindParam(":memAge", $this->memAge);

    //สั่งsqlให้ทำงาน
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }

    }
    //function update data user
    public function updateMember()
    {
        //ตัวแปรคำสั่งsql
        $strSQL = "UPDATE member_tb SET
        memEmail = :memEmail,
        memUsername = :memUsername,
        memPassword = :memPassword,
        memAge = :memAge
        WHERE memId = :memId";

        $this->memId = intval(htmlspecialchars(strip_tags($this->memId)));
        $this->memEmail = htmlspecialchars(strip_tags($this->memEmail));
        $this->memUsername = htmlspecialchars(strip_tags($this->memUsername));
        $this->memPassword = htmlspecialchars(strip_tags($this->memPassword));
        $this->memAge = intval(htmlspecialchars(strip_tags($this->memAge)));

        //สร้างตัวแปรสที่ใช้ทำงานกับคำสั่งsql
        $stmt = $this->connDB->prepare($strSQL);

        $stmt->bindParam(":memId", $this->memId);
        $stmt->bindParam(":memEmail", $this->memEmail);
        $stmt->bindParam(":memUsername", $this->memUsername);
        $stmt->bindParam(":memPassword", $this->memPassword);
        $stmt->bindParam(":memAge", $this->memAge);

        //สั่งsqlให้ทำงาน
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        }
}
