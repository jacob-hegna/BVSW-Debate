<?php
session_start();

require('config.php');
require('lib/medoo.min.php');

$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'bvswdebate',
    'server' => SERVER_IP,
    'username' => SERVER_USER,
    'password' => SERVER_PASS]);

require('util.php');
require('pages/pages.php');

if(!array_key_exists('loggedin', $_SESSION)) {
    $_SESSION['loggedin'] = false;
}

if(array_key_exists('page', $_POST)) {
    switch($_POST['page']) {
        case 'home':
            get_home();
            break;
        case 'profile':
            if($_SESSION['loggedin']) {
                get_profile(false);
            } else {
                get_error(403);
            }
            break;
        case 'tournaments':
            get_tournaments();
            break;
        case 'checkout':
            if($_SESSION['loggedin']) {
                get_checkout();
            } else {
                get_error(403);
            }
            break;
        case 'members':
            if($_SESSION['loggedin']) {
                get_members();
            } else {
                get_error(403);
            }
            break;
        case 'about':
            get_about();
            break;
        case 'dropbox':
            get_dropbox();
            break;
        case 'debate-videos':
            get_videos();
            break;
        case 'new-computer-setup':
            get_new_computer();
            break;
        case 'signin':
            get_sign_in();
            break;
        case 'signout':
            session_unset();
            session_destroy();
            $_SESSION['loggedin'] = false;
            echo 'refresh';
            break;
        default:
            if($_POST['page'] != '') {
                get_error(404);
            } else {
                get_home();
            }
            break;
    }
} else if(array_key_exists('util', $_POST)) {
    switch($_POST['util']) {
        case 'add_tournament':
            Util::add_tournament($_POST['attr']['type'], $_POST['attr']['name'],
                            $_POST['attr']['date'], $_POST['attr']['location']);
            break;
        case 'name':
            echo Util::getUser($_SESSION['email'])[$_POST['attr']['type']];
            break;
        case 'sign_in':
            Util::sign_in($_POST['attr']['email'], $_POST['attr']['pass']);
            break;
        case 'add_user':
            Util::add_user($_POST['attr']);
            break;
        case 'sign_out':
            session_unset();
            session_destroy();
            $_SESSION['loggedin'] = false;
            break;
        case 'logged_in':
            Util::logged_in();
            break;
        case 'tournament_table':
            get_tournament_table($_POST['attr']['type']);
            break;
        case 'checkout_table':
            get_checkout_table($_POST['attr']['type']);
            break;
        case 'pick_laptop':
            $database->update('laptops', ['taken' => $_POST['attr']['user']], ['id' => $_POST['attr']['id']]);
            break;
        case 'pick_stand':
            $database->update('stands', ['taken' => $_POST['attr']['user']], ['id' => $_POST['attr']['id']]);
            break;
        default:
            echo '-1'; // failure
            break;
    }
}

?>