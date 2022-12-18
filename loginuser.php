<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('dbconfig.php');
   
$data = json_decode(file_get_contents("php://input"));
if ($_SERVER['REQUEST_METHOD'] !== "POST"){
    echo json_encode(array("status" => "error"));
    die();
}
try {
    $stmt = $dbh->prepare(" SELECT * from  users where user_name = ? AND passwords = ?");
    $stmt->bindParam(1, $data->user_name);
    $stmt->bindParam(2, $data->passwords);
    // $stmt->bindParam(2, $image);
    $found = false;
    if($stmt->execute([
        $data
    ])) {
        $num = $stmt->rowCount();
        if($num > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $found = true;
            }

    if($found){
        echo json_encode(array('status' => "ok"));
    } else {
        echo json_encode(array('status' => "Error"));
    }
    $dbh = null;

    }
}
}
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
   

?>