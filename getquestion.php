<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('dbconfig.php');
   
    // $db = new Databases('localhost', 'deafdb' , 'root' , '');
    try{
        $questions =array();
        $stmt = $dbh->prepare("SELECT * FROM questions where coure_id = ?");
        $stmt->execute([$_GET['coure_id']]);
        foreach ($stmt as $row) {
            array_push($questions, array(
                'id' => $row['id'],
                'coure_id' => $row['coure_id'],
                'questionText' => $row['questionText'],
                'questionVideo' => $row['questionVideo'],
               
            ));
            echo json_encode($questions);
            break;
       }
       
        $dbh = null;
    
    }catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
       
    
    ?>