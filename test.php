<?php
header("Access-Control-Allow-Origin: *");
echo "yes";

$file_path = '/user01/';

mkdir("labeled_images/curtiscrentsil0@gmail.com");

// $target_dir = "files/";

// function generateRandomString($length = 10) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }


// $newName = generateRandomString();
// $extention = explode(".",$_FILES["fileToUpload"]["name"])[1];

// $target_file = $target_dir . basename($newName.".".$extention);
// // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// // Check if file already exists
// // if (file_exists($target_file)) {
// //   echo "Sorry, file already exists.";
// //   $uploadOk = 0;
// // }

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000000000000000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// // && $imageFileType != "gif" ) {
// //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// //   $uploadOk = 0;
// // }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//     echo "https://onlydio.com/newcloud/files/".$newName.".".$extention;
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }

?>