<?php
session_start();
if ($_SESSION['logged_in1']) {
    echo 'You\'re already logged in!';
}
else {

    echo '<div class="account">Log in here.';
    echo '<form id="login_form">';
    echo '<p>Username: <input type="text" id="input_username"></p>';
    echo '<p>Password: <input type="text" id="input_password"></p>';
    echo '<p><input type="submit"> </p>';
    echo '</form></div>';

    $_SESSION['logged_in1'] = true;
}
