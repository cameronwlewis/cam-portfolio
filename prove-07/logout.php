<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
session_start();
if (!is_null($_SESSION['user_loggedIn'])) {
    $_SESSION['user_loggedIn'] = false;
    $_SESSION['returningUser_id'] = null;
    $_SESSION['create_or_login'] = null;
    session_destroy();

    echo 'Logged out successfully.';
}
else {
    echo 'You are not logged in. Log in 
          <a class="login_link" href="javascript:showLogin()">here</a>.</p>';
}