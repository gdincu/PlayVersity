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

function getLoggedInUserId() {
    $userId = 0;
    if (isLoggedIn()) {
        $userId = $_SESSION["userid"];
    }
    return $userId;
}

function storeUserToSession($userFinal,$passwordFinal, $userId) {
    //Session management.
    $_SESSION["user"] = $userFinal;
    $_SESSION["password"] = $passwordFinal;
    $_SESSION["userid"] = $userId;
}

session_start();
?>