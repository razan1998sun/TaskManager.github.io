<?php 
session_start();
$_SESSION['user_id'] = 1;

$server_name = "localhost";
$user_name = "root";
$password = "";
$dbname = "to_do";


$connection = new mysqli($server_name , $user_name , $password , $dbname );

// لجعل عامود الوصف في قاعدة البيانات يقبل اللغة العربية
mysqli_set_charset($connection , "utf8");

if ($connection->connect_error)
{  "failed connection with Database: $connection->connect_error";  }

?>
