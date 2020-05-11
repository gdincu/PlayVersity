<?php	
//Managementul sesiunii
if(!isset($_SESSION["user"]))
session_start();

include "db_connect.php";

$ascheck = $descheck = true;

if (isset($_POST["login"]) ) {	

	//Mesaje pentru client la logare
	if(isset($_SESSION["user"]))
		die ("Already logged in!");

	//Avoiding SQL injections by using "'" and sanitising variables
	$userFinal = "'".htmlentities($_POST["username"],ENT_HTML5,'UTF-8',TRUE)."'";
	$passwordFinal =  "'".hash("sha256", htmlentities($_POST["password"],ENT_HTML5,'UTF-8',TRUE))."'";
	
	$sql = "SELECT username password FROM user WHERE username=$userFinal";
	$result = $connection->query($sql);
	
	//Mesaje pentru client la logare
	if($result->num_rows == 0) {
	die ("Username gresit!");	
	}
	
	if($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			$usercheck = $row["username"];
			$passcheck = $row["password"];
			
			//Mesaje pentru client la logare
			if("'".$usercheck."'" === $userFinal && "'".$passcheck."'" != $passwordFinal) {
			die ("Parola gresita!");
			}
			
			//Managementul sesiunii
			$_SESSION["user"] = $userFinal;
			$_SESSION["password"] = $passwordFinal;
			echo "Connected successfully!"."<br><br>";
		}	
	}
}

?>