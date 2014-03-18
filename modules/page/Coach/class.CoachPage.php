<?php
class CoachPage extends Page {
    private $userEmail;

    public function __construct($email) {
        parent::__construct();
        $this->userEmail = $email;
    }

    public function writeHeader() {
        $header = 
'<div class="jumbotron" style="text-align:left;">
    <ul id="navbar" class="nav nav-pills">
        <li id="gen-tab" class="active"><a href="?p=profile&s=general">General</a></li>
        <li id="tourny-tab"><a href="?p=profile&s=tournaments">Tournament registration</a></li>
    </ul>
    <center><h1>' . Util::getUser($this->userEmail)['first'] . ' ' . Util::getUser($this->userEmail)['last'] . '</h1></center>';
    
        echo $header;
    }

    public function writePageContent() {
        self::writeHeader();
        $body;
        if(!array_key_exists('s', $_GET)) {
            require('class.CoachGen.php');
            $body = new CoachGen($this->userEmail);
            $general = true;
        } else {
            switch($_GET['s']) {
                case 'general':
                    require('class.CoachGen.php');
                    $body = new CoachGen($this->userEmail);
                    $general = true;
                    break;

                case 'tournaments':
                    require('class.CoachTournament.php');
                    $body = new CoachTournament($this->userEmail);
                    break;

                default:
                    require('class.CoachGen.php');
                    $body = new CoachGen($this->userEmail);
                    $general = true;
                    break;
            }
        }
        $body->write();
        self::writeFooter();
    }

    public function writeFooter() {
        $footer =
'</div>';
        echo $footer;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>