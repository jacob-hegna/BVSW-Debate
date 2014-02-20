<?php
class LoginPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {

        if(array_key_exists("email", $_POST) && array_key_exists("password", $_POST)) {
            global $database;

            $email = $_POST['email'];
            $pass = $_POST['password'];

            $userPass = $database->get('accounts', 'password', ['username' => $user]);

            if (hash('sha256', $pass) === $userPass) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['first'] = $database->get('accounts', 'first', ['username' => $user]);
                $_SESSION['last'] = $database->get('accounts', 'last', ['username' => $user]);
                $_SESSION['studentid'] = $database->get('accounts', 'student-id', ['username' => $user]);
                header("location: ?p=home");
            }
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Login</h1>
    <form method="post">
        <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <div class="btn-group btn-group-justified" style="margin-top: 0px;">
            <button style="width:100%;" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a style="width:50%;" class="btn btn-lg btn-primary btn-block" href="?p=register">Register</a>
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