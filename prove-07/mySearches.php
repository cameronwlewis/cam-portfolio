<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
<?php
session_start();
if ($_SESSION['user_loggedIn'] == true) {
    require ('Connection.php');
    require ('DataStorage.php');

    $connection = new Connection();
    $storage = new DataStorage($connection);
    $connection = $connection->connectHeroku();

    $formatted = new NumberFormatter('en_US', NumberFormatter::PERCENT);

    // get selection from database here:
    $saved_searches = pg_query($connection, "SELECT avg_sentiment, avg_magnitude, hashtag 
      FROM savedsearches, averages INNER JOIN hashtag 
      ON averages.hashtag_id = hashtag.id 
      WHERE savedsearches.hashtag_id = hashtag.id");

    //$searches = pg_fetch_assoc($saved_searches);

    while($search = pg_fetch_assoc($saved_searches)){
        echo '<p>';
        echo '#'.$search['hashtag'].'<br/>';
        echo 'Sentiment: '.$formatted->format($search['avg_sentiment']).'<br/>';
        echo 'Magnitude: '.$formatted->format($search['avg_magnitude']);
        echo '</p>';
    }
}
else {
    echo '<p>Log in to save your search results. Click 
        <a id="login_link" href="javascript:showAccountCreation()">here</a> 
            to make an account.</p><p>Already have an account? Log in 
          <a id="login_link" href="javascript:showLogin()">here.</a></p>';
}