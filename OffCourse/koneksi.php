<?php

$host = "localhost";
$user = "u543439954_adithama";
$pass = "Mercifulox123";
$db   = "u543439954_offcourse";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>