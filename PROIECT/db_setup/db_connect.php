<?php 

$servername       = "localhost";
// $username   = "root";
$username   = "AAA";
// $password   = "";
$password   = "cb1ad2119d8fafb69566510ee712661f9f14b83385006ef92aec47f523a38358";
$dbname     = "playversity";

//DB connection
// require_once('config.php');
$connection = mysqli_connect($servername,$username,$password,$dbname);

//Verificarea conexiunii
if(!$connection)
    die ("Connection failed!");

?>