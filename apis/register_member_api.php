    <?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); //POST, PUT, DELETE
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../connectdb.php";
require_once "./../models/member.php";

//create instant object
$connDB = new ConnectDB();
$member = new Member($connDB->getConnectionDB());

//receive value from client 
$data = json_decode(file_get_contents("php://input"));

//set value to Model variable
$member->memFullName = $data->memFullName;
$member->memEmail = $data->memEmail;
$member->memUsername = $data->memUsername;
$member->memPassword = $data->memPassword;
$member->memAge = $data->memAge;

//call checking username and password function
$result = $member ->registerMember();

if ($result == true){
    //inset update delete complete
    echo json_encode(array("message" => "1"));
}else{
    //inset update delete fail
    echo json_encode(array("message" => "0"));
}