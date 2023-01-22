<?php 
include('./connect.php');
$uname =filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$pass =filter_var($_POST['password'], FILTER_SANITIZE_STRING);


// echo $pass."asuodyo";

    //selecting all the contacts from the user table
    $select = "SELECT * from `user` where `email`=?"; 
    $stmt = $conn->prepare($select);
    $stmt->execute([$uname]);
    $row = $stmt->fetch();
    if ($row == true) {
        $password = $row['password'];
    
    
    if (password_verify($pass,$password)) {
        //selecting all the contacts from the user table
        $select = "SELECT `id`from `user` where `email`=? AND `password`=?"; 
        $stmt = $conn->prepare($select);
        $stmt->execute([$uname,$password]);
        $row = $stmt->fetch();
        if ($row == true) {
            $id = $row['id'];
        }
        else {
            echo "boyoyo<br>";
        }
        
        // echo $id."this is the id";
        $id = strval(password_hash($id, PASSWORD_DEFAULT)); 
        
        setcookie('eyo_ass--90', $id, time() + (60*60*24*7*31), "/",null,isset($_SERVER["HTTPS"]),true);
        setcookie('_buo___', password_hash('boobs',PASSWORD_DEFAULT), time() + (60*60*24*7*31), "/",null,isset($_SERVER["HTTPS"]),true);

            // header("Location:profile.html");
            echo 1;
        
    
        // echo $btn;
    }
    else{
        // header("Location:./");
        // echo $password.'<br>';
        echo 2;
    }
}
else{
    // header("Location:./");
    // echo $password.'<br>';
    echo 3;
}

?>  