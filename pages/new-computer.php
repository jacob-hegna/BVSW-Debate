<?php
function get_new_computer() {
    $page = '
<div class="jumbotron" style="text-align:left;">
    <center><h1>New Computer Setup</h1></center>
    <br>
    <p>Even if you are not using a laptop to debate, there are certain programs that every debater will want installed in order to help with things like cutting cards and navigating the dropbox.</p>
    <p> - <b><a href="https://www.dropbox.com/" target="_blank">Dropbox</a></b> This is the main application every debater must install.  It allows access to all the team\'s files.  However, before you can access the files, someone must invite you to the team shared folder.  I would highly recommend you get a friend or teammate to invite you to dropbox, however, because it will increase their maximum storage.</p>
    <p> - <b><a href="http://paperlessdebate.com/verbatim/_layouts/15/start.aspx#/SitePages/Home.aspx" target="_blank">Verbatim</a></b> This is the template you will need to format evidence for debate.  It is possible to debate without it (unlike dropbox) however this makes it much easier.</p>
    <p> - <b><a href="http://www.voidtools.com/download.php" target="_blank">Search Everything</a> (Windows only)</b> This is a program which will instantly search every file on your computer.  This is probably the greatest thing ever, I use it daily for things unrelated to debate as well.  The only downside is that it only searches the names of the files, not the contents.  If you\'re in a debate and you don\'t know where a file is, this app will.</p>
    <p> - <b><a href="http://www.alfredapp.com/" target="_blank">Alfred</a> (Mac only)</b> This program functions similarly to spotlight (the search icon in the top right hand of your screen), but it is better in almost every way.  It will search applications, music, files, and the internet.  For debate it offers a similar utility as Search Everything, however with one massive benefit - it will search the contents of files as well.</p>
</div>
    ';
    echo $page;
}
?>