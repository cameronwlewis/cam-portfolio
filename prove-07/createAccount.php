<?php
session_start();
if ($_SESSION['user_loggedIn'] == true) {
    echo 'You\'re already logged in!';
}
else {
    echo '<div class="account">Create an account.';
    echo '<br/><br/><span class="login_limitations">Username must be 30 characters or 
less.</span>';
    echo '<form id="account_creation">';
    echo '<p class="login_prompt">Choose a username: <input maxlength="30" type="text" id="create_username" onblur="validateNewAccount()"></p>';
    echo '<p class="login_prompt">Choose a password: <input maxlength="15" type="password" id="create_password" oninput="validateNewAccount()"></p>';
    echo '<p class="login_prompt">Confirm password: <input maxlength="15" type="password" 
          id="confirm_password" oninput="validateNewAccount()"></p>';

    echo '<p><input type="submit"> </p>';
    echo '<span id="existing_user" class="notify"></span>';
    echo '<span id="non-matching_pass" class="notify"></span>';
    echo '</form></div>';

    $_SESSION['create_or_login'] = 'create';
}
