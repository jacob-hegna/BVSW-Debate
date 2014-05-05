<?php
function get_sign_in() {
    $page =
'<div class="jumbotron">
    <h1 id="page-title">Sign in</h1>
    <form class="form-group">
        <fieldset><input id="email-box" type="email" name="email" class="form-control" maxlength="40" placeholder="Email address" required="" autofocus=""></fieldset>
        <fieldset><input id="pass-box" type="password" name="password" class="form-control" placeholder="Password" required=""></fieldset>
        <div id="registerForm" class="panel-collapse collapse" style="margin-top: 10px;">
            <input id="pass-conf" class="form-control" type="password" placeholder="Confirm password">
            <input id="name-box" class="form-control" type="text" placeholder="Full name">
            <input id="id-box" class="form-control" type="text" placeholder="Student ID">
            <div class="input-group" style="margin-top: -1px;">
                <span class="input-group-addon" style="border-top-left-radius: 0;">
                    <input id="if-text" type="checkbox" name="texting">
                </span>
                <input id="num-box" class="form-control" type="text" placeholder="Phone number (xxx-xxx-xxxx)" maxlength="12" style="border-top-right-radius: 0;">
                <span class="input-group-addon">@</span>
                <select id="carrier-box" class="selectpicker" data-style="btn-success">
                    <option value="verizon">Verizon</option>
                    <option value="att">AT&T</option>
                    <option value="sprint">Sprint</option>
                    <option value="tmobile">T-Mobile</option>
                </select>
            </div>
        </div>
        <div class="btn-group btn-group-justified" style="margin-top: 0px;">
            <a id="sign-in-submit" style="width:50%;" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</a>
            <a style="width:50%;" class="btn btn-lg btn-primary btn-block" data-toggle="collapse" data-target="#registerForm" href="javascript: clear_notifications(); $(\'#sign-in-submit\').html(\'Create account\'); $(\'#page-title\').html(\'Sign up\'); $(\'#toggleRegister\').hide();" id="toggleRegister">Register</a>
        </div>
    </form>
    <script>
        $(".selectpicker").selectpicker({});
        $("#sign-in-submit").on("click", function(e) {
            clear_notifications();
            if($(this).text() == "Sign in") {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "main.php",
                    data: {
                        sign_in: {
                            email: $("#email-box").val(),
                            pass:  $("#pass-box").val()
                        }
                    }
                }).done(function(data) {
                    if(data == "success") {
                        window.location = "";
                    } else {
                        notify("danger", "Error!", "Either email or password is incorrect!");
                        $("#pass-box").val("");
                        $("#pass-box").attr("autofocus", true);
                    };
                });
            } else {
                if($("#pass-box").val() == $("#pass-conf").val()) {
                    $.ajax({
                        type: "post",
                        url: "main.php",
                        data: {
                            add_user: {
                                email:  $("#email-box").val(),
                                pass:   $("#pass-box").val(),
                                carrier: $("#carrier-box").val(),
                                id:      $("#id-box").val(),
                                if_text: $("#if-text").is(":checked") ? "1" : "0",
                                name:    $("#name-box").val(),
                                num:     $("#num-box").val().replace("-", "")
                            }
                        }
                    }).done(function(data) {
                        switch(data) {
                            case "0":
                                window.location = "";
                                break;
                            case "-1":
                                notify("danger", "Error!", "Email already in database!");
                                $("#pass-conf").val("");
                                $("#email-box").val("");
                                $("#email-box").attr("autofocus", true);
                                break;
                            case "-2":
                                notify("danger", "Error!", "Number already in database!");
                                $("#pass-conf").val("");
                                $("#num-box").val("");
                                $("#num-box").attr("autofocus", true);
                                break;
                            case "-3":
                                notify("danger", "Error!", "Student ID already in database!");
                                $("#pass-conf").val("");
                                $("#id-box").val("");
                                $("#id-box").attr("autofocus", true);
                                break;
                            default:
                                notify("danger", "Well this is awkward,", "an unknown error occurred");
                                $("#pass-conf").val("");
                                break;
                        }
                    });
                } else {
                    notify("danger", "Error!", "Passwords don\'t match!");
                    $("#pass-conf").val("");
                    $("#pass-conf").attr("autofocus", true);
                };
            };
        });
    </script>
</div>';
        echo $page;
}
?>