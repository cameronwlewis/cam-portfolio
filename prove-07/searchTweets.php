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

# Make sure pound character (#) is removed prior to sending it to Twitter API
if (strpos($hashtag, '#') == true) {
    //PERCENT SIGN FOUND
    $hashtag = preg_replace('#', '', $hashtag);
}

$query = '%23' . $hashtag;
$last_hashtag_id = $storage->storeHashtag($hashtag);

$tweets = $twitter->get("search/tweets", ["q" => $query, "lang" =>
    'en', 'result_type' => 'recent', 'count' => 5,]);

# Loop that gets the sentiment of each tweet
for ($i = 0; $i < 5; $i++) {
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
$sentiment_average = $sentiment_scores / 5;
echo 'Sentiment: ' . $formatted->format($sentiment_average);
echo '<br/>';

$magnitude_average = $magnitude_scores / 5;
echo 'Magnitude: ' . $formatted->format($magnitude_average);

# Store the averages
$storage->storeAvgSentiment($last_hashtag_id, $sentiment_average,
    $magnitude_average);

//echo '<p>Save your results! Make an account. </p>';

# Save results to session
$index = $_SESSION['search_index'];

$saved_searches[$index] = $hashtag;
$_SESSION['saved_searches'][$index] = $saved_searches[$index];

$saved_sentiment[$index] = $sentiment_average;
$_SESSION['saved_sentiment'][$index] = $saved_sentiment[$index];

$saved_magnitude[$index] = $magnitude_average;
$_SESSION['saved_magnitude'][$index] = $saved_magnitude[$index];


