<?php

function get_checkout_table($type) {
    if($type == 'laptops') {
        get_laptop_table();
    } else {
        get_stand_table();
    }
}

function get_stand_table() {
    global $database;
    $content =
'    <table class="table" style="margin-top: 50px; text-align: left; font-size: medium;">
        <thead>
            <th><center>Number</center></th>
            <th><center>Checkout</center></th>
        </thead>
        <tbody>';

    foreach($database->select('stands', '*') as $stand) {
        $content .= '
            <tr>
                <td><center>' . $stand['id'] . '</center></td>
                <td><center>' . (($stand['taken'] == 0) ?
                            '<button type="button" id="'.$stand['id'].'" class="btn btn-primary checkout-stand">Checkout</button>' :
                            ((Util::getUser($_SESSION['email'])['rank'] > 1) ? 'Checked out by ' . Util::getUserById($stand['taken'])['first'] . ' ' . Util::getUserById($stand['taken'])['last'] . ' - <button type="button" id="'.$stand['id'].'"class="btn btn-primary return-stand">Returned?</button>' : 
                                'Checked out')) . '</center></td>
            </tr>';
    }

    $content .= '
        </tbody>
        <script>
            $(".checkout-stand").on("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/main.php",
                    data: {
                        util: "pick_stand",
                        attr: {
                            id:   $(this).attr("id"),
                            user: '.Util::getUser($_SESSION['email'])['id'].'
                        }
                    }
                }).done(function(data) {
                    window.location = "/checkout/stands/";
                });
            });
            $(".return-stand").on("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/main.php",
                    data: {
                        util: "pick_stand",
                        attr: {
                            id:   $(this).attr("id"),
                            user: 0
                        }
                    }
                }).done(function(data) {
                    window.location = "/checkout/stands/";
                });
            });
        </script>
    </table>';

    echo $content;
}

function get_laptop_table() {
    global $database;
    $content =
'    <table class="table" style="margin-top: 50px; text-align: left; font-size: medium;">
        <thead>
            <th><center>Cart A</center></th>
            <th><center>Cart B</center></th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table" style="margin-top: 50px; text-align: left; font-size: medium;">
                        <tbody>';
    foreach($database->select('laptops', '*', ['cart' => 'a']) as $laptop) {
        $content .= '
                            <tr>
                                <td><center>' . $laptop['num'] . '</center></td>
                                <td><center>' . (($laptop['taken'] == 0) ?
                            '<button type="button" id="'.$laptop['id'].'" class="btn btn-primary checkout-laptop">Checkout</button>' :
                            ((Util::getUser($_SESSION['email'])['rank'] > 1) ? 'Checked out by ' . Util::getUserById($laptop['taken'])['first'] . ' ' . Util::getUserById($laptop['taken'])['last'] . ' - <button type="button" id="'.$laptop['id'].'"class="btn btn-primary return-laptop">Returned?</button>' : 
                                'Checked out')) . '</center></td>
                            </tr>';
    }
    $content .= '
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table" style="margin-top: 50px; text-align: left; font-size: medium;">';
    foreach($database->select('laptops', '*', ['cart' => 'b']) as $laptop) {
        $content .= '
                            <tr>
                                <td><center>' . $laptop['num'] . '</center></td>
                                <td><center>' . (($laptop['taken'] == 0) ?
                            '<button type="button" id="'.$laptop['id'].'" class="btn btn-primary checkout-laptop">Checkout</button>' :
                            ((Util::getUser($_SESSION['email'])['rank'] > 1) ? 'Checked out by ' . Util::getUserById($laptop['taken'])['first'] . ' ' . Util::getUserById($laptop['taken'])['last'] . ' - <button type="button" id="'.$laptop['id'].'"class="btn btn-primary return-laptop">Returned?</button>' : 
                                'Checked out')) . '</center></td>
                            </tr>';
    }
    $content .= '
                    </table>
                </td>
            </tr>
        </tbody>
        <script>
            $(".checkout-laptop").on("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/main.php",
                    data: {
                        util: "pick_laptop",
                        attr: {
                            id:   $(this).attr("id"),
                            user: '.Util::getUser($_SESSION['email'])['id'].'
                        }
                    }
                }).done(function(data) {
                    window.location = "/checkout/laptops/";
                });
            });
            $(".return-laptop").on("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "/main.php",
                    data: {
                        util: "pick_laptop",
                        attr: {
                            id:   $(this).attr("id"),
                            user: 0
                        }
                    }
                }).done(function(data) {
                    window.location = "/checkout/laptops/";
                });
            });
        </script>
    </table>';

    echo $content;
}
?>