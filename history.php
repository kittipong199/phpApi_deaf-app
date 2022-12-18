<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('dbconfig.php');
   
    // $db = new Databases('localhost', 'deafdb' , 'root' , '');
    $data = json_decode(file_get_contents("php://input"));
    if ($_SERVER['REQUEST_METHOD'] !== "POST"){
        echo json_encode(array("status" => "error"));
        die();
    }
    try{
        $stmt = $dbh->prepare("INSERT INTO history (user_id, content_id) VALUES (?, ?)");
        $stmt->bindParam(1, $data->user_id);
        $stmt->bindParam(2, $data->content_id);
        // $stmt->bindParam(2, $image);
        
    
        if($stmt->execute()){
            echo json_encode(array('status' => "ok"));
        } else {
            echo json_encode(array('status' => "Error"));
        }
        $dbh = null;
    
    }catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
       
    
    ?>