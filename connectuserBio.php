<?php 
include('./connect.php');
$uname =filter_var($_POST['email'], FILTER_SANITIZE_STRING);


// echo $pass."asuodyo";

    //selecting all the contacts from the user table
    $select = "SELECT * from `user` where `email`=?"; 
    $stmt = $conn->prepare($select);
    $stmt->execute([$uname]);
    $row = $stmt->fetch();
    if ($row == true) {
        $id = $row['id'];
        // echo $id."this is the id";
        $id = strval(password_hash($id, PASSWORD_DEFAULT)); 
        
        setcookie('eyo_ass--90', $id, time() + (60*60*24*7*31), "/",null,isset($_SERVER["HTTPS"]),true);
        setcookie('_buo___', password_hash('boobs',PASSWORD_DEFAULT), time() + (60*60*24*7*31), "/",null,isset($_SERVER["HTTPS"]),true);

            // header("Location:profile.html");
            echo 1;
        
}
else{
    // header("Location:./");
    // echo $password.'<br>';
    echo 3;
}

?>  