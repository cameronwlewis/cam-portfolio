<?php
session_start();

require('Statistics.php');
require ('Connection.php');

$connection = new Connection();
$stats = new Statistics($connection);

$most_negative = $stats->mostNegative();
$most_positive = $stats->mostPositive();
$most_emotion = $stats->mostEmotion();
$most_controversy = $stats->mostControversy();

$formatted = new NumberFormatter('en_US', NumberFormatter::PERCENT);
echo'<p style="font-size: 150%; font-weight: 100; ">Of the hashtags 
users have
 searched so 
far</p>';
echo 'Most Negative hashtag(s): <br/>';
while ($row = pg_fetch_assoc($most_negative)){

    echo '#'.$row['hashtag'];
    echo '<br/>';
    echo $formatted->format($row['avg_sentiment']);
}
echo '<p>Most Positive hashtag(s): <br/>';
while ($row = pg_fetch_assoc($most_positive)){
    echo '#'.$row['hashtag'];
    echo '<br/>';
    echo $formatted->format($row['avg_sentiment']);
}
echo '</p>';
echo '<p>Most emotional hashtag(s): <br/>';
while ($row = pg_fetch_assoc($most_emotion)){
    echo '#'.$row['hashtag'];
    echo '<br/>';
    echo $formatted->format($row['avg_magnitude']);
    echo '<br/>';
}
echo '</p>';
echo '<p>Most controversial hashtag(s):';
echo '<br/>#'.$most_controversy;
echo '<br/>';
echo 'Percent split between sides: <br/>'.$stats->getPercentControversy();
echo '</p>';
?>