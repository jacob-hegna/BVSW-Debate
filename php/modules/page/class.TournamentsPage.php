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
        <thead><th>Name</th><th>Date(s)</th></thead>
        <tbody>';

            for($i = 0; $i < $database->count("tournaments", []); $i++) {
                $content .=
'           <tr id="' . $i . '">
            <td>' . $database->get("tournaments", "name", ["id" => $i+1]) . '</td>
            <td>' . $database->get("tournaments", "date", ["id" => $i+1]) . '</td>';
            }

            $content .=
'       </tbody>    
    </table>
</div>';
        echo $content;
    }

    public function writePage() {
        self::writePageStart();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>