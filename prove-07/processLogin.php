<?php
session_start();

require ('Connection.php');
require ('DataStorage.php');

$connection = new Connection();
$storage = new DataStorage($connection);
$connection = $connection->connectHeroku();

$_SESSION['user_loggedIn'] = false;

if ($_SESSION['create_or_login'] == 'create') {

    $create_username = $_POST['username'];
    $create_password = $_POST['password'];
// TODO: check to see if username already exists before creation
    $get_id =
        $storage->storeAccount($create_username, $create_password);
    $newUser= pg_fetch_assoc($get_id);
    if (isset($_SESSION['saved_search'])) {
        $storage->attachToAccount($newUser['id'],
            $_SESSION['saved_search']);
    }
    echo '<p>Account created!</p>';
}
// attach hashtags to login here
$_SESSION['create_or_login'] = 'login';
if ($_SESSION['create_or_login'] == 'login') {
   $returningUser_name = $_POST['username'];
    $returningUser_pass = $_POST['password'];

    $check_username = pg_query($connection, "SELECT id FROM users WHERE _user = '$returningUser_name'");
    $result_username = pg_fetch_assoc($check_username);

    $check_password = pg_query($connection, "SELECT id FROM users WHERE _password = '$returningUser_pass'");
    $result_password = pg_fetch_assoc($check_password);


    if ($result_username == false){
        echo 'Username not found!';
    }
    else if ($result_password == false){
        echo 'Incorrect password.';
    }
    else if ($result_username['id'] == $result_password['id']) {
        echo 'Login successful.';
        $_SESSION['create_or_login'] = null;
        $_SESSION['user_loggedIn'] = true;
        $_SESSION['returningUser_id'] = $result_username['id'];

        if (isset($_SESSION['saved_search'])) {
                $storage->attachToAccount($_SESSION['returningUser_id'],
                    $_SESSION['saved_search']);
        }
    }
}



