<?php
function get_about() {
    $content = '
<div class="jumbotron">
    <h1>About</h1>
    <div class="container" style="text-align:left;">
        <br>
        <p>This is the (un)official website for the Blue Valley Southwest debate team.  We compete on a local, state-wide, and national level and have found success at all three.</p>
        <p>The website is being developed by <a target="_blank" href="http://jacob-hegna.github.io/">Jacob Hegna</a> and is running on a debian server at his house.  It is fully open source and any contributions are welcome at the official <a target="_blank" href="https://github.com/jacob-hegna/bvswdebate">github repository</a>.</p>
    </div>
</div>';
    echo $content;
}
?>