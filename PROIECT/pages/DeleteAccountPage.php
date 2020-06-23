<?php
require_once (__DIR__ . '/../templates/BasePage.php');
require_once (__DIR__ . '/../db_setup/db_connect.php');
require_once "helpers/session.php";

class DeleteAccountPage extends BasePage {
  
    function render() {
        self::renderHeader();
        $this->renderContent();   
        self::renderFooter();
    }

    function renderContent() {
       include "deleteaccountpagecontent.html";
       include "helpers/delete.php";
    }

}
?>