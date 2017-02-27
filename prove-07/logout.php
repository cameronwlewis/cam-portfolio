<?php
session_start();
//require ('events.js');
$_SESSION['user_loggedIn'] = true; //TODO: delete when done
if (!is_null($_SESSION['user_loggedIn'])) {
    $_SESSION['user_loggedIn'] = false;
    $_SESSION['returningUser_id'] = null;
    $_SESSION['create_or_login'] = null;
    session_destroy();

    echo 'Logged out successfully.';
    //<script>setTimeout(showHome(), 7000)</script>;
//<?php
}
else {
    echo 'You are not logged in. Log in 
          <a id="login_link" href="javascript:showLogin()">here.</a></p>';
}