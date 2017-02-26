<?php
session_start();
if ($_SESSION['logged_in1']) {
    echo 'You\'re already logged in!';
}
else {

    echo '<div class="account">Create an account.';
    echo '<form id="account_creation">';
    echo '<p>Username: <input type="text" id="create_username"></p>';
    echo '<p>Password: <input type="text" id="create_password"></p>';
    echo '<p><input type="submit"> </p>';
    echo '</form></div>';

    $_SESSION['logged_in1'] = true;
    $_SESSION['create_or_login'] = 'create';
}
