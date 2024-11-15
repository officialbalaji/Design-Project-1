<?php
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "ips";

$conn =new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
