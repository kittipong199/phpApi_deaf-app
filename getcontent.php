<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('dbconfig.php');
   
    // $db = new Databases('localhost', 'deafdb' , 'root' , '');
try{
    $content =array();
    $dbh = new PDO('mysql:host=localhost;dbname=deafdb', $user, $pass);
    foreach($dbh->query('SELECT * from contents') as $row) {
        array_push($content, array(
                'id' => $row['id'],
                'coure_id' => $row['coure_id'],
                'contentname' => $row['contentname'],
                'video' => $row['video'],
                'image' => $row['image'],
                'content_text' => $row['content_text'],
            ));
       }
    echo json_encode($content);
    $dbh = null;

}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
   

?>