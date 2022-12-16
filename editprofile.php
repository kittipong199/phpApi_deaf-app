<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('dbconfig.php');
   
$data = json_decode(file_get_contents("php://input"));
if ($_SERVER['REQUEST_METHOD'] !== "PATCH"){
    echo json_encode(array("status" => "error"));
    die();
}
try{
    $stmt = $dbh->prepare("UPDATE  users SET (user_name=?, passwords=?, images=? WHERE id = ?) ");
    $stmt->bindParam(1, $data->user_name);
    $stmt->bindParam(2, $data->passwords);
    $stmt->bindParam(2, $dat->images);
    $stmt->bindParam(2, $dat->id);
    

    if($stmt->execute()){
        echo json_encode(array('status' => "Update ok"));
    } else {
        echo json_encode(array('status' => "Error"));
    }
    $dbh = null;

}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
   

?>