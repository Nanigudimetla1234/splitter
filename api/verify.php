<?php

require('../includes/db.php');
// Decoding Post request
$json = file_get_contents('php://input');
$data = json_decode($json);
$adminnumber = $data->adminnumber;
$groupname = $data->groupname;
$fromnumber =$data->fromnumber;

$update = "update notification set status='1' WHERE adminnumber='$adminnumber' and groupname='$groupname' and fromnumber='$fromnumber'";
$execute = mysqli_query($conn,$update);

if($execute){
    echo "Payment verified successfully";
}
else{
    echo mysqli_error($conn);
}
?>