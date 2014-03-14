<?php
class MemberPage extends Page {
    public function __construct() {
        parent::__construct();
    }

    public function writePageContent() {
        global $database;

        $content = 
'<div class="jumbotron">
    <h1>BVSW Debaters</h1>
    <table class="table table-hover" style="margin-top: 50px; text-align: left; font-size: medium;">
        <thead>
        <th>Name</th>
        <th>Email</th>
        ' . (Util::getUser($_SESSION['email'])['rank'] >= 2 ? '<th>Student ID</th>' : '') . '
        <th>Phone Number</th>
        </thead>
        <tbody>';

            foreach($database->select('accounts', '*') as $i) {
                $content .=
'            <td>' . $i['first'] . ' ' . $i['last'] . ' <span class="label label-primary">' . Util::getRank($i['rank']) . '</span></td>
            <td>' . $i['email'] . '</td>
            ' . (Util::getUser($_SESSION['email'])['rank'] >= 2 ? '<td>' . $i['student-id'] . '</td>' : '') . '
            <td>' . Util::formatPhoneNum($i['number']) . '</td>';
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