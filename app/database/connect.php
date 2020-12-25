<?php
/*

$host="localhost";
$user="root";
$pass="";
$db_name="blog";

*/

$host="mysql1006.mochahost.com";
$user="warner23_kkblog";
$pass="t4yl0r22??";
$db_name="warner23_kkblog";

$conn=new mysqli($host,$user,$pass,$db_name);

if($conn->connect_error){
die("Database connection error: ". $conn->connect_error);
}
