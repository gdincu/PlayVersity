<?php
require_once (__DIR__ . '/../templates/BasePage.php');
require_once "pages/helpers/session.php";
require_once "pages/helpers/access.php";


class PlaylistPage extends BasePage {
    function render() {
        self::renderHeader();
        $this->renderContent();
        self::renderFooter();
    }

    
    function renderContent() {

      $newplaylist="";
      
      function fix_string($string) { // aici se face sanitizarea functiilor de mai sus
       if (get_magic_quotes_gpc())
       $string = stripslashes($string);
       return htmlentities ($string);
      }
      include "playlistoptions.html";
    

      if (isset($_POST['submitplaylist'])){
        
        if (isset($_POST['newplaylist']))
        $playlistname = fix_string($_POST['newplaylist']);
        echo("Nume playlist: ".$playlistname);
        $currentUser = $_SESSION["user"];
        echo("User conectat:".$currentUser);
        $connection = mysqli_connect("localhost","root","","playversity");
        $sql = "CALL usp_playlistCreate('$playlistname','$currentUser');";
        echo $sql;
        
        if (mysqli_query($connection,$sql)){
          echo  "Playlist created.";

        } else {
          echo "Playlist was not created. Please try again!".mysqli_error($connection);
        }
        
      //   $result = mysqli_query($connection, $query);
      //   while($row = mysql_fetch_array($result)) {
      //     $id = $row['id'];
      //     echo "<h2>Id playlist: " . $id . "</h2>";
      // }
    }
  }

}
?>