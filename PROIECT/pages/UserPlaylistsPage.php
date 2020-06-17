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
            echo "</tr>";
             }
    }
    
}