<?php
/**
 * Session management.
 */

function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function storeUserToSession($userFinal,$passwordFinal) {
    //Session management.
    $_SESSION["user"] = $userFinal;
    $_SESSION["password"] = $passwordFinal;
}

if(!isLoggedIn()) {
    session_start();
}
?>