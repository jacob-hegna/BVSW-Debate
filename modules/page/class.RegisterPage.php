<?php
class RegisterPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function logic() {
        if(array_key_exists("email", $_POST) && array_key_exists("password", $_POST) && array_key_exists("studentid", $_POST)) {
            global $database;
            if($_POST['verification'] == 'kdsupa') {
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
                self::alert('danger', 'Error!', 'Verification code is incorrect!');
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
    <form role="form" method="post">
        <fieldset><input type="email" name="email" class="form-control" maxlength="40" placeholder="Email address" required="" autofocus=""></fieldset>
        <fieldset><input type="password" name="password" class="form-control" placeholder="Password" required=""></fieldset>
        <fieldset><input type="text" name="studentid" class="form-control" maxlength="10" placeholder="Student ID" required=""></fieldset>
        <fieldset><input type="tel" name="number" class="form-control" maxlength="10" placeholder="Phone Number" required=""></fieldset>
        <fieldset><input type="text" name="first" class="form-control" maxlength="30" placeholder="First name" required=""></fieldset>
        <fieldset><input type="text" name="last" class="form-control" maxlength="30" placeholder="Last name" required=""></fieldset>
        <fieldset><input id="verification-box" type="text" name="verification" class="form-control" placeholder="Verification code" required=""></fieldset>
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