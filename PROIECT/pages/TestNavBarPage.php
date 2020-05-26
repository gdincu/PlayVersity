<?php
require_once (__DIR__ . '/../templates/BasePage.php');

class TestnavBarPage extends BasePage {

    private $firstname;
    private $lastname;
    // private $email;
    private $username;
    private $password;
    //private $parola2;

    function render() {
        $this->headerNavBartest();
        $this->continut1();//self::renderContent();
        self::renderFooter();
    }

    function headerNavBartest(){
        include "homeheadertest.html";
    }

    function continut1() {
       include "homecontent.html";
    }

    function continut2() {
        echo "<div>continut</div>";
     }
}