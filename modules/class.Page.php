<?php
abstract class Page {
    public function __construct() {

    }

    public function writePageStart() {
        $pageStart = 
'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BVSW Debate</title>
    <link rel="shortcut icon" href="static/img/favicon.ico">
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/theme.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse">
                <a href="?p=home" class="navbar-brand">BVSW Debate</a>
                <a href="?p=tournaments" class="btn btn-default navbar-btn">Tournaments</a>';
                if(array_key_exists('loggedin', $_SESSION)) {
                    $pageStart .= ($_SESSION['loggedin'] == true ? '<a href="?p=members" class="btn btn-default navbar-btn">Members</a>' : '');
                }

        if(array_key_exists("loggedin", $_SESSION)) {
            if($_SESSION['loggedin'] == true) {
                $pageStart .=
'               <a class="btn btn-default navbar-btn pull-right" href="?p=logout">Log out</button>
                <a href="?p=profile" class="btn btn-default navbar-btn pull-right">Hello, ' . Util::getUser($_SESSION['email'])['first'] . '!</a>';
            } else {
                $pageStart .=
'               <a href="?p=login" class="btn btn-default navbar-btn pull-right">Login</a>';
            }
        } else {
            $pageStart .=
'               <a href="?p=login" class="btn btn-default navbar-btn pull-right">Login</a>';
        } 

        $pageStart .=
'           </div>
        </div>
    </div>
    <div id="wrap">
        <div class="container">
';
        echo $pageStart;
    }

    abstract function writePageContent();

    public function writePageEnd() {
        $pageEnd = 
'       </div>
    </div>
    <div id="footer">
        <div class="container" id="creditContainer">
            <p class="credit">The BVSW homepage site is being developed by <a href="http://jacobhegna.subd.in/" target="_blank">Jacob Hegna</a>.  The <a href="https://github.com/jacob-hegna/BVSW-Debate/" target="_blank">source code</a> is hosted on Github.</p>
        </div>
    </div>
    <script src="static/js/jquery-2.1.0.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
</body>
</html>';
        echo $pageEnd;
    }

    public function alert($level, $title, $text) {
        echo '<div class="alert alert-' . $level . '" style="margin-top: -7px;"><strong>' . $title . '</strong> ' . $text . '</div>';
    }
}
?>