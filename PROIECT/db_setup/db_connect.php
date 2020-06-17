<?php 

global $dbservername, $dbusername, $dbpassword, $dbname;

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "playversity";

//DB connection
// require_once('config.php');
global $connection;
$connection = mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);

//Verificarea conexiunii
if(!$connection)
    die ("Connection failed!");

?>