<?php
require_once (__DIR__ . '/../templates/BasePage.php');

class LibraryPage extends BasePage {
    function render() {
        self::renderHeader();
        $this->continut2();//self::renderContent();
        self::renderFooter();
    }

    function continut1() {
       include "resetpassword.html";
    }

    function continut2() {
        echo "<div>continut</div>";
     }
}
