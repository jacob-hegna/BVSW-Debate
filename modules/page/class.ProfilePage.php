<?php
class ProfilePage extends Page {
    private $userEmail;

    public function __construct($email) {
        parent::__construct();
        $this->userEmail = $email;
    }

    public function writePageContent() {
        global $database;

        $content = 
'<div class="jumbotron" style="text-align:left;">
    ' . ($this->userEmail == $_SESSION['emai'] ? '<a href="?p=profile' . (array_key_exists("edit", $_GET) ? "" : "&edit") . '" class="btn btn-primary btn-sm" style="float: right;">' . (array_key_exists("edit", $_GET) ? "Done" : "Edit account") . '</a>' : '') . '
    <center><h1>' . Util::getUser($this->userEmail)['first'] . ' ' . Util::getUser($this->userEmail)['last'] . '</h1></center>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-heading">Information</div>
                    <ul class="list-group" style="line-height: 1;">
                    <li class="list-group-item">
                    <span class="badge">' . Util::getUser($this->userEmail)['tournaments'] . '</span>
                    Tournaments
                    </li>
                    <li class="list-group-item">
                    <span class="badge">' . Util::getRank(Util::getUser($this->userEmail)['rank']) . '</span>
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
                            <input class="form-control" type="text" name="email" placeholder="Email" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;" value="' . $this->userEmail . '">
                            <input class="form-control" type="text" name="phone" placeholder="Phone number" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-top-left-radius: 0; border-top-right-radius: 0;" value="' . Util::getUser($this->userEmail)['number'] . '">
                            <input class="form-control" type="text" name="studentid" placeholder="Student ID" style="border-top-left-radius: 0; border-top-right-radius: 0;" value="' . Util::getUser($this->userEmail)['student-id'] . '">
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
                <span class="badge">' . $this->userEmail . '</span>
                Email address
                </li>
                <li class="list-group-item">
                <span class="badge">' . Util::formatPhoneNum(Util::getUser($this->userEmail)['number']) . '</span>
                Phone number
                </li>
                <li class="list-group-item">
                <span class="badge">' . Util::getUser($this->userEmail)['student-id'] . '</span>
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
        if(hash('sha256', $_POST['oldPassword']) === Util::getUser($this->userEmail)['password']) {
            if($_POST['newPassword'] === $_POST['checkNewPassword']) {
                Util::editUser($this->userEmail, 'password', hash('sha256', $_POST['newPassword']));
            }
        }
    }

    public function changeContact() {
        Util::editUser($this->userEmail, 'email', $_POST['email']);
        $this->userEmail = $_POST['email'];
        Util::editUser($this->userEmail, 'number', $_POST['phone']);
        Util::editUser($this->userEmail, 'student-id', $_POST['studentid']);

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