<?php
//Managementul sesiunii

if(!isLoggedIn()) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function storeUserToSession() {
    //Managementul sesiunii
    $_SESSION["user"] = $userFinal;
    $_SESSION["password"] = $passwordFinal;
}
