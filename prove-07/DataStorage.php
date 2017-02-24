<?php

/**
 * Created by IntelliJ IDEA.
 * User: cameronlewis
 * Date: 2/18/17
 * Time: 6:01 PM
 */
class DataStorage
{
    private $heroku_postgres;

    function __construct($connection)
    {
        $this->heroku_postgres = $this->heroku_postgres =
            $connection->connectHeroku();
    }

    function storeHashtag($hashtag)
    {
        # store hashtag in table
        $hashtag_id = pg_query($this->heroku_postgres, "INSERT INTO hashtag(hashtag) VALUES('$hashtag') RETURNING id;");

        $row = pg_fetch_row($hashtag_id);
        $last_hashtag_id = $row['0'];
        return $last_hashtag_id;
    }

    function storeTweets($user_name, $user_followers,
                         $user_text)
    {
        $tweet_id = pg_query_params($this->heroku_postgres, 'INSERT INTO tweets (username, followers, tweet_text) 
    VALUES ($1, $2, $3)RETURNING id', array($user_name,
            $user_followers,
            $user_text));

        $row = pg_fetch_row($tweet_id);
        return $tweet_id = $row['0'];
    }

    function storeSentimentPerTweet($last_tweet_id,
                                    $last_hashtag_id,
                                    $sentiment, $magnitude)
    {
        pg_query_params($this->heroku_postgres, 'INSERT INTO sentiment_per_tweet 
    (tweet_id, hashtag_id, sentiment, magnitude) VALUES ($1, $2, $3, $4)', array
        ($last_tweet_id, $last_hashtag_id, $sentiment, $magnitude));
    }

    function storeAvgSentiment($last_hashtag_id, $sentiment_average,
                               $magnitude_average)
    {
        pg_query_params($this->heroku_postgres, 'INSERT INTO averages (hashtag_id, avg_sentiment, avg_magnitude)
 VALUES ($1, $2, $3)', array($last_hashtag_id, $sentiment_average,
            $magnitude_average));
    }
}