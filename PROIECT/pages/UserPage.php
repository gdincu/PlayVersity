<?php
require_once (__DIR__ . '/../templates/BasePage.php');

class UserPage extends BasePage {
    function render() {
        $this->renderHeader();
        $this->renderContent();//self::renderContent();
        self::renderFooter();
    }

    function renderHeader() {
        include "userpageheader.html";
     }

    function renderContent() {
       include "userpagecontent.html";
    }

    function continut2() {
        echo "<div>continut</div>";
     }
}