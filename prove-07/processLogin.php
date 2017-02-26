<?php
session_start();

$connection = new Connection();
$storage = new DataStorage($connection);

$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if ($_SESSION['create_or_login'] == 'create') {

    $create_username = $_POST['create_username'];
    $create_password = $_POST['create_password'];

    $_SESSION['user_id'] =
        $storage->storeAccount($create_username, $create_password);

    echo '<p>Account created!</p>';
}
// attach login to hashtags here

if ($_SESSION['create_or_login'] == 'login') {
    // TODO: HERE, need to do a query selecting _user from 'users' table (from a
    // search), which then returns the corresponding 'user_id'

    if (isset($_SESSION['search_index'])) {
        $tags = $_SESSION['saved_searches'];

        //var_dump($debug, $tags, $sentiment, $magnitude);

        foreach ($tags as $index => $tag) {
            $storage->attachToAccount($user_id, $tag);
        }
    }
}



