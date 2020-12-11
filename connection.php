<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "egm_receipts_book";

//database_connection.php
try{
    $connect = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
}catch(PDOException $e){
    die('Unable to connect with the database');
}
?>