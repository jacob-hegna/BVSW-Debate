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
        <th>Location</th>';
        $isDebater = false;
        if($_SESSION['loggedin']) {
            if(Util::getUser($_SESSION['email'])['rank'] < 3) {
                $isDebater = true;
                $content .=
'       <th>Attending?</th>';
            }
        }
        $content .=
'       </thead>
        <tbody>';

            foreach($database->select('tournaments', '*') as $i) {
                $content .=
'           <tr id="' . $i['id'] . '">
            <td>';

                $showButton = false;
                if($isDebater) {
                    $register = json_decode($database->get('tournaments', 'register', ['id' => $i['id']]));
                    $attend   = json_decode($database->get('tournaments', 'attend', ['id' => $i['id']]));
                    if(!in_array(Util::getUser($_SESSION['email'])['id'], $register)) {
                        $showButton = true;
                        $content .=
'               <form method="post">
                    <button class="btn btn-sm btn-primary" name="submit" type="submit">Apply</button>
                    <input type="hidden" name="id" value="'.$i['id'].'">';
                    }
                }

                $content .= 
'           ' . $i['name'];
            
                if($showButton) {
                    $content .= 
'               </form>';
                }

                $content .= 
'           </td>
            <td>' . $i['date'] . '</td>
            <td>' . $i['location'] . '</td>' . 
            ($isDebater ? '<td>' . (in_array(Util::getUser($_SESSION['email'])['id'], $attend) ? 'Yes' : 'No') . '</td>' : '')
            . '</tr>';
            }

            $content .=
'       </tbody>    
    </table>
</div>
';
        echo $content;
    }

    public function logic() {
        global $database;
        if(array_key_exists('submit', $_POST)) {
            $array = json_decode($database->get('tournaments', 'register', ['id' => $_POST['id']]));
            array_push($array, Util::getUser($_SESSION['email'])['id']);
            $database->update('tournaments', ['register' => json_encode($array)], ['id' => $_POST['id']]);
        }
    }

    public function writePage() {
        self::writePageStart();
        self::logic();
        self::writePageContent();
        self::writePageEnd();
    }
}
?>