<?php
require_once (__DIR__ . '/../templates/BasePage.php');

class ResetPasswordPage extends BasePage {
    function render() {
        self::renderHeader();
        self::continut1();//self::renderContent();
        self::renderFooter();
    }

    function continut1() {
       include 'resetpass.html';
    }


 // verificam toate campurile din formularul de resetare a parolei 
session_start();

$passwordold = $passwordnew = $passwordnew2= "";
$epasswordold = $epasswordnew = $epasswordnew2 =""; //definim variabilele pentru cazul de eroare
$fail="";

function fix_string($string) { // aici se face sanitizarea functiilor de mai sus
 if (get_magic_quotes_gpc())
 $string = stripslashes($string);
 return htmlentities ($string);
}

if (isset($_POST['submit']))
{

  if (isset($_POST['passwordold']))
  $passwordold = md5(fix_string($_POST['passwordold']));
  if (isset($_POST['passwordnew']))
  $passwordnew = md5(fix_string($_POST['passwordnew']));
  if (isset($_POST['passwordnew2']))
  $passwordnew2 = md5(fix_string($_POST['passwordnew2']));

  if($_SESSION['Password'] !== $passwordold){

    echo $passwordold;
    echo "<br>";
    echo $_SESSION['Password'] ;
    echo "Parola veche incorecta";
  } else {
    if($_POST["passwordnew"] != $_POST["passwordnew2"]) { echo "Parola 1 nu e aceasi ca parola 2";
    } else {
      if($_POST["passwordold"] == $_POST['passwordnew'] || $_POST["passwordold"] == $_POST['passwordnew2']) {  echo "Parola nu s-a schimbat fata de parola initiala";
      } else {
        $passChange = $passwordnew;
        $_SESSION["password"] = $passChange;
        $currentUser = $_SESSION["Username"];
        require_once("db_connect.php");
        $connection = mysqli_connect($servername,$username,$password,$dbname) or die ("could not connect");
        $sql = "UPDATE $tbl_name SET parola = '$passChange' WHERE username = '$currentUser' ";
        echo $sql;
        if (mysqli_query($connection,$sql)){
          echo  "Parola modificata cu succes";
        } else {
          echo "Parola nemodificata! Incearca din nou".mysqli_error($connection);
        }
      }
    }
  }
}
?>

