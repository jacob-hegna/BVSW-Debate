<?php
class HomePage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>BVSW Debate</h1>
    <h3>#NoDaysOff</h3>
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