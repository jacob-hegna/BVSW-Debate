<?php
function get_tournaments() {
    $page = new Tabbed();
    $page->setTabs('Tournament Schedule', ['Novice', 'Open', 'Varsity', 'TOC'], 'tournament_table', 'tournaments');
    $page->write();
}
?>