<?php
if (isset($_POST['submit'])) {
    require('db.php');
    $phone = trim($_POST['number']);
    $pwd = trim($_POST['password']);
    if (empty($phone) || empty($pwd)) {
        header("Location:../index.php?error=emptyfields&user=" . $phone . "&pwd=" . $pwd);
        exit();
    } else {
        $found = "select * from users where phno='". $phone . "'";
        $found_execute = mysqli_query($conn, $found);
        if ($row = mysqli_fetch_assoc($found_execute)) {
            $pwdCheck = password_verify($pwd, $row['password']);  
            if ($pwdCheck == false) {
                header("Location:../login.php?error=incorrect password1");
                exit();
            } 
            if($pwdCheck) {
                session_start();
                $_SESSION["user"] = $row['phno'];
                header("Location: ../index.php");
            }
        }
        else{
            echo mysqli_error($conn);
        }
    }
} else {
    header("Location:../signup.php");
    exit();
}


?>