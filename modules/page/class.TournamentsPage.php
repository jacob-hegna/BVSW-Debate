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

                $register = json_decode($database->get('tournaments', 'register', ['id' => $i['id']]));
                $attend   = json_decode($database->get('tournaments', 'attend', ['id' => $i['id']]));
                
                $showButton = false;
                if($isDebater) {
                    if(!in_array(Util::getUser($_SESSION['email'])['id'], $register)) {
                        $showButton = true;
                        $content .=
'               <form method="post">
                    <button class="btn btn-sm btn-primary" name="apply" type="submit">Apply</button>
                    <input type="hidden" name="id" value="'.$i['id'].'">';
                    } else {
                        $showButton = true;
                        $content .=
'               <form method="post">
                    <button class="btn btn-sm btn-primary" name="remove" type="submit">Can\'t go?</button>
                    <input type="hidden" name="id" value="'.$i['id'].'">';
                    }

                }

                $content .=  $i['name'];
            
                if(array_search(Util::getUser($_SESSION['email'])['id'], $register)) {
                    $content .= '<span class="label label-warning">Applied</span>';
                } else if(array_search(Util::getUser($_SESSION['email'])['id'], $attend)) {
                    $content .= '<span class="label label-success">Attending</span>';
                }

                if($showButton) {
                    $content .= '</form>';
                }

                $content .= 
'           </td>
            <td>' . $i['date'] . '</td>
            <td>' . $i['location'] . '</td>' . 
            ($isDebater ? '<td>' . (in_array(Util::getUser($_SESSION['email'])['id'], $attend) ? 'Yes' : 'No') . '</td>' : '')
            . '</tr>';
            }

            if($_SESSION['loggedin']) {
                if(Util::getUser($_SESSION['email'])['rank'] >= 2) {
                    $content .=
    '           <tr>
                    <form method="post">
                        <td><input name="name" class="form-control" placeholder="Name" required=""></td>
                        <td><input name="date" class="form-control" placeholder="Date(s)" required=""></td>
                        <td><input name="location" class="form-control" placeholder="Location" required=""></td>
                        <td><button class="btn btn-primary" name="new-tourny" type="submit">Submit</buton></td>
                    </form>
                </tr>';
                }
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
        if(array_key_exists('new-tourny', $_POST)) {
            $database->insert('tournaments', [
                'name' => $_POST['name'],
                'date' => $_POST['date'],
                'location' => $_POST['location'],
                'register' => '[]',
                'attend'   => '[]']);
        } else if(array_key_exists('apply', $_POST)) {
            $array = json_decode($database->get('tournaments', 'register', ['id' => $_POST['id']]));
            array_push($array, Util::getUser($_SESSION['email'])['id']);
            $database->update('tournaments', ['register' => json_encode($array)], ['id' => $_POST['id']]);
        } else if(array_key_exists('remove', $_POST)) {
            $array = json_decode($database->get('tournaments', 'register', ['id' => $_POST['id']]));
            $array = array_diff($array, [Util::getUser($_SESSION['email'])['id']]);
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