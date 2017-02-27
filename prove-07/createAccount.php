<?php
session_start();
if ($_SESSION['user_loggedIn'] == true) {
    echo 'You\'re already logged in!';
}
else {
    //TODO: prevent user from creating username > 30 && password > 15
    echo '<div class="account">Create an account.';
    echo '<br/><br/><span class="login_limitations">Username must be 30 characters or 
less.</span>';
    echo '<br/><span class="login_limitations">Password must be 15 characters or less.</span>';
    echo '<form id="account_creation">';
    echo '<p>Choose a username: <input maxlength="30" type="text" id="create_username"></p>';
    echo '<p>Choose a password: <input maxlength="15" type="password" id="create_password"></p>';
    echo '<p><input type="submit"> </p>';
    echo '<span id="existing_user" class="notify"></span>';
    echo '</form></div>';

    $_SESSION['create_or_login'] = 'create';
}
