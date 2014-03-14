<?php
ini_set('display_errors','On');
ini_set('error_reporting','E_ALL | E_STRICT');
error_reporting(E_ALL);

session_start();
ob_start();

require("../modules/medoo.min.php");
require("../modules/class.Util.php");
require("../modules/class.Page.php");
require("../modules/page/class.HomePage.php");
require("../modules/page/class.ErrorPage.php");

if(!array_key_exists('loggedin', $_POST)) {
    $_POST['loggedin'] = false;
}
/*
$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'bvswdebate',
    'server' => '127.0.0.1',
    'username' => 'admin',
    'password' => 'admin']);
*/

$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'bvswdebate',
    'server' => '127.9.133.130',
    'username' => 'adminqx8tzxJ',
    'password' => '8Zb9h8xitpfy']);

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

    case "tournaments":
        require("../modules/page/class.TournamentsPage.php");
        $page = new TournamentsPage();
        $page->writePage();
        break;

    case "members":
        require("../modules/page/class.MemberPage.php");
        $page = new MemberPage();
        $page->writePage();
        break;

    case "profile":
        require("../modules/page/class.ProfilePage.php");
        $page = new ProfilePage();
        $page->writePage();
        break;

    case "login":
        require("../modules/page/class.LoginPage.php");
        $page = new LoginPage();
        $page->writePage();
        break;

    case "logout":
        session_unset();
        session_destroy();
        header('location: ?p=home');
        $_SESSION['loggedin'] = false;
        break;

    case "register":
        require("../modules/page/class.RegisterPage.php");
        $page = new RegisterPage();
        $page->writePage();
        break;

    default:
        $page = new ErrorPage("404");
        $page->writePage();
        break;
}
ob_end_flush();
?>