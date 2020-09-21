<?php 

require_once('./vendor/autoload.php');

Use Sentiment\Analyzer;
$analyzer = new Analyzer(); 

$object = json_decode(file_get_contents('data.json')); 

foreach($object as $k => $v){

    $tweet = $object[$k]->text; 

    // Perform sentiment analysis
    // Which returns an associative array in the form of
    // ['neg'=> 0.0, 'neu'=> 0.337, 'pos'=> 0.663, 'compound'=> 0.7096]
    // Which are percentiles denoting how negative, neutral, positive something is. 
    // So: 0% negative; 33.7% neutral; 66.3% positive; 

// The Compound score is a metric that calculates the sum of all the lexicon ratings 
// which have been normalized between -1(most extreme negative) and +1 (most extreme positive).

// positive sentiment : (compound score >= 0.05)
// neutral sentiment : (compound score > -0.05) and (compound score < 0.05)
// negative sentiment : (compound score <= -0.05)


    $analysis = $analyzer->getSentiment($tweet);

    // Percentage of negative sentiment 
    $neg = $analysis['neg']*100;
    // Percentage of neutral sentiment
    $neu = $analysis['neu']*100; 
    // Percentage of positive sentiment
    $pos = $analysis['pos']*100; 
    // Overall sentiment 
    $overall = "This string was, overall, "; 

    echo "<br>"; 
    echo "String at position $k was: $tweet";
    echo "<br>";
    echo "This string rated at $neg% negative, $neu% neutral, and $pos% positive";
    echo "<br>";
    
    if ($pos > $neg){
        echo $overall .= "positive.";
    }
    
    else if ($neg > $pos){
        echo $overall .= "negative.";

    }

    else{
        echo $overall .= "neutral.";
    }
    echo "<br>";

}
?>