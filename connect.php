<?php
$db ='biometric';
$host ='localhost';
$uname="root";
$password = "";
// $db ='ohhdioco_wbf';
// $host ='localhost';
// $uname="ohhdioco_curtis";
// $password = "w#bhEV&fRmv(";

// $conn = mysqli_connect($sever, $uname, $pass, $db);


//set DSN
$dsn = "mysql:host=$host; dbname=$db";
//create instance
$conn = new PDO($dsn,$uname,$password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 ?>