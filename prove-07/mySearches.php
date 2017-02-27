<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
session_start();
if ($_SESSION['user_loggedIn'] == true) {
    require('Connection.php');
    require('DataStorage.php');

    $connection = new Connection();
    $storage = new DataStorage($connection);
    $connection = $connection->connectHeroku();

    $returningUser_id = $_SESSION['returningUser_id'];

    $formatted = new NumberFormatter('en_US', NumberFormatter::PERCENT);

    // get selection from database here
    $saved_searches = pg_query($connection, "SELECT hashtag, avg_sentiment, avg_magnitude
      FROM savedsearches, averages INNER JOIN hashtag 
      ON averages.hashtag_id = hashtag.id 
      WHERE savedsearches.user_id = '$returningUser_id' AND 
      savedsearches.hashtag_id = hashtag.id");

    if (pg_fetch_assoc($saved_searches) == false) {
        echo 'You haven\'t made any searches yet!<p><a class="login_link" href="javascript:showHome()">Return to search</a> </p>';
    } else {
        while ($search = pg_fetch_assoc($saved_searches)) {
            echo '<p>';
            echo '#' . $search['hashtag'] . '<br/>';
            echo 'Sentiment: ' . $formatted->format($search['avg_sentiment']) . '<br/>';
            echo 'Magnitude: ' . $formatted->format($search['avg_magnitude']);
            echo '</p>';
        }
    }
} else {
    echo '<p>Log in <a class="login_link" href="javascript:showLogin()">here</a> to see your past search results.
            <p></p>Don\'t have an account? Create one <a class="login_link" href="javascript:showAccountCreation()">here.</a></p>';
}