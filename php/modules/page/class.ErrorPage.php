<?php
class ErrorPage extends Page {
    private $error;
    private $details;

    public function __construct($ERROR) {
        parent::__construct();
        global $error, $details;
        $error = $ERROR;
        switch($error) {
            case 404:
                $details = "Page not found.";
                break;
        }
    }

    public function writePageContent() {
        global $error, $details;
        $content = 
'<div class="jumbotron">
<p>Error (' . $error . '): ' . $details . '</p>' .
'<a class="btn btn-primary btn-lg" href="http://homepage-jacobhegna.rhcloud.com/?p=home">Back to home</a>
</div>';
        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>