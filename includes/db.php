<?php
$serverName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "splitter";

$conn = mysqli_connect($serverName, $dbUser, $dbPassword,  $dbName);
if (!$conn) {
    die("Connection Error : " . mysqli_connect_error());
}
