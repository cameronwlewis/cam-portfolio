<?php
session_start();
if (isset($_SESSION['search_index'])) {
    $_SESSION['search_index'] += 1;
}
else {
    $_SESSION['search_index'] = 0;
}

//var_dump($_SESSION['search_index']);

require('Connection.php');
require('DataStorage.php');
require('Statistics.php');

# Initialize arrays and variables
$user_name = [];
$user_followers = [];
$user_text = [];
$sentiment_scores = 0.00;
$magnitude_scores = 0.00;

$connection = new Connection();

$storage = new DataStorage($connection);
$google_cloud = $connection->connectGoogleCloud();
$twitter = $connection->connectTwitter();

$formatted = new NumberFormatter('en_US', NumberFormatter::PERCENT);

$hashtag = $_POST['input_hashtag'];

# If present, make sure pound character (#) is removed prior to sending input to
# the Twitter API
$hashtag = str_replace('#', '', $hashtag);

$query = '%23' . $hashtag;
$last_hashtag_id = $storage->storeHashtag($hashtag);

$tweets = $twitter->get("search/tweets", ["q" => $query, "lang" =>
    'en', 'result_type' => 'recent', 'count' => 30,]);

# Loop that gets the sentiment of each tweet
for ($i = 0; $i < 30; $i++) {
    $user_name[$i] = $tweets->statuses[$i]->user->screen_name;
    $user_followers[$i] = $tweets->statuses[$i]->user->followers_count;
    $user_text[$i] = $tweets->statuses[$i]->text;

    $annotation = $google_cloud->analyzeSentiment($user_text[$i]);
    $analysis = $annotation->sentiment();

    $sentiment = $analysis['score'];
    $magnitude = $analysis['magnitude'];

    # store tweets in table
    $last_tweet_id = $storage->storeTweets($user_name[$i],
        $user_followers[$i], $user_text[$i]);

    # store sentiment and magnitude in table
    $storage->storeSentimentPerTweet($last_tweet_id,
        $last_hashtag_id, $sentiment, $magnitude);

    # temporarily store scores so they can be averaged
    $sentiment_scores += $sentiment;
    $magnitude_scores += $magnitude;
}

# Divide to get the average sentiment and magnitude for all the tweets analyzed
$sentiment_average = $sentiment_scores / 30;
echo 'Sentiment: ' . $formatted->format($sentiment_average);
echo '<br/>';

$magnitude_average = $magnitude_scores / 30;
echo 'Magnitude: ' . $formatted->format($magnitude_average);

# Store the averages
$storage->storeAvgSentiment($last_hashtag_id, $sentiment_average,
    $magnitude_average);

if (!$_SESSION['user_loggedIn']){
    # Save results to session
    $_SESSION['saved_search'] = $last_hashtag_id;

    echo '<p>Save your results! Click 
        <a id="login_link" href="javascript:showAccountCreation()">here</a> 
            to make an account.</p><p>Already have an account? Log in 
          <a id="login_link" href="javascript:showLogin()">here.</a></p>';
}
else {
    $storage->attachToAccount($_SESSION['returningUser_id'], $last_hashtag_id);
}

