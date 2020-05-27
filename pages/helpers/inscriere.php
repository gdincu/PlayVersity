<?php include "access.php"; ?>
<?php include "templates/header.php"; ?>
<?php include "db_connect.php"; ?>



<?php include "verifica.php"; ?>

<?php

if (isset($_POST['submit'])) {  

    if ($fail == "") {
        echo "Form data successfully validated";
    }
    else {
        // header("Location: inscriere.php");
        echo $fail;
        exit;
    }

include "upload.php";

//Validarea datelor server-side1
//if($_POST["parola"] != $_POST["parola2"])
//	die("Passwords don't match!");

//Preventing SQL Injections & XSS Injections
$userFinal = "'".htmlentities($_POST["usernume"],ENT_HTML5,'UTF-8',TRUE)."'";
$passwordFinal = "'".md5(htmlentities($_POST["parola"],ENT_HTML5,'UTF-8',TRUE))."'";
$nume = "'".htmlentities($_POST["nume"],ENT_HTML5,'UTF-8',TRUE)."'";
$prenume = "'".htmlentities($_POST["prenume"],ENT_HTML5,'UTF-8',TRUE)."'";
$email = "'".htmlentities($_POST["email"],ENT_HTML5,'UTF-8',TRUE)."'";
$sex = $starecivila = '';
$fileExtFinal = "'".$fileExt."'";

if(empty($_POST["necasatorit"]) && empty($_POST["casatorit"])) {$starecivila = "'"."Nespecificat"."'";}
else if (!empty($_POST["casatorit"])) {$starecivila = "'"."Casatorit(a)"."'";}
else {$starecivila = "'"."Necasatorit(a)"."'";}

if(!isset($_POST["barbat"]) && !isset($_POST["barbat"])) {$sex = "'".'Nespecificat'."'"; }
else if (isset($_POST["barbat"])) {$sex = "'".'Barbat'."'"; }else {$sex = "'".'Femeie'."'"; }

$sql = "INSERT INTO utilizatori (usernume,parola,nume,prenume,email,dataregistrare,starecivila,sex,extensie)
        VALUES ($userFinal,$passwordFinal,$nume,$prenume,$email,SYSDATE(),$starecivila,$sex,$fileExtFinal)";

if(mysqli_query($connection,$sql)) {
    echo "Added!";
}
else {
    echo "Error:".$sql."<br>".$connection->error;
}


}
?>

<?php include "templates/footer.php"; ?>