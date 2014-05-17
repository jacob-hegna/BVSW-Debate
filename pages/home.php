<?php
function get_home() {
    $page =
'
<div class="jumbotron" style="position:relative;">
    <div class="hidden-xs">
        <a href="https://github.com/jacob-hegna/bvswdebate" target="_blank"><img style="position:absolute;top:0;right:0;" src="/static/img/github.png" alt="Fork me on GitHub"></a>
    </div>
    <div class="visible-xs">
        <a href="https://github.com/jacob-hegna/bvswdebate" target="_blank"><img width="100px" style="position:absolute;top:0;right:0;" src="/static/img/github.png" alt="Fork me on GitHub"></a>
    </div>
    <h1>BVSW Debate</h1>
    <h3>#NoDaysOff</h3>
</div>
<center>
    <div class="hidden-xs">
        <img class="animated fadeInDown" src="/static/img/splash.jpg" width="600px"</img>
    </div>
    <div class="visible-xs">
        <img class="animated fadeInDown" src="/static/img/splash.jpg" width="300px"</img>
    </div>
</center>
';
    echo $page;
}
?>