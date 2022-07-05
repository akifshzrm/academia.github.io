<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "academia";

$conn       = mysqli_connect($host,$user,$pass,$db);

if(!$conn) {
    die("Failed to connect");
}