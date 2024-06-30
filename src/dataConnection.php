<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "techhunter";

$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn)
{
    die("Couldn't connect" . mysqli_connect_error());
}

?>