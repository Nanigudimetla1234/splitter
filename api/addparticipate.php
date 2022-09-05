<?php

require('../includes/db.php');
// Decoding Post request
$json = file_get_contents('php://input');
$data = json_decode($json);
$participatenumber = $data->addparticipantnumber;
$groupname = $data->groupnamevalue;
$number = $data->ownnumber;
$insert = "insert into teams values(DEFAULT,'$number','$groupname','$participatenumber')";
$insertion = mysqli_query($conn, $insert);
if ($insertion) {
    echo "New member is added to the group";
}
?>