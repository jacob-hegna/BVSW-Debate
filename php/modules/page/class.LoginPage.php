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
                echo'<div class="jumbotron"><h1>FUCKYOUPHP</h1></div>';
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
    <form method="post">
        <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <div class="btn-group btn-group-justified" style="margin-top: 10px;">
            <a class="btn btn-lg btn-primary btn-block" type="submit">Sign in</a>
            <a class="btn btn-lg btn-primary btn-block" href="?p=register">Register</a>
        </div>
    </form>
</div>';
        echo $content;
                if(isset($_POST['submit'])) echo '<div class=jumbotron><h1>' . $_POST['email'] . '</h1></div>';
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::logic();
        self::writePageEnd();
    }
}
?>