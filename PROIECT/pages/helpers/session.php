<?php
/**
 * Session management.
 */

function isLoggedIn() {
    return isset($_SESSION["user"]);
}

function getLoggedInUser() {
    $user = null;
    if (isLoggedIn()) {
        $user = $_SESSION["user"];
    }
    return $user;
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