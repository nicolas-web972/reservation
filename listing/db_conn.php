<?php

$sname = "localhost:3306";
$user_name = "root";
$password = "";
$db_name = "stay";

$conn = mysqli_connect($sname, $user_name, $password, $db_name);

if (!$conn) {
    echo "connection failed";
}
