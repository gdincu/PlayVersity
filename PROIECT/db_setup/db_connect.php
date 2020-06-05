<?php 

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "playversity";

//DB connection
// require_once('config.php');
$connection = mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);

//Verificarea conexiunii
if(!$connection)
    die ("Connection failed!");

?>