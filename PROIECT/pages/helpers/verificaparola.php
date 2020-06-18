<?php
/**
 * Used to validate the new passwords provided via the form
 */
$parola=$parola2=$parola3=$fail="";

if (isset($_POST['parola']))
    $parola = $_POST['parola'];
if (isset($_POST['parola2']))
    $parola2 = $_POST['parola2'];
if (isset($_POST['parola3']))
    $parola3 = $_POST['parola3'];

$fail .= validate_parola($parola,$parola2,$parola3);
?>

<?php
/**
 * Function to validate the password
 */
function validate_parola($parola,$parola2,$parola3) {

if(strcmp(hash("sha256", htmlentities($parola,ENT_HTML5,'UTF-8',TRUE)) , $_SESSION["password"]) != 0 )
return "Parola veche este incorecta<br>";

if ($parola2 == "" || $parola3 == "" )
return "Ambele parole noi trebuie completate<br />";

if (strcmp($parola3,$parola2) != 0 )
return "Parolele noi nu sunt la fel<br />";

if (strcmp($parola,$parola2) == 0 )
return "Parolele noi sunt la fel ca parola veche<br />";

return "";
}
?> 