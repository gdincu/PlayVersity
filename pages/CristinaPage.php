<?php
require_once "helpers/session.php";
require_once "db_setup/db_connect.php";
require_once (__DIR__ . '/../templates/BasePage.php');


//name pages
class CristinaPage extends BasePage {
    function render() {
        self::renderHeader();
        $this->continut1();//self::renderContent();
        self::renderFooter();
    }

    function continut1() {
      //aici tb sa fac pagina html
       include "cristina.html";

       // $sql = "CALL usp_returnSongs($tempPlaylist);";
       // $result = $connection->query($sql);
       //
       // //Mesaje pentru client la logare
       // if($result->num_rows == 0) {
       // 	header("Location: index.php?page=home&error=playlistnotfound");
       // 	exit;
       //                             }
       // else    {
       //
       // echo "Song list:
       //       <br><br>
       //       <table class=\"table\">
       //       <tr>
       //         <th>Position</th>
       //         <th>Name</th>
       //                 <th>Artist</th>
       //                 <th>Length</th>
       //                   </tr>";
       //
       // while($row = $result->fetch_assoc()) {
       // echo "<tr>";
       //   echo "<td>" . $row["name"] . "</td>";
       //     echo "<td>" . $row["artist"] . "</td>";
       //     echo "<td>" . $row["length"] . "</td>";
       // echo "</tr>";
       //                             }
       // echo "</table>";
       //     }
}

    function continut2() {
        echo "<div>continut</div>";
     }
}
