<?php

/**
 * Created by IntelliJ IDEA.
 * User: cameronlewis
 * Date: 2/19/17
 * Time: 8:26 PM
 */
class Statistics
{
    private $heroku_postgres;
    private $best_percentage;

    function __construct($connection)
    {
        $this->heroku_postgres = $this->heroku_postgres =
            $connection->connectHeroku();

        $this->best_percentage = 0.00;
    }

    function mostPositive()
    {
        $most_positive = pg_query($this->heroku_postgres,
            'SELECT hashtag.hashtag, avg_sentiment FROM averages INNER JOIN hashtag 
             ON averages.hashtag_id = hashtag.id WHERE avg_sentiment = 
            (SELECT MAX(avg_sentiment) FROM averages)');
        return $most_positive;
    }

    function mostNegative()
    {
        $most_negative = pg_query($this->heroku_postgres,
            'SELECT hashtag.hashtag, avg_sentiment FROM averages INNER JOIN hashtag 
             ON averages.hashtag_id = hashtag.id WHERE avg_sentiment = 
            (SELECT MIN(avg_sentiment) FROM averages)');
        return $most_negative;
    }

    function mostControversy()
    {
        # Get all the tweets
        $all_tweets = pg_query($this->heroku_postgres,
            'SELECT * FROM public.sentiment_per_tweet INNER JOIN hashtag 
             ON sentiment_per_tweet.hashtag_id = hashtag.id');

        $sentiment_by_hashtag = [];

        # Store tweets into an array
        while ($row = pg_fetch_assoc($all_tweets)) {
            $sentiment_by_hashtag[$row{'hashtag'}][] = $row['sentiment'];
        }


        $negative_by_hashtag = [];
        $positive_by_hashtag = [];

        /* Now sort tweets by positive or negative sentiment, stored by
         hashtag */
        foreach ($sentiment_by_hashtag as $hashtag => $tweet) {
            foreach ($tweet as $t => $sentiment) {
                if ($sentiment < 0) {
                    $negative_by_hashtag[$hashtag][] = $sentiment;
                } else if ($sentiment > 0) {
                    $positive_by_hashtag[$hashtag][] = $sentiment;
                }
            }
        }

        $most_controversial = null;

        # Determine the most controversial hashtag
        foreach ($sentiment_by_hashtag as $hashtag => $index) {
            if (isset($negative_by_hashtag[$hashtag]))
                $numOfNeg = count($negative_by_hashtag[$hashtag]);
            else
                $numOfNeg = 0;
            if (isset($positive_by_hashtag[$hashtag]))
                $numOfPos = count($positive_by_hashtag[$hashtag]);
            else
                $numOfPos = 0;

            if ($numOfNeg == $numOfPos) {
                $most_controversial = $hashtag;
                break;
            } else if ($numOfNeg < $numOfPos) {
                $percentage = $numOfNeg / $numOfPos;
                if ($percentage > 0.4 &&
                    abs($percentage - 0.5) < abs($this->best_percentage - 0.5)
                ) {
                    $most_controversial = $hashtag;
                    $this->best_percentage = $percentage;
                }
            } else {
                $percentage = $numOfPos / $numOfNeg;
                if ($percentage > 0.4 &&
                    abs($percentage - 0.5) < abs($this->best_percentage - 0.5)
                ) {
                    $most_controversial = $hashtag;
                    $this->best_percentage = $percentage;
                }
            }
        }
        return $most_controversial;
    }

    function getPercentControversy()
    {
        $formatted = new NumberFormatter('en_US', NumberFormatter::PERCENT);
        return $formatted->format($this->best_percentage);
    }

    function mostEmotion()
    {
        $most_emotion = pg_query($this->heroku_postgres,
            'SELECT hashtag.hashtag, avg_magnitude FROM averages INNER JOIN hashtag 
             ON averages.hashtag_id = hashtag.id WHERE avg_magnitude = 
            (SELECT MAX(avg_magnitude) FROM averages)');
        return $most_emotion;
    }

}