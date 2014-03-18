<?php
class CoachTournament {
    private $userEmail;

    public function __construct($email) {
        $this->userEmail = $email;
    }

    public function writeBody() {
        global $database;
        $content = 
'';
        echo $content;
    }


    public function logic() {
    }

    public function write() {
        self::logic();
        self::writeBody();
    }
}
?>