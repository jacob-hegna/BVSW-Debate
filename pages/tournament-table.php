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
    '               <button id="'.$i['id'].'" class="btn btn-sm btn-primary tourn-reg" name="apply" type="submit">Apply</button>';
                        } else if(!in_array(Util::getUser($_SESSION['email'])['id'], $attend)) {
                            $showButton = true;
                            $content .=
    '               <button id="'.$i['id'].'" class="btn btn-sm btn-primary tourn-reg" name="remove" type="submit">Can\'t go?</button>';
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
                <td>' . $i['location'] . '</td>';
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
                            if($("#name-box").val().trim().length > 0 &&
                               $("#date-box").val().trim().length > 0 &&
                               $("#location-box").val().trim().length > 0) {
                                var seg = $.url().segment(2);
                                if(seg != undefined) {
                                    seg = seg.toLowerCase();
                                } else {
                                    seg = "novice";
                                }
                                $.ajax({
                                    type: "post",
                                    url: "/main.php",
                                    data: {
                                        util: "add_tournament",
                                        attr: {
                                            type:         seg,
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
                    if($isDebater) {
                        $content .= '
                        <script>
                        $(".tourn-reg").on("click", function(e) {
                            e.preventDefault();
                            var seg = $.url().segment(2);
                            if(seg != undefined) {
                                seg = seg.toLowerCase();
                            } else {
                                seg = "novice";
                            }
                            $.ajax({
                                type: "post",
                                url: "/main.php",
                                data: {
                                    util: "pick_tournament",
                                    attr: {
                                        reg: (($(this).text() == "Apply") ? "1" : "0"),
                                        type: seg,
                                        tournament: $(this).attr("id")
                                    }
                                }
                            }).done(function(data) {
                                $("#main").html(data);
                            });
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