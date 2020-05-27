<?php
//Managementul sesiunii

function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function storeUserToSession($userFinal,$passwordFinal) {
    //Managementul sesiunii
    $_SESSION["user"] = $userFinal;
    $_SESSION["password"] = $passwordFinal;
}

if(!isLoggedIn()) {
    session_start();
}
?>