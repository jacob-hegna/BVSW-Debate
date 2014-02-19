<?php
class LoginPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        global $database;
        $userRow = $database->select('accounts', [
            'password', 'id'], [
            'username'=>$user]);
        if (hash('sha256', $pass) === $userRow[0]['password']) {
            $_SESSION['loggedin'] = true;
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Login</h1>
    <form class="form-signin" role="form" method="post">
        <input type="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>';
        echo $content;
    }

    public function writePage() {
        self::logic();
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>