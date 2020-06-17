<?php
require_once (__DIR__ . '/../templates/BasePage.php');
require_once "helpers/session.php";


class UserPlaylistsPage extends BasePage {

    private $sql;
    

    function render() {
        self::renderHeader();
        $this->content();//self::renderContent();
        self::renderFooter();
    }

    function content() {
       include "userplaylistspagecontent.html";
    }

    function returnPlaylistBasedOnUser() {
        
        $tempUser = "'" . $_SESSION["user"] . "'";
        $connection = mysqli_connect("localhost","root","","playversity");
        $sql = "CALL usp_returnPlaylistBasedOnUser($tempUser)";
        $result = $connection->query($sql) or die($connection->error);
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            $tempId = $row["id"];
            echo "<td><a href='index.php?page=song&playlistid=$tempId'>" . $row["name"] . "</td>";
            echo "<td>
            <button type='submit' class='btn btn-sm btn-info' name='share'>
                    Share</button>
                  </td>";
            echo "<form method='post' action=''>";
            echo '<td><input class="btn btn-sm btn-danger" type="submit" name="deleteItem" value="'. (int)$row['id'] . '"/></td></form>';

            echo "</tr>";
             }

            //Deleting items
        	if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem']))
            {
            $toDel = (int)$_POST['deleteItem'];
            $userDel = "'" . $_SESSION["user"] . "'";
            $sqlTemp = "CALL usp_delPlaylistFromUser($toDel,$userDel);";
            echo $sqlTemp;
            $con2 = mysqli_connect("localhost","root","","playversity");
            mysqli_query($con2,$sqlTemp);
            }
    }
    
}