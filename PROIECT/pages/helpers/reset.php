<?php 
/**
 * If not logged in - re-directs to index.php
 */
if(!isset($_SESSION["user"]))
header("Location: index.php");

include (__DIR__ . '/../../db_setup/db_connect.php');
?>

<?php include "verificaparola.php"; ?>

<form method="post">

    <p>
    <div class="form-row col-sm-4">
    Parola curenta:<div class="col">
    <input type="text" class="form-control" id="parola" name="parola" placeholder="<?php echo $parola;?>" value="<?php echo $parola;?>" required> 
    </div></div>
    </p>
    
    <p>
    <div class="form-row col-sm-4">
    Parola noua:<div class="col">
    <input type="password" class="form-control" id="parola2" name="parola2" placeholder="<?php echo $parola2;?>" value="<?php echo $parola2;?>">
    </div></div>
    </p>
    
    <p>
    <div class="form-row col-sm-4">
    Parola noua:<div class="col">
    <input type="password" class="form-control" id="parola3" name="parola3"  placeholder="<?php echo $parola3;?>" value="<?php echo $parola3;?>">
    </div></div>
    </p>
    
    <p>
    <div class="form-row col-sm-6">
    <div class="col">
    <button type="submit" name="submit" id="submit" class="btn btn-success">Update</button>
    </div></div>
    </p>
    
    </form>


<?php
/**
 * Form functionality
 */
if (isset($_POST['submit'])) {  

    if ($fail == "") {
        echo "Form data successfully validated";
    }
    else {
        echo $fail;
        exit;
    }

//Preventing SQL Injections & XSS Injections
$newpass =  "'".hash("sha256", htmlentities($_POST["parola2"],ENT_HTML5,'UTF-8',TRUE))."'";
$currentUser = "'".$_SESSION["user"]."'";
$currentPass = "'".$_SESSION["password"]."'";

$sql = "UPDATE user SET password = $newpass WHERE username = $currentUser AND password = $currentPass";
if(mysqli_query($connection,$sql)) {
    $_SESSION["password"] = hash("sha256", htmlentities($_POST["parola2"],ENT_HTML5,'UTF-8',TRUE));
    echo "Added!";
}
    
else
    echo "Error:".$sql."<br>".$connection->error;
}
?> 