<?php
function get_sign_in() {
    $page =
'<div class="jumbotron">
    <h1>Login</h1>
    <form method="post">
        <fieldset><input type="email" name="email" class="form-control" maxlength="40" placeholder="Email address" required="" autofocus=""></fieldset>
        <fieldset><input type="password" name="password" class="form-control" placeholder="Password" required=""></fieldset>
        <div class="btn-group btn-group-justified" style="margin-top: 0px;">
            <button style="width:100%;" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a style="width:50%;" class="btn btn-lg btn-primary btn-block" href="?p=register">Register</a>
        </div>
    </form>
</div>';
        echo $page;
}
?>