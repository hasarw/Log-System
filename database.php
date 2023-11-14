<?php
//create connection credentioal
error_reporting(0);
$db_host = "localhost";
$db_name = "log-sys";
$db_user = "root";
$db_pass= "";


//create mysqli object
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);


if($mysqli->connect_error){
    printf("Connect Failed: %s\n", $mysqli->connect_error);
    exit();
}

?>
