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

            if($database->has('accounts', ['email' => $email])) {
                $userPass = $database->get('accounts', 'password', ['email' => $email]);
                if(hash('sha256', $pass) === $userPass) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    header("location: ?p=home");
                } else {
                    self::alert('danger', 'Error!', 'Incorrect password!');
                }
            } else {
                self::alert('danger', 'Error!', 'Email not in database!');
            }
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Login</h1>
    <form method="post">
        <fieldset><input type="email" name="email" class="form-control" maxlength="40" placeholder="Email address" required="" autofocus=""></fieldset>
        <fieldset><input type="password" name="password" class="form-control" placeholder="Password" required=""></fieldset>
        <div class="btn-group btn-group-justified" style="margin-top: 0px;">
            <button style="width:100%;" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a style="width:50%;" class="btn btn-lg btn-primary btn-block" href="?p=register">Register</a>
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