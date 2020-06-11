<?php
require_once (__DIR__ . '/../templates/BasePage.php');
require_once (__DIR__ . '/../db_setup/db_connect.php');
require_once "helpers/session.php";

class UserPage extends BasePage {
    private $userFirstName = '';
    private $userLastName = '';
    private $userImage = '';

    function render() {
        $this->fetchDbContent();

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

    function fetchDbContent() {
        if (isLoggedIn()) {
            $user = getLoggedInUser();
            $sql = "SELECT image, firstname, lastname FROM user WHERE username='$user'";
            global $connection;
            $result = $connection->query($sql);
    
            //Mesaje pentru client la logare
            if($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->userFirstName = $row['firstname'];
                $this->userLastName = $row['lastname'];
                $imageContent = $row["image"];
                if (!empty($imageContent)) {
                    $this->userImage = 'data:image/jpeg;base64,'. base64_encode($imageContent); 
                }
            } else {
                $this->userImage = "No Content";
            }
        }
    }
}