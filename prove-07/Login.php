<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
session_start();
if ($_SESSION['user_loggedIn'] == true) {
    echo 'You\'re already logged in!';
}
else {
//require ('events.js');
    echo '<div class="account">Log in here.';
    echo '<form id="login_form">';
    echo '<p>Username: <input type="text" id="returningUser_name"></p>';
    echo '<p>Password: <input type="password" id="returningUser_pass"></p>';
    echo '<p><input type="submit"> </p>';
    echo '</form></div>';
    echo '<span id="user_notfound" class="notify"></span>';
    echo '<span id="bad_pass" class="notify" ></span>';
    echo '<div>Don\'t have an account? 
        Create one <a class="login_link" href="javascript:showAccountCreation()">
        here</a>.';

    $_SESSION['create_or_login'] = 'login';
}
