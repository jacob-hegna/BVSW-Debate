<?php
function get_members() {
    global $database;

    $page =
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
                $rankColor;
                switch($i['rank']) {
                    case 0:
                        $rankColor = 'success';
                        break;
                    case 1:
                        $rankColor = 'primary';
                        break;
                    case 2:
                        $rankColor = 'warning';
                        break;
                    case 3:
                        $rankColor = 'danger';
                        break;
                }
                $page .=
'           <tr>
            <td>' . $i['first'] . ' ' . $i['last'] . ' <span class="label label-'.$rankColor.'">' . Util::getRank($i['rank']) . '</span></td>
            <td>' . $i['email'] . '</td>
            ' . (Util::getUser($_SESSION['email'])['rank'] >= 2 ? '<td>' . $i['student-id'] . '</td>' : '') . '
            <td>' . Util::formatPhoneNum($i['number']) . '</td></tr>';
            }

            $page .=
'       </tbody>
    </table>
</div>
';
        echo $page;
}
?>