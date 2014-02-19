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
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/theme.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="collapse navbar-collapse">
                <a href="?p=home" class="navbar-brand">BVSW Debate</a>
                <a href="?p=tournaments" class="btn btn-default navbar-btn">Tournaments</a>
                <a href="?p=login" class="btn btn-default navbar-btn pull-right">Login</a>
            </div>
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
            <p class="credit">The BVSW homepage site is being developed by <a href="http://homepage-jacobhegna.rhcloud.com/" target="_blank">Jacob Hegna</a>.  The <a href="https://github.com/jacob-hegna/BVSW-Debate/" target="_blank">source code</a> is hosted on Github</p>
        </div>
    </div>
    <script src="static/js/jquery-2.1.0.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
</body>
</html>';
        echo $pageEnd;
    }
}
?>