<?php
include("connect.php");

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];

// check if the email used is in the database already
$sql = "SELECT * FROM `user` WHERE `email` = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$users = $stmt->fetchAll();

$error_handling = 1;// used to collect data about a certain error in the app
foreach ($users as $i) {
    if ($i["email"] == $email) {
        $error_handling = 2;
        break;
    }
}
// checking the errors
if ($error_handling == 1) {   
    mkdir("labeled_images/".$email);

// define('images/', 'images/');
$fileImg_parts = explode(";base64,", $p1);
$image_type_aux = explode("image/", $fileImg_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($fileImg_parts[1]);
$results = "labeled_images/".$email."/" . 1 . ".".$image_type;
file_put_contents($results, $image_base64);

$fileImg_parts = explode(";base64,", $p2);
$image_type_aux = explode("image/", $fileImg_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($fileImg_parts[1]);
$results = "labeled_images/".$email."/" . 2 . ".".$image_type;
file_put_contents($results, $image_base64);

    $sql = "INSERT INTO `user`(`username`, `email`, `password`) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $newpass = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$username,$email,$newpass]);
    
    //Update auth table
    // $sql = "UPDATE `auth` SET `used`=? WHERE `auth` = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute([1,$auth]);
    echo 1;// this means that averything is set
}
elseif ($error_handling == 2) {
    echo 2;// this means that the email has been used before
}
elseif ($error_handling == 3) {
    echo 3;// this means that the phone has been used before
}
elseif ($error_handling == 4) {
    echo 4;// this means the auth does notv exist
}
else {
    echo 0;// this is an unseen error
}




