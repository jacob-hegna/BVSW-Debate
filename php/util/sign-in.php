<?php
function sign_in_logic($email, $pass) {
    global $database;

    if($database->has('accounts', ['email' => $email])) {
        $userPass = $database->get('accounts', 'password', ['email' => $email]);
        if(hash('sha256', $pass) === $userPass) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            echo 'success';
        } else {
            echo 'password';
        }
    } else {
        echo $email . ' email';
    }
}
?>