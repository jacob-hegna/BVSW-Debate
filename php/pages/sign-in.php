<?php
function get_sign_in() {
    $page =
'<div class="jumbotron">
    <h1>Login</h1>
    <form>
        <fieldset><input id="email-box" type="email" name="email" class="form-control" maxlength="40" placeholder="Email address" required="" autofocus=""></fieldset>
        <fieldset><input id="pass-box" type="password" name="password" class="form-control" placeholder="Password" required=""></fieldset>
        <div class="btn-group btn-group-justified" style="margin-top: 0px;">
            <button id="sign-in-submit" style="width:100%;" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a style="width:50%;" class="btn btn-lg btn-primary btn-block" href="?p=register">Register</a>
        </div>
    </form>
    <script>
        $("#sign-in-submit").on("click", function(e) {
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
                    $("#pass-box").val("");
                };
            });
        });
    </script>
</div>';
        echo $page;
}
?>