<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "sontran2k3";
$dbName = "login_register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully<br>";
}
?>
