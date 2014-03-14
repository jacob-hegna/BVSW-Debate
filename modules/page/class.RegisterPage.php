<?php
class RegisterPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {
        if(array_key_exists("email", $_POST) && array_key_exists("password", $_POST) && array_key_exists("studentid", $_POST)) {
            global $database;
            if(!$database->has('accounts', ['email' => $_POST['email']])) {
                if(!$database->has('accounts', ['number' => $_POST['number']])) {
                    // PHP dark magic won't let me have three $database->has()
                    // I'm so sorry
                    if(!in_array($_POST['studentid'], $database->select('accounts', 'student-id'))) {
                        $database->insert("accounts", [
                            "email" => $_POST['email'],
                            "password" => hash('sha256', $_POST['password']),
                            "student-id" => $_POST['studentid'],
                            "number" => $_POST['number'],
                            "first" => $_POST['first'],
                            "last" => $_POST['last']
                        ]);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $_POST['email'];
                        header("location: ?p=home");
                    } else {
                        self::alert('danger', 'Error!', 'Database already contains ' . $_POST['studentid'] . '!');
                    }
                } else {
                    self::alert('danger', 'Error!', 'Database already contains ' . Util::formatPhoneNum($_POST['number']) . '!');
                }
            } else {
                self::alert('danger', 'Error!', 'Database already contains ' . $_POST['email'] . '!');
            }
        } else {
            if(array_key_exists('submit', $_POST)) {
                self::alert('danger', 'Error!', 'All forms must be filled out!');
            }
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>Register</h1>
    <form class="form-signin" role="form" method="post">
        <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="password" class="form-control" placeholder="Password" required="">
        <input type="text" name="studentid" class="form-control" placeholder="Student ID" required="">
        <input type="tel" name="number" class="form-control" placeholder="Phone Number" required="">
        <input name="first" class="form-control" placeholder="First name" required="">
        <input name="last" class="form-control" placeholder="Last name" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
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