<?php
class ProfilePage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function writePageContent() {
        global $database;

        $content = 
'<div class="jumbotron" style="text-align:left;">
    <a href="?p=profile' . (array_key_exists("edit", $_GET) ? "" : "&edit") . '" class="btn btn-primary btn-sm" style="float: right;">' . (array_key_exists("edit", $_GET) ? "Done" : "Edit account") . '</a>
    <center><h1>' . Util::getUser($_SESSION['email'])['first'] . ' ' . Util::getUser($_SESSION['email'])['last'] . '</h1></center>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">Information</div>
                    <ul class="list-group" style="line-height: 1;">
                    <li class="list-group-item">
                    <span class="badge">' . Util::getUser($_SESSION['email'])['tournaments'] . '</span>
                    Tournaments
                    </li>
                    <li class="list-group-item">
                    <span class="badge">' . Util::getRank(Util::getUser($_SESSION['email'])['rank']) . '</span>
                    Rank
                    </li>
                    </ul>
                </div>
            </div>
        <div class="col-md-8">';
        if(array_key_exists('edit', $_GET)) {
            $content .= '
            <div class="panel">
                <div class="panel-heading">Change Password</div>
                    <form method="POST" style="padding: 10px 10px 10px 10px;">
                        <input class="form-control" type="password" name="oldPassword" placeholder="Current password" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                        <input class="form-control" type="password" name="newPassword" placeholder="New password" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-top-left-radius: 0; border-top-right-radius: 0;">
                        <input class="form-control" type="password" name="checkNewPassword" placeholder="Confirm new password" style="border-top-left-radius: 0; border-top-right-radius: 0;">
                        <button name="passSub" type="submit" class="btn btn-primary btn-sm">Change password</button>
                    </form>
                </div>
                <div class="panel">
                    <div class="panel-heading">Contact Details</div>
                        <form method="POST" style="padding: 10px 10px 10px 10px;">
                            <input class="form-control" type="text" name="email" placeholder="Email" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;" value="' . $_SESSION['email'] . '">
                            <input class="form-control" type="text" name="phone" placeholder="Phone number" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-top-left-radius: 0; border-top-right-radius: 0;" value="' . Util::getUser($_SESSION['email'])['number'] . '">
                            <input class="form-control" type="text" name="studentid" placeholder="Student ID" style="border-top-left-radius: 0; border-top-right-radius: 0;" value="' . Util::getUser($_SESSION['email'])['student-id'] . '">
                            <button name="contactSub" type="submit" class="btn btn-primary btn-sm">Update details</button>
                        </form>
                    </div>
                </div>';
        } else {
            $content .= '
            <div class="panel">
                <div class="panel-heading">Contact Details</div>
                <ul class="list-group" style="line-height: 1;">
                <li class="list-group-item">
                <span class="badge">' . $_SESSION['email'] . '</span>
                Email address
                </li>
                <li class="list-group-item">
                <span class="badge">' . Util::formatPhoneNum(Util::getUser($_SESSION['email'])['number']) . '</span>
                Phone number
                </li>
                <li class="list-group-item">
                <span class="badge">' . Util::getUser($_SESSION['email'])['student-id'] . '</span>
                Student ID
                </li>
                </ul>
            </div>';
        }
        $content .= '
        </div>
    </div>
</div>';
        echo $content;
    }

    public function changePassword() {
        if(hash('sha256', $_POST['oldPassword']) === Util::getUser($_SESSION['email'])['password']) {
            if($_POST['newPassword'] === $_POST['checkNewPassword']) {
                Util::editUser($_SESSION['email'], 'password', hash('sha256', $_POST['newPassword']));
            }
        }
    }

    public function changeContact() {
        Util::editUser($_SESSION['email'], 'email', $_POST['email']);
        $_SESSION['email'] = $_POST['email'];
        Util::editUser($_SESSION['email'], 'number', $_POST['phone']);
        Util::editUser($_SESSION['email'], 'student-id', $_POST['studentid']);

    }

    public function logic() {
        if(array_key_exists('edit', $_GET)) {
            if(array_key_exists('passSub', $_POST)) {
                self::changePassword();
            }

            if(array_key_exists('contactSub', $_POST)) {
                self::changeContact();
            }
        }
    }

    public function writePage() {
        self::writePageStart();
        self::logic();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>