<?php
session_start();

require('../modules/class.Util.php');
require('../modules/medoo.min.php');
require('config.php');

require('util/add-tournament.php');
require('util/sign-in.php');
require('util/logged-in.php');

require('pages/home.php');
require('pages/tournaments.php');
require('pages/sign-in.php');
require('pages/members.php');

$database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'bvswdebate',
    'server' => '127.0.0.1',
    'username' => 'admin',
    'password' => 'admin']);

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
    add_tournament($_POST['add_tournament']['name'], $_POST['add_tournament']['date'], $_POST['add_tournament']['location']);
} else if(array_key_exists('sign_in', $_POST)) {
    sign_in_logic($_POST['sign_in']['email'], $_POST['sign_in']['pass']);
} else if(array_key_exists('sign_out', $_POST)) {
    session_unset();
    session_destroy();
    $_SESSION['loggedin'] = false;
} else if(array_key_exists('logged_in', $_POST)) {
    logged_in();
}

?>