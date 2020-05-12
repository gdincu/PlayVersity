<?php
require_once "session.php";
require_once "db_connect.php";

$ascheck = $descheck = true;

if (isset($_POST["access"]) ) {	
	if(isLoggedIn()) {
		session_destroy();
		header("Location: index.php");
		// echo "Logout reusit!";
		exit;
	}

	//Mesaje pentru client la logare
	//Avoiding SQL injections by using "'" and sanitising variables
	$userFinal = "'".htmlentities($_POST["username"],ENT_HTML5,'UTF-8',TRUE)."'";
	$passwordFinal =  "'".hash("sha256", htmlentities($_POST["password"],ENT_HTML5,'UTF-8',TRUE))."'";
	
	$sql = "SELECT username password FROM user WHERE username=$userFinal";
	$result = $connection->query($sql);
	
	//Mesaje pentru client la logare
	if($result->num_rows == 0) {
		header("Location: inscriere.php?error=InvalidUserOrPass");
		// echo "Username gresit!";
		exit;
	}
	
	if($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			$usercheck = $row["username"];
			$passcheck = $row["password"];
			
			//Mesaje pentru client la logare
			if("'".$usercheck."'" === $userFinal && "'".$passcheck."'" != $passwordFinal) {
				die ("Parola gresita!");
			}

			storeUserToSession($userFinal, $passwordFinal);
		}
	}
}

?>