<?php
session_start();
if ($_SESSION['user_loggedIn'] == true) {
    echo 'You\'re already logged in!';
}
//TODO: find way to redirect after account creation

else {

    echo '<div class="account">Create an account.';
    echo '<form id="account_creation">';
    echo '<p>Choose a username: <input type="text" id="create_username"></p>';
    echo '<p>Choose a password: <input type="text" id="create_password"></p>';
    echo '<p><input type="submit"> </p>';
    echo '</form></div>';

    $_SESSION['create_or_login'] = 'create';
}
