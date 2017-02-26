<?php
session_start();

require ('Connection.php');
require ('DataStorage.php');

$connection = new Connection();
$connection = $connection->connectHeroku();
//$storage = new DataStorage($connection);
$returningUser_id = null;
$_SESSION['user_loggedIn'] = false;

if ($_SESSION['create_or_login'] == 'create') {

    $create_username = $_POST['username'];
    $create_password = $_POST['password'];
// TODO: check to see if username already exists before creation
    $_SESSION['user_id'] =
        $storage->storeAccount($create_username, $create_password);

    echo '<p>Account created!</p>';
}
// attach login to hashtags here
$_SESSION['create_or_login'] = 'login';
if ($_SESSION['create_or_login'] == 'login') {
    $returningUser_name = 'flintstones';
    //$returningUser_name = $_POST['username'];
    $returningUser_pass = $_POST['password'];

    $check_username = pg_query($connection, "SELECT id FROM users WHERE _user = '$returningUser_name'");
    $result_username = pg_fetch_assoc($check_username);

    $check_password = pg_query($connection, "SELECT id FROM users WHERE _password = '$returningUser_pass'");
    $result_password = pg_fetch_assoc($check_password);


    if ($result_username == false){
        echo '<p>Username not found! Click
        <a id="login_link" href="javascript:showAccountCreation()">here</a> 
            to make an account.';
    }
    else if (is_null($returningUser_pass)){
        echo '<p>Incorrect password. Please try again.';
    }
    else if ($result_username['id'] == $result_password['id']) {
        $_SESSION['user_loggedIn'] = true;
        $_SESSION['returningUser_id'] = $result_username['id'];
        echo '<p>You\'ve logged in successfully.</p>
        <p><a href="javascript:showHome()">Return to Search</a></p>';

        if (isset($_SESSION['search_index'])) {
            $tags = $_SESSION['saved_searches'];
            foreach ($tags as $index => $tag) {
                $storage->attachToAccount($returningUser_id, $tag);
            }
        }
    }
}



