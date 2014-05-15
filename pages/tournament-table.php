<?php
function get_tournament_table($type) {
    global $database;
    $content = 
'    <table class="table table-hover" style="margin-top: 50px; text-align: left; font-size: medium;">
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

                foreach($database->select($type, '*') as $i) {
                    $content .=
    '           <tr id="' . $i['id'] . '">
                <td>';

                    $register = json_decode($database->get($type, 'register', ['id' => $i['id']]));
                    $attend   = json_decode($database->get($type, 'attend', ['id' => $i['id']]));

                    $showButton = false;
                    if($isDebater) {
                        if(!in_array(Util::getUser($_SESSION['email'])['id'], $register)) {
                            $showButton = true;
                            $content .=
    '               <button class="btn btn-sm btn-primary tourn-apply" name="apply" type="submit">Apply</button>
                    <input type="hidden" name="id" value="'.$i['id'].'">
    ';
                        } else if(!in_array(Util::getUser($_SESSION['email'])['id'], $attend)) {
                            $showButton = true;
                            $content .=
    '               <button class="btn btn-sm btn-primary tourn-reject" name="remove" type="submit">Can\'t go?</button>
                    <input type="hidden" name="id" value="'.$i['id'].'">';
                        }

                    }

                    $content .=  $i['name'];

                    if(array_key_exists('email', $_SESSION)) {
                        if(in_array(Util::getUser($_SESSION['email'])['id'], $attend)) {
                            $content .= ' <span class="label label-success">Attending</span>';
                        } else if(in_array(Util::getUser($_SESSION['email'])['id'], $register)) {
                            $content .= ' <span class="label label-warning">Applied</span>';
                        }
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
                        <td><input id="name-box" name="name" class="form-control" placeholder="Name" required=""></td>
                        <td><input id="date-box" name="date" class="form-control" placeholder="Date(s)" required=""></td>
                        <td><input id="location-box" name="location" class="form-control" placeholder="Location" required=""></td>
                        <td><button id="add-tournament" class="btn btn-primary" name="new-tourny" type="submit">Submit</buton></td>
                    </tr>
                    <script>
                        $("#add-tournament").on("click", function(e) {
                            e.preventDefault();
                            if($("#name-box").val().trim() &&
                               $("#date-box").val().trim() &&
                               $("#location-box").val().trim()) {
                                $.ajax({
                                    type: "post",
                                    url: "main.php",
                                    data: {
                                        util: "add_tournament",
                                        attr: {
                                            name:         $("#name-box").val(),
                                            date:         $("#date-box").val(),
                                            location:     $("#location-box").val()
                                        }
                                    }
                                }).done(function(data) {
                                    $("#main").html(data);
                                });
                            };
                        });
                    </script>';
                    }
                }

                $content .=
'          </tbody>
        </table>
        <script>';
    echo $content;
}
?>