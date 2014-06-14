<?php
function get_dropbox() {
    $page = '
<div class="jumbotron" style="text-align:left;">
    <center><h1>Dropbox</h1></center>
    <br>
    <p>Because the team uses dropbox, it is useful to not only know how to use the app properly but also to know how to maximize your space.  First, if you haven’t already installed dropbox on your computer, you should visit the <a href="/new-computer-setup/" target="_blank">new computer page</a> to install not only that but verbatim (the paperless debate software) and a few other utilities.</p>
    <h2> - <b>Rules and Guidelines</b></h2>
    <p>1. Don’t make new folders in anywhere but your personal tub.  If you think a folder should exist, consult Zuckerman.</p>
    <p>2. Camp files should not be in the common folder structure; only the compiled document should.</p>
    <p>3. To edit a document in the general dropbox, save it to your personal tub prior to any adjustments.</p>
    <p>4. Avoid conflicted copies. </p>
    <p>5. The folder structure inside of “Folder structure template” is the official team copy; no files should be placed in it.</p>
</p>
    <h2> - <b>Getting more space</b> <small>stop bothering us about it</small></h2>
    <p>Every new user on dropbox gets two gigabytes of free cloud storage.  To give you an idea of what that means, a standard files for debate will be 200-1000 kilobytes.  Thus, using 600kB as the average document size, you can store about 3500 documents on a free account.  However, <a href="https://www.dropbox.com/help/15/en" target="_blank">this page</a> outlines many of the ways that you can get more space than the standard two gigabytes.  I would recommend every user complete the <a href="https://www.dropbox.com/gs" target="_blank">Getting Started</a> guide for some easy storage.  Next, download the <a href="http://www.mailboxapp.com/" target="_blank">Mailbox</a> app and link your dropbox account, that will add another gigabyte.  Linking your twitter and facebook accounts gives a little more and won’t really bother you after you link them so it helps.  Finally, <b>refer anyone you can find to dropbox</b>.  This gives you half a gigabyte each time and you can earn up to <b>16</b> gigabytes.</p>
</div>
    ';
    echo $page;
}
?>