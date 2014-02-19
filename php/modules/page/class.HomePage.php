<?php
class HomePage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function writePageContent() {
        $content = 
'<div class="jumbotron">
    <h1>BVSW Debate</h1>
    <h3>#NoDaysOff</h3>';

        if(array_key_exists("loggedin", $_SESSION)) {
            if($_SESSION['loggedin']) {
                $content .=
'   <p>' . $_SESSION['username'] . '</p>';
            }
        }

        $content .=
'</div>
<center>
<img src="static/img/splash.jpg" width="600px"</img>
</center>';
        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>