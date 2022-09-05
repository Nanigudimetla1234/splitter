<?php

require('../includes/db.php');
// Decoding Post request
$json = file_get_contents('php://input');
$data = json_decode($json);
$adminnumber = $data->adminnumber;
$paymentgroupnames = $data->paymentgroupnames;
$paidnumber = $data->paidnumber;
$amountspended = $data->amountspended;
$description = $data->description;
date_default_timezone_set("Asia/calcutta");

$date = date("Y-m-d");
$current_time = date("H:i:s");

$insertion = "insert into expenses values(DEFAULT,'$adminnumber','$paymentgroupnames','$paidnumber','$amountspended','$description','$date','$current_time')";

$inserted = mysqli_query($conn,$insertion);


// ..................

//these queries handles the seperate table called transexpenses which gives the information about how much amount is payed by x person in x group

$search = "select * from transexpenses where adminnumber='".$adminnumber."' and groupname='". $paymentgroupnames."' and paymentnumber='".$paidnumber."'";

$searchexecute = mysqli_query($conn,$search);

if(mysqli_num_rows($searchexecute)>0){

     $getpresentvalue = "select * from transexpenses where adminnumber='".$adminnumber."' and groupname='". $paymentgroupnames."' and paymentnumber='".$paidnumber."'";
     $executegetpresentvalue = mysqli_query($conn, $getpresentvalue);
     while($row = mysqli_fetch_assoc($executegetpresentvalue)){
        $presentamount = $row['amount'];
     }

     $updatedamount= $presentamount+ $amountspended;

     $updateamount = "update transexpenses set amount='".$updatedamount.
    "' where adminnumber='" . $adminnumber . "' and groupname='" . $paymentgroupnames . "' and paymentnumber='" . $paidnumber . "'";

    $executeupdateamount = mysqli_query($conn,$updateamount);
    if($executeupdateamount){
        echo "Your expense is added successfully";
    }
}
else{
    $insertamount = "insert into transexpenses values (DEFAULT,'$adminnumber','$paymentgroupnames','$paidnumber','$amountspended')";
    $insertamountexecute = mysqli_query($conn,$insertamount);
    if($insertamountexecute){
        echo "Your expense is added successfully";
    }

}


?>
