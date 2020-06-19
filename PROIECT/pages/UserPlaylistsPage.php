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
        $userId = getLoggedInUserId();
        
        global $connection;
        $result = $connection->query("CALL usp_returnPlaylistBasedOnUser($userId);");
    
        foreach($result as $rowResult) {
            var_dump($rowResult);
            $out = '';
            $out .= '<tr>';
            $out .= '<td>'. $rowResult['name'] .'</td>';
            $out .= '</tr>';
            echo $out;
        }
    }
    
}