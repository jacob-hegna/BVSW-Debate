<?php
require("modules/class.Page.php");
require("modules/page/class.HomePage.php");
require("modules/page/class.ErrorPage.php");

if(!array_key_exists("p", $_GET)) {
    $page = new HomePage();
    $page->writePage();
    return;
}

switch($_GET['p']) {
    case "home":
        $page = new HomePage();
        $page->writePage();
        break;

    default:
        $page = new ErrorPage("404");
        $page->writePage();
        break;
}
?>