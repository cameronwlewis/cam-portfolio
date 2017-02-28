<?php
session_start();

require('Connection.php');
require('DataStorage.php');

$connection = new Connection();
$storage = new DataStorage($connection);
$connection = $connection->connectHeroku();

$_SESSION['user_loggedIn'] = false;

if ($_SESSION['create_or_login'] == 'create') {

    $create_username = $_POST['username'];
    $create_password = $_POST['password'];

    $hashed_pass = password_hash($create_password, PASSWORD_DEFAULT);

    $check_username = pg_query($connection, "SELECT id FROM users WHERE _user = '$create_username'");
    $result_username = pg_fetch_assoc($check_username);

    if ($result_username == true) {
        echo 'User already exists.';
    }
    else {
        $get_id = $storage->storeAccount($create_username, $hashed_pass);
        $newUser = pg_fetch_assoc($get_id);

        if (isset($_SESSION['saved_search'])) {
            $storage->attachToAccount($newUser['id'],
                $_SESSION['saved_search']);
        }
        $_SESSION['user_loggedIn'] = true;
        echo '<p>Account created!</p><p>Redirecting...</p>';
    }
}
if ($_SESSION['create_or_login'] == 'login') {
    $returningUser_name = $_POST['username'];
    $returningUser_pass = $_POST['password'];

    $login = pg_query($connection, "SELECT id, _password FROM users WHERE _user = '$returningUser_name'");
    $check_login = pg_fetch_assoc($login);

    $check_user = $check_login['id'];
    $check_pass = $check_login['_password'];

    $verify = password_verify($returningUser_pass, $check_pass);
    if ($check_login == false) {
        echo 'Username not found!';
    } else if ($verify == false) {
        echo 'Incorrect password.';
    } else if ($check_login == true && $verify == true) {
        echo 'Login successful.<p>Redirecting...</p>';
        $_SESSION['create_or_login'] = null;
        $_SESSION['user_loggedIn'] = true;
        $_SESSION['returningUser_id'] = $check_login['id'];

        if (isset($_SESSION['saved_search'])) {
            $storage->attachToAccount($_SESSION['returningUser_id'],
                $_SESSION['saved_search']);
        }
    }
}



