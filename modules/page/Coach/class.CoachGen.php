<?php
class CoachGen {
    private $userEmail;

    public function __construct($email) {
        $this->userEmail = $email;
    }

    public function writeBody() {
        global $database;
        $content = '';

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
                            <button name="contactSub" type="submit" class="btn btn-primary btn-sm">Update details</button>
                        </form>';
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
                </ul>';
        }
        $content .= '
        </div>
    <a style="float: left" class="btn btn-primary btn-sm" href="?p=profile' . (array_key_exists("edit", $_GET) ? "" : "&edit") . '">' . (array_key_exists("edit", $_GET) ? "Done" : "Edit account") . '</a></button> 
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

    public function write() {
        self::logic();
        self::writeBody();
    }
}
?>