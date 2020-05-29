<?php
    require_once "db_setup/db_connect.php";
    require_once "pages/helpers/access.php";
    // https://stackoverflow.com/questions/2418473/difference-between-require-include-require-once-and-include-once
    
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    $requestedPage = ucwords($page) . 'Page';
    $pageLocation = 'pages/'. $page . 'Page.php';
    if (file_exists($pageLocation)) {
        require_once $pageLocation;
        $currentPage = new $requestedPage;
        $currentPage->renderHead();
        $currentPage->startBody();
        $currentPage->render();
        //Song.php
        include "pages/helpers/song.php";
        $currentPage->endBody();
    } else {
        require_once (__DIR__."/pages/ErrorPage.php");
        $currentPage = new ErrorPage();
        $currentPage->render();
    }
?>