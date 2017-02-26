<?php
session_start();
if (!is_null($_SESSION['user_loggedIn'])) {
    $_SESSION['user_loggedIn'] = false;
    $_SESSION['returningUser_id'] = null;
    $_SESSION['create_or_login'] = null;
    session_destroy();

    echo 'Logged out successfully.';
    echo '<meta http-equiv="refresh" content="3;url=javascript:showHome()"/>';
}
else {
    echo 'You are not logged in. Log in 
          <a id="login_link" href="javascript:showLogin()">here.</a></p>';
}