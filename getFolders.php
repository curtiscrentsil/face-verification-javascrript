<?php
include("connect.php");

$courses = [];
// $courses = new stdClass();
$selectr = "SELECT * from `user`"; 
$stmt = $conn->prepare($selectr);
$stmt->execute();
while($row = $stmt->fetch())
{

    array_push($courses,$row["email"]);
}
echo json_encode($courses);
