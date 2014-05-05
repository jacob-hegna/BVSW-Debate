<?php
function add_tournament($name, $date, $loc) {
    global $database;
    $database->insert('tournaments', [
                'name' => $name,
                'date' => $date,
                'location' => $loc,
                'register' => '[]',
                'attend'   => '[]']);
    echo get_tournaments();
}
?>