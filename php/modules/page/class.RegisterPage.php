<?php
class RegisterPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {
        if(array_key_exists("email", $_POST) && array_key_exists("password", $_POST) && array_key_exists("studentid", $_POST)) {
            global $database;
            $database->insert("accounts", [
                "email" => $_POST['email'],
                "password" => hash('sha256', $_POST['password']),
                "student-id" => $_POST['studentid'],
                "first" => $_POST['first'],
                "last" => $_POST['last']
            ]);
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Register</h1>
    <form class="form-signin" role="form" method="post">
        <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <input name="studentid" class="form-control" placeholder="Student ID" required="">
        <input name="first" class="form-control" placeholder="First name" required="">
        <input name="last" class="form-control" placeholder="Last name" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>
</div>';
        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::logic();
        self::writePageEnd();
    }
}
?>