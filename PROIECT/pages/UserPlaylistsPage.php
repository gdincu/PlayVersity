<?php
require_once (__DIR__ . '/../templates/BasePage.php');

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
        //$sql = CALL usp_returnPlaylistBasedOnUser();
        global $connection;
        $result = $connection->query("CALL usp_returnPlaylistBasedOnUser(1);");
    
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