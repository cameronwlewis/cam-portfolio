<?php
require('Connection.php');
require('DataStorage.php');

$connection = new Connection();
$storage = new DataStorage($connection);

$create_username = $_POST['create_username'];
$create_password = $_POST['create_password'];

$storage->storeAccount($create_username, $create_password);

echo '<p style="color:white;">Account created!</p>';



