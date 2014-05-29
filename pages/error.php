<?php
function get_error($code) {
    $details;
    switch($code) {
        case 403:
            $details = 'Forbidden: You do not have the credentials to access this page.';
            break;
        case 404:
            $details = 'Page not found.';
            break;
    }
    $page = new Page();
    $page->update('<p>Error ('.$code.'): '.$details.'</p>');
    $page->bottom = '
</div>
<center>
    <img class="animated fadeInDown" src="/static/img/404.jpg" width="400px"</img>
</center>';
    $page->write();
}
?>