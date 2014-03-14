<?php
class ErrorPage extends Page {
    private $error;
    private $details;

    public function __construct($ERROR) {
        parent::__construct();
        $this->error = $ERROR;
        switch($error) {
            case 403:
                $this->details = "Forbidden, You do not have the credentials to access this page.";
                break;

            case 404:
                $this->details = "Page not found.";
                break;
        }
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
<p>Error (' . $this->error . '): ' . $this->details . '</p>' .
'<a class="btn btn-primary btn-lg" href="?p=home">Back to home</a>
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