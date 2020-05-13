<?php

require_once (__DIR__ . '/../templates/BasePage.php');

class HomePage extends BasePage {

    private $prenume;
    private $nume;
    private $email;
    private $user;
    private $parola;
    private $parola2;
    
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
    }
}