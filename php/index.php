<?php
ob_start();
session_start();
require("modules/medoo.min.php");
require("modules/class.Page.php");
require("modules/page/class.ErrorPage.php");
require("modules/page/class.HomePage.php");


//TODO: Change the admin account lol
$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'bvswdebate',
    'server' => 'localhost',
    'username' => 'admin',
    'password' => 'admin']);

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

    case "login":
        require("modules/page/class.LoginPage.php");
        $page = new LoginPage();
        $page->writePage();
        break;

    default:
        $page = new ErrorPage("404");
        $page->writePage();
        break;
}
ob_end_flush();
?>