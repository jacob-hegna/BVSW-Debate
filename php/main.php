<?php
session_start();

require('pages/home.php');
require('pages/tournaments.php');
require('pages/sign-in.php');
require('../modules/medoo.min.php');
require('../config.php');

$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'bvswdebate',
    'server' => '127.0.0.1',
    'username' => 'admin',
    'password' => 'admin']);

if(!array_key_exists('loggedin', $_SESSION)) {
    $_SESSION['loggedin'] = false;
}

if(array_key_exists('page', $_POST)) {
    switch($_POST['page']) {
        case 'home':
            get_home();
            echo 'test';
            break;
        case 'tournaments':
            get_tournaments();
            break;
        case 'sign-in':
            get_sign_in();
            break;
    }
}

?>