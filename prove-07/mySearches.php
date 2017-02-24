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

//TODO: fix menu not snapping back after clicking menu item
//TODO: make explanation NOT blue at startup
//TODO: perhaps add greater explanation to what sentiment and magnitude are

//TODO: make sure character validation doesn't submit unless errors are fixed
   // could pop up alert "hey change it so you can submit"