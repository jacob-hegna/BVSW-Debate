<?php
function logged_in() {
    if($_SESSION['loggedin']) {
        echo '1';
    } else {
        echo '0';
    }
}
?>