<?php

//session_start();

function getError($param) {
    $result = "valueok";
    $errorArray = isset($_SESSION["error"]) ? $_SESSION["error"] : null;
    if ($errorArray != null && isset($errorArray[$param])) {
        $result = $errorArray[$param] == "" ? "valueok" : "valuenok";
    }
    echo $result; 
}

/**
 * If the data enetered in the SignUp form fields are not valid, an Error Message is displayed.
 * The error message will be displayed below every form field.
 */
function getErrorMessage($param) {
    $result = "";
    $errorArray = isset($_SESSION["error"]) ? $_SESSION["error"] : null;
    if ($errorArray != null && isset($errorArray[$param])) {
        $result = $errorArray[$param];
    }
    echo $result;
}


function getPost($param) {
	if (isset($_POST[$param])) {
		echo $_POST[$param];
	}
}

function getChecked($param, $value) {
    $checked = isset($_POST[$param]) && $_POST[$param] == $value;
    echo $checked ? 'checked' : '';
}

/**
 * validation of sign up form fields
 * save the user into the db 
 */
function saveUser() {
    require_once("validate_signup_form_fields.php");
  
    $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? md5($_POST["password"]) : "";
    
    $errorArray = array();
    $error = false;
    $errorMessage = "";

    $errorMessage = validate_username($username);
    if ($errorMessage != "") {
        $errorArray['username'] = $errorMessage;
        $error = true;
    }

    $errorMessage = validate_firstname($firstname);
    if ($errorMessage != "") {
        $errorArray['firstname'] = $errorMessage;
        $error = true;
    }
    $errorMessage = validate_lastname($lastname);
    if ($errorMessage != "") {
        $errorArray['lastname'] = $errorMessage;
        $error = true;
    }
    $errorMessage = validate_password($_POST["password"]);
    if ($errorMessage != "") {
        $errorArray['password'] = $errorMessage;
        $error = true;
    }

    $_SESSION["error"] = $errorArray;
    if ($error) {
        echo 'Not saved to database. Please check for errors.</br>';
        return false;
    }

    // Create connection
    require (__DIR__ . '/../../db_setup/db_connect.php');

    $success = true;

    try {
        $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // prepare statement
        $sql = 'INSERT INTO user(username, firstname, lastname, password) VALUES(:1, :2, :3, :4)';
        $stmt = $conn->prepare($sql);

        // bind parameters
        $stmt->bindParam(":1", $username, PDO::PARAM_STR);
        $stmt->bindParam(":2", $firstname, PDO::PARAM_STR);
        $stmt->bindParam(":3", $lastname, PDO::PARAM_STR);
        $stmt->bindParam(":4", $password, PDO::PARAM_STR);

        
        // execute
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        $success = false;
    }

    $conn = null;

    if ($success) {
        echo 'User ' . $username . ' saved to database. </br>';
    } else {
        die();
    }

    return $success;
}

if(isset($_POST["savedata"])) {
    saveUser();
}

// function loginUser() {
// 	// Create connection
// 	require_once("config.php");

// 	try {		
// 		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
// 		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		$stmt = $conn->prepare("SELECT username, sex, starecivila, nume, prenume, email, datainregistrare, telefon FROM utilizatori WHERE username=? and parola =?");
// 		$param = array($_POST["username"], md5($_POST["password"]));
// 		$stmt->execute($param);

// 		// set the resulting array to associative
// 		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
// 		$count = $stmt->rowCount();
		
// 		if ($count > 0) {
// 			echo 'Found login info:';
// 			echo '<table style="border:1px solid black">';
// 			foreach($stmt->fetchAll() as $k=>$v) {
// 				echo '<tr>';
// 				echo '<td>' . $v['username'] . '</td>';
// 				echo '<td>' . $v['sex'] . '</td>';
// 				echo '<td>' . $v['starecivila'] . '</td>';
// 				echo '<td>' . $v['nume'] . '</td>';
// 				echo '<td>' . $v['prenume'] . '</td>';
//                 echo '<td>' . $v['email'] . '</td>';
//                 echo '<td>' . $v['datainregistrare'] . '</td>';
//                 echo '<td>' . $v['telefon'] . '</td>';
// 				echo '</tr>';
// 			}
// 			echo '</table></br>';
			
//             $_SESSION["loggedinuser"] = $_POST["username"];
//             $_SESSION["loggedinuserpass"] = $_POST["password"];
//             $_SESSION["sorting"] = isset($_POST["orderByName"]) ? $_POST["orderByName"] : "ASC";
// 		} else {
// 			echo 'Login info not found.';
// 		}

// 	}
// 	catch(PDOException $e) {
// 		echo "Error: " . $e->getMessage();
// 	}
// 	$conn = null;
// }

// function listAllUsers() {
// 	// Create connection
// 	require("config.php");

// 	try {		
// 		$conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
//         $orderbyName = isset($_SESSION["sorting"]) ? $_SESSION["sorting"] : "ASC";
// 		$stmt = $conn->prepare("SELECT username, sex, starecivila, nume, prenume, email, datainregistrare, extensie, telefon FROM utilizatori ORDER BY username " . $orderbyName);
// 		$param = array();
// 		$stmt->execute();

// 		// set the resulting array to associative
// 		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
// 		$count = $stmt->rowCount();
		
// 		if ($count > 0) {
//             $loggedInUser = isset($_SESSION["loggedinuser"]) ? $_SESSION["loggedinuser"] : "";

//             echo '<div>Logged in as: '. $loggedInUser .'</div></br>';
// 			echo '<table style="border:1px solid black">';
// 			foreach($stmt->fetchAll() as $k=>$v) {
// 				echo '<tr>';
//                 echo '<td>' . $v['username'] . '</td>';
                
//                 if ($loggedInUser != "") {
//                     echo '<td>' . $v['sex'] . '</td>';
//                     echo '<td>' . $v['starecivila'] . '</td>';
//                     echo '<td>' . $v['nume'] . '</td>';
//                     echo '<td>' . $v['prenume'] . '</td>';
//                     echo '<td>' . $v['email'] . '</td>';
//                     echo '<td>' . $v['datainregistrare'] . '</td>';
//                     echo '<td>' . $v['telefon'] . '</td>';
//                     if (isset($v['extensie'])) {
//                         echo '<td>' . $v['username'].'.'.$v['extensie'] . '</td>';
//                     }
//                 }

// 				echo '</tr>';
// 			}
// 			echo '</table></br>';
// 		} else {
// 			echo 'No user info found!';
// 		}

// 	}
// 	catch(PDOException $e) {
// 		echo "Error: " . $e->getMessage();
// 	}
// 	$conn = null;
// }




// if(isset($_POST["save"]))
// {
//     if (saveUser()) {
//         header("Location: http://localhost/appWeb/index.php"); /* Redirect browser */
//         exit();
//     }
// } else if(isset($_POST["Login"]) && isset($_POST["username"]) && isset($_POST["password"])) {
//     if (isset($_SESSION["loggedinuser"])) {
// 		echo 'Already logged in';
// 	} else {
// 		loginUser();
// 	}
// } else if(isset($_POST["Logout"])) {
//     // Finally, destroy the session.
//     $_SESSION["loggedinuser"] = "";
// 	session_destroy();
// }
?>