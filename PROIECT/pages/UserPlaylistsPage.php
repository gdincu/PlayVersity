<?php
ob_start();
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
            
            //Shared checkbox
            //TO BE REVIEWED - would need a double refresh of the current page
            echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '">';   
            echo '<td><input type="checkbox" hidden name="checkedValue" checked value="'. (int)$row['id'] . '">';
            echo ($row["shared"] == "0") ? 
            '<button type="submit" class="btn btn-sm btn-info" name="shareItem">Share</button>' : 
            '<button type="submit" class="btn btn-sm btn-info" name="shareItem">Unshare</button>';
            echo '</td></form>';

            

            //Delete button
            echo '<form method="post" action="">';   
            echo '<td><button type="submit" class="btn btn-sm btn-danger" name="deleteItem" value="'. (int)$row['id'] . '">Delete</button></td></form>';
            echo "</tr>";
             }

            //Deleting items
        	if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem']))
            {
            header("Refresh:0");                
            $toDel = (int)$_POST['deleteItem'];
            $userDel = "'" . $_SESSION["user"] . "'";
            $sqlTemp = "CALL usp_delPlaylistFromUser($toDel,$userDel);";
            $con2 = mysqli_connect("localhost","root","","playversity");
            mysqli_query($con2,$sqlTemp);
            }

            //Update the shared value when checked/ unchecked
            if(isset($_POST['shareItem']))
            {
            header("Refresh:0");                
            $toDel = $_POST['checkedValue']; //playlistid
            $sqlTemp = "CALL usp_changeShareStatus($toDel);";
            $con2 = mysqli_connect("localhost","root","","playversity");
            mysqli_query($con2,$sqlTemp);
            }
            
    }
    
}