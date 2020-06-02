<?php
require_once (__DIR__ . '/../templates/BasePage.php');

class UserPage extends BasePage {

    private $sql;

    function render() {
        self::renderHeader();
        $this->content();//self::renderContent();
        self::renderFooter();
    }

    function content() {
       include "userpagecontent.html";
    }

    function returnPlaylistBasedOnUser() {
        //$sql = CALL usp_returnPlaylistBasedOnUser();
        $result = $connection->query("CALL usp_returnPlaylistBasedOnUser;");
    }
    
}