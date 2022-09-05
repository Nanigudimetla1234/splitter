<?php
if (isset($_POST['submit'])) {
    require('db.php');
    $user = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['mail']);
    $pwd = trim($_POST['password']);
    $rep_pwd = trim($_POST['repPassword']);
    $debit = 0;
    $credit = 0;
    if (empty($user) || empty($pwd) || empty($rep_pwd)) {
        header("Location:../signup.php?error=emptyfields&user=" . $user . "&pwd=" . $pwd);
        exit();
    }
    else if ($pwd !== $rep_pwd) {
        header("Location:../signup.php?error=PasswordNotMatch&user=" . $user);
        exit();
    } else {
        $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $register = "insert into users VALUES(DEFAULT,'$user','$phone','$email','$hashPwd','$debit','$credit')";
        $execute_register = mysqli_query($conn,$register);
        if($execute_register){
            echo "inserted ";
        }
        header("Location:../login.php");

    }
}
 else {
    header("Location:../signup.php");
    exit();
 }

