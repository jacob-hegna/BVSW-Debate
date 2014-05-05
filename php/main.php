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

require('pages/home.php');
require('pages/tournaments.php');
require('pages/sign-in.php');
require('pages/members.php');

function alert($level, $title, $text) {
    echo '<div class="alert alert-' . $level . '" style="margin-top: -7px;"><strong>' . $title . '</strong> ' . $text . '</div>';
}

if(!array_key_exists('loggedin', $_SESSION)) {
    $_SESSION['loggedin'] = false;
}

if(array_key_exists('page', $_POST)) {
    switch($_POST['page']) {
        case 'home':
            get_home();
            break;
        case 'tournaments':
            get_tournaments();
            break;
        case 'members':
            get_members();
            break;
        case 'sign_in':
            get_sign_in();
            break;
    }
} else if(array_key_exists('add_tournament', $_POST)) {
    Util::add_tournament($_POST['add_tournament']['name'], $_POST['add_tournament']['date'],
        $_POST['add_tournament']['location']);
} else if(array_key_exists('sign_in', $_POST)) {
    Util::sign_in($_POST['sign_in']['email'], $_POST['sign_in']['pass']);
} else if(array_key_exists('add_user', $_POST)) {
    Util::add_user($_POST['add_user']['email'], $_POST['add_user']['pass'], $_POST['add_user']['name'],
        $_POST['add_user']['num'], $_POST['add_user']['if_text'], $_POST['add_user']['carrier'], $_POST['add_user']['id']);
} else if(array_key_exists('sign_out', $_POST)) {
    session_unset();
    session_destroy();
    $_SESSION['loggedin'] = false;
} else if(array_key_exists('logged_in', $_POST)) {
    Util::logged_in();
}

?>