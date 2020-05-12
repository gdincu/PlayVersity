<?php include "access.php"; ?>
<?php include "templates/header.php"; ?>
<?php include "db_connect.php"; ?>



<?php include "verifica.php"; ?>

<!--Formulare de inscriere-->
<form method="post" enctype="multipart/form-data">

<p>
    <div class="form-row col-sm-6">
    <div class="col">
    <input type="text" class="form-control" id="nume" name="nume" placeholder="<?php echo 'Nume: ' . $nume;?>" value="<?php echo $nume;?>" required> 
    </div>
    <div class="col">
    <input type="text" class="form-control" id="prenume" name="prenume" placeholder="<?php echo 'Prenume: ' . $prenume;?>" value="<?php echo $prenume;?>"  required>
    </div>
    <div class="col">
    <input type="email" class="form-control" id="email" name="email"  placeholder="<?php echo 'Email: ' . $email;?>" value="<?php echo $email;?>" required>
    </div>
    </div>
</p>

<p>
	<script src="passcheck.js"></script>
    <div class="form-row col-sm-6">
    <div class="col">
    <input type="text" class="form-control" id="usernume" name="usernume"  placeholder="<?php echo 'User: ' . $user;?>" value="<?php echo $user;?>"  required>
    </div>
    <div class="col">
    <input type="password" class="form-control" id="parola" name="parola"  placeholder="<?php echo 'Parola: ' . $parola;?>" value="<?php echo $parola;?>" required>
    </div>
    <div class="col">
    <input type="password" class="form-control" id="parola2" name="parola2"  placeholder="<?php echo 'Parola: ' . $parola2;?>" value="<?php echo $parola2;?>" required>
	 
	 <!--Checking pass match client-side-->
	 <div id="chkForm1"></div>
	 <span id='message'></span>
    </div>
    </div>
</p>



<p>
    <div class="form-row col-sm-6">
    
    <div class="col">
    Stare civila
    </div>

    <div class="col">
    <input class="form-check-input" type="checkbox" name="casatorit" value="casatorit">
    <label class="form-check-label" for="casatorit">Casatorit(a)</label>
    </div>

    <div class="col">
    <input class="form-check-input" type="checkbox" name="necasatorit" value="necasatorit">
    <label class="form-check-label" for="necasatorit">Necasatorit(a)</label>
    </div>

    </div>
</p>

<p>
<div class="form-row col-sm-6">
    
<div class="col">
Sex
</div>

<div class="col">
<input class="form-check-input" type="radio" name="barbat" value="barbat">
<label class="form-check-label" for="male">Barbat</label>
</div>

<div class="col">
<input class="form-check-input" type="radio" name="femeie" value="femeie">
<label class="form-check-label" for="male">Femeie</label>
</div>

</div>
</p>

<!--Foto upload-->
<p>
<div class="form-row col-sm-6">

<div class="col">
Foto
</div>

<div class="col">
Imagine de profil:<input type="file" name="fileToUpload" id="fileToUpload">
</div>

</div>
</p>

<div class="form-row col-sm-6">
    <div class="col">
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Adauga</button>
    </div>
    </div>

</form>


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