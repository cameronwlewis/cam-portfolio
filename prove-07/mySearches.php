<?php
session_start();
if (isset($_SESSION['search_index'])) {

    $formatted = new NumberFormatter('en_US', NumberFormatter::PERCENT);

    $debug = $_SESSION['search_index'] ;
    $tags = $_SESSION['saved_searches'];

    //var_dump($debug, $tags, $sentiment, $magnitude);

    foreach($tags as $index => $tag){
        echo '<p>';
        echo '#'.$tag.'<br/>';
        echo 'Sentiment: '.$formatted->format
            ($_SESSION['saved_sentiment'][$index])
        .'<br/>';
        echo 'Magnitude: '.$formatted->format
            ($_SESSION['saved_magnitude'][$index]);
        echo '</p>';
    }
}
else {
    echo 'You haven\'t searched anything yet!';
}