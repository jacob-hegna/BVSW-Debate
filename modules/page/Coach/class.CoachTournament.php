<?php
class CoachTournament {
    private $userEmail;

    public function __construct($email) {
        $this->userEmail = $email;
    }

    public function writeBody() {
        global $database;
        $content = 
'<br>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
    <div class="carousel-inner">';

    $count = 0;
    foreach($database->select('tournaments', '*') as $i) {
        $register = json_decode($database->get('tournaments', 'register', ['id' => $i['id']]));
        $attend   = json_decode($database->get('tournaments', 'attend', ['id' => $i['id']]));

        $content .=
'       <div class="item ' . ($count == 0 ? 'active' : '') . '">
            <div class="container tournament-reg-table">
                <center>
                    <h2>' . ($i['name']) . '</h2>
                    <table class="table table-hover" style="margin-top: 50px; text-align: left; font-size: medium;">
                        <thead>
                        <th><center>Name</center></th>
                        <th><center>Attending?</center></th>
                        <thead>
                        <tbody>';
        foreach($register as $j) {
            $user = $database->get('accounts', '*', ['id' => $j]);
            $content .=
'                           <tr>
                                <td>' . $user['first'] . ' ' . $user['last'] . '</td>
                                <td>';
            if(in_array($user['id'], $attend)) {
                $content .=
'Yes';
            } else {
                $content .=
'                                   <form method="post">
                                        <button class="btn btn-sm btn-primary" name="submit" type="submit">Accept</button>
                                        <input type="hidden" name="debater" value="'.$user['id'].'">
                                        <input type="hidden" name="tournament" value="'.$i['id'].'">
                                    </form>';
            }
            $content .= 
'                               </td>
                            </tr>';
        }

        $content .=
'                       </tbody>
                    </table>
                </center>
            </div>
        </div>';
        $count++;
    }

    $content .=
'   </div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
';
        echo $content;
    }


    public function logic() {
        global $database;
        if(array_key_exists('submit', $_POST)) {
            $array = json_decode($database->get('tournaments', 'attend', ['id' => $_POST['tournament']]));
            array_push($array, $_POST['debater']);
            $database->update('tournaments', ['attend' => json_encode($array)], ['id' => $_POST['tournament']]);
        }
    }

    public function write() {
        self::logic();
        self::writeBody();
    }
}
?>