<?php

require('../includes/db.php');
// Decoding Post request
$json = file_get_contents('php://input');
$data = json_decode($json);
$phno = $data->phno;
$group= $data->group;
$member1 = $data->member1;
$member2 = $data->member2;

$insert1 = "insert into teams values(DEFAULT,'$phno','$group','$member1')";

$inserted1 = mysqli_query($conn,$insert1);

$insert2 = "insert into teams values(DEFAULT,'$phno','$group','$member2')";

$inserted2 = mysqli_query($conn, $insert2);

if($inserted1){
    if($inserted2){
        echo "Group created successfully ";
    }
}

?>