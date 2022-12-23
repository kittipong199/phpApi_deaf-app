<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('dbconfig.php');
   
    // $db = new Databases('localhost', 'deafdb' , 'root' , '');
try{
    $coures =array();
    $dbh = new PDO('mysql:host=localhost;dbname=proficnx_deafdb', $user, $pass);
    foreach($dbh->query('SELECT * from coures') as $row) {
        array_push($coures, array(
                'id' => $row['id'],
                'couresname' => $row['couresname'],
            ));
       }
    echo json_encode($coures);
    $dbh = null;

}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
   

?>
