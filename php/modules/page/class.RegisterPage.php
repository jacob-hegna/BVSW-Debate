<?php
class RegisterPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {
        if(array_key_exists("email", $_POST) && array_key_exists("password", $_POST) && array_key_exists("studentid", $_POST)) {
            global $database;
            $database->insert("accounts", [
                "username" => $_POST['email'],
                "password" => $_POST['password'],
                "student-id" => $_POST['studentid']
            ]);
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Register</h1>
    <form class="form-signin" role="form" method="post">
        <input name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input name="password" class="form-control" placeholder="Password" required="">
        <input name="studentid" class="form-control" placeholder="Student ID" required="">
        <div class="btn-group btn-group-justified" style="margin-top: 10px;">
            <a class="btn btn-lg btn-primary btn-block" type="submit">Register</a>
        </div>
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