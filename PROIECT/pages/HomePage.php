<?php

require_once (__DIR__ . '/../templates/BasePage.php');
require_once (__DIR__ . '/helpers/save_user_into_db.php');

//require_once(__DIR__ . '/../db_setup/db_connect.php');

class HomePage extends BasePage {

    private $firstname;
    private $lastname;
    private $username;
    private $password;
    
    public function render() {
        $this->renderHeader();
        $this->renderContent();
        self::renderFooter();
    }

    function renderHeader() {
        include "homeheader.html";
    }

    function renderContent() {
        //echo file_get_contents(__DIR__ ."/homepage.html");
        include "homecontent.html";

        // use the data only once
        unset($_SESSION["error"]);
    }
}