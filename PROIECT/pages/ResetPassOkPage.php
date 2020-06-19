<?php
require_once (__DIR__ . '/../templates/BasePage.php');
require_once "pages/helpers/session.php";
require_once "pages/helpers/access.php";
//require_once "pages/helpers/validate_signup_form_fields.php";



class ResetPassOkPage extends BasePage {
    function render() {
        self::renderHeader();
        $this->renderContent();
    }

    
    function renderContent() {
     
      $passwordold = $passwordnew = $passwordnew2= "";
      $fail = $epasswordold = $epasswordnew = $epasswordnew2= ""; //definim variabilele pentru cazul de eroare

      include "resetpassok.html";
      $fail=$fail.$epasswordold.$epasswordnew.$epasswordnew2; //verific daca exista o eroare la oricare camp din formular
      
      
      function fix_string($string) { // aici se face sanitizarea functiilor de mai sus
       if (get_magic_quotes_gpc())
       $string = stripslashes($string);
       return htmlentities ($string);
      }

      if (isset($_POST['submit']))
      {
       
      if (isset($_POST['passwordold']))
      $passwordold = hash("sha256", htmlentities($_POST['passwordold'],ENT_HTML5,'UTF-8',TRUE));
      if (isset($_POST['passwordnew']))
      $passwordnew = hash("sha256", htmlentities($_POST['passwordnew'],ENT_HTML5,'UTF-8',TRUE));
      if (isset($_POST['passwordnew2']))
      $passwordnew2 = hash("sha256", htmlentities($_POST['passwordnew2'],ENT_HTML5,'UTF-8',TRUE));
  
        
      if(($_SESSION['password']) !== $passwordold){

      echo("Parola sesiune: ".$_SESSION["password"]);
      echo("Parola formualar curenta: ".$passwordold);
      echo "Current password is incorrect.";
      } else {
          if($_POST["passwordnew"] != $_POST["passwordnew2"]) { echo "New passwords don't match. Please check.";
          } else {
            if($_POST["passwordold"] == $_POST["passwordnew"] || $_POST["passwordold"] == $_POST["passwordnew2"]) {  echo "New password must be different from old password";
            } else {
              $passChange = $passwordnew;
              $_SESSION["password"] = $passChange;
              $currentUser = $_SESSION["user"];
              $connection = mysqli_connect("localhost","root","","playversity");
              $sql = "UPDATE user SET password = '$passChange' WHERE username = '$currentUser'";
              if (mysqli_query($connection,$sql)){
                echo  "Password successfully changed!";
                echo ("Parola sesiune: ".$_SESSION["password"]);
              } else {
                echo "Password was not changed. Please check again!".mysqli_error($connection);
              }
            }
          }
      }
    }    
  }
}

?>