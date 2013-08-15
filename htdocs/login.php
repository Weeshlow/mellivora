<?php

define('IN_FILE', true);
require('../include/general.inc.php');

if ($_SESSION['id']) {
    header('location: ' . CONFIG_LOGIN_REDIRECT_TO);
    exit();
}

forceSSL();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'login') {
        if (loginSessionCreate($_POST)) {
            header('location: ' . CONFIG_LOGIN_REDIRECT_TO);
        } else {
            errorMessage('Login failed? Helpful.');
        }
    }

    else if ($_POST['action'] == 'register') {
        if (registerAccount($_POST) && loginSessionCreate($_POST)) {
            header('location: ' . CONFIG_REGISTER_REDIRECT_TO);
        } else {
            errorMessage('Sign up failed? Helpful.');
        }
    }

    exit();
}

head('Login');
?>

<form method="post" class="form-signin">
    <h2 class="form-signin-heading">Please sign in</h2>
    <input name="<? echo md5(CONFIG_SITE_NAME.'USR') ?>" type="text" class="input-block-level" placeholder="Email address">
    <input name="<? echo md5(CONFIG_SITE_NAME.'PWD') ?>" type="password" class="input-block-level" placeholder="Password">
    <input type="hidden" name="action" value="login" />
    <button class="btn btn-primary" type="submit">Sign in</button> <a href="recover_password.php">I've forgotten my password</a>
</form>

<form method="post" class="form-signin">
    <h2 class="form-signin-heading">or, register a team</h2>
    <p>Your team shares one account. An confirmation email containing your password will be sent to the chosen address.</p>
    <input name="<? echo md5(CONFIG_SITE_NAME.'USR') ?>" type="text" class="input-block-level" placeholder="Email address">
    <input name="<? echo md5(CONFIG_SITE_NAME.'PWD') ?>" type="password" class="input-block-level" placeholder="Password">
    <input name="<? echo md5(CONFIG_SITE_NAME.'TEAM') ?>" type="text" class="input-block-level" placeholder="Team name" maxlength="<?php echo CONFIG_MAX_TEAM_NAME_LENGTH ?>">
    <input type="hidden" name="action" value="register" />
    <button class="btn btn-primary" type="submit">Register team</button>
</form>

<?php
foot();