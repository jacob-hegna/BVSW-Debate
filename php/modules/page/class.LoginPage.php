<?php
class LoginPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {

        if(array_key_exists("email", $_POST) && array_key_exists("password", $_POST)) {
            $user = $_POST['email'];
            $pass = $_POST['password'];

            $userRow = $database->select('accounts', [
                'password', 'id'], [
                'email'=>$user]);

            if (hash('sha256', $pass) === $userRow[0]['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $user;
            }
        }

        /*        
        $user = $_POST['username'];
        $pass = $_POST['password'];
        global $database;
        $userRow = $database->select('accounts', [
            'password', 'id'], [
            'username'=>$user]);
        if (hash('sha256', $pass) === $userRow[0]['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user;
        }
        */
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Login</h1>
    <form class="form-signin" role="form" method="post">
        <input type="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" class="form-control" placeholder="Password" required="">
        <div class="btn-group btn-group-justified" style="margin-top: 10px;">
            <a class="btn btn-lg btn-primary btn-block" type="submit">Sign in</a>
            <a class="btn btn-lg btn-primary btn-block" type="submit">Register</a>
        </div>
    </form>
</div>';
        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::logic();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>