<?php
class LoginPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function writePageContent() {
        $content = 
'';

        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>