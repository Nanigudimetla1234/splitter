<?php

require('../includes/db.php');
// Decoding Post request
$json = file_get_contents('php://input');
$data = json_decode($json);
$phone = $data->groupnovalue;
$groupnamevalue = $data->groupnamevalue;
$ownnumber = $data->ownnumber;
$insert = "insert into teams values(DEFAULT,'$phone','$groupnamevalue','$ownnumber')";
$insertion = mysqli_query($conn,$insert);
if($insertion){
    echo "You are added to the group";
}
?>