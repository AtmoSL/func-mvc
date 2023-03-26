<?php

//Параметры для подключения к БД
$servername = "localhost";
$database = "mvc-func";
$username = "root";
$password = "";

$connection = mysqli_connect($servername, $username, $password, $database);

define("DB_CONNECT",$connection, false);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
//mysqli_close($connection);
