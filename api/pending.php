<?php

require('../includes/db.php');
// Decoding Post request
$json = file_get_contents('php://input');
$data = json_decode($json);
$adminnumber = $data->adminnumber;
$groupname = $data->groupname;
$descripion = $data->descripion;
$usernumber =$data->usernumber;
$tonumber = $data->tonumber;

$update = "update notification set statusbypaid='1',description='$descripion' WHERE adminnumber='$adminnumber' and groupname='$groupname' and fromnumber='$usernumber' and tonumber='$tonumber'";
$execute = mysqli_query($conn,$update);

if($execute){
    echo "Payment Information sent";
}
else{
    echo mysqli_error($conn);
}
?>