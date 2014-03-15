<?php
class TournamentsPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function writePageContent() {
        global $database;

        $content = 
'<div class="jumbotron">
    <h1>Tournament Schedule</h1>
    <table class="table table-hover" style="margin-top: 50px; text-align: left; font-size: medium;">
        <thead>
        <th>Name</th>
        <th>Date(s)</th>
        <th>Location</th>
        </thead>
        <tbody>';

            foreach($database->select('tournaments', '*') as $i) {
                $content .=
'           <tr id="' . $i . '">
            <td>' . $i['name'] . '</td>
            <td>' . $i['date'] . '</td>
            <td>' . $i['location'] . '</td>
            </tr>';
            }

            $content .=
'       </tbody>    
    </table>
</div>
';
        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>