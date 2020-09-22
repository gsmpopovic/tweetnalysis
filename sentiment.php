<?php 

// Load our Twitter API response

require_once('apirequest.php');

// Load our classes (i.e., TweetAnalyzed)

require_once('./assets/inc/autoload.php');

// Load the PHP Sentiment Analysis library using composer 

require_once('./vendor/autoload.php');

Use Sentiment\Analyzer;

$analyzer = new Analyzer(); 

// Retrieve tweets from a JSON file 
// This will return an object that we will then iterate over 

$object = json_decode(file_get_contents('./assets/json/data.json')); 

            // $length = count($object);

            // $positive = 0; 
            // $negative = 0; 
            // $neutral = 0; 

            // echo "<br>";
            // echo "So, I was able to pull $length tweets."; 
            // echo "<br>";

foreach($object as $k => $v){

    // For reference as to each tweet's contents, see the dataref.json 

    // Create an instance of a class which will contain 
    // the highlights of each tweet, i.e., text, timestamp, author, location, 
    // and its semantic analysis 

    $tweet = new TweetAnalyzed();

    // Get tweet text
    $tweet->tweet = $object[$k]->text; 

    // Get tweet timestamp
    $tweet->created_at=$object[$k]->created_at; 

    // Get tweet's author 
    $tweet->author=$object[$k]->user->name; 

    // Get author's twitter handle 
    $tweet->handle=$object[$k]->user->screen_name; 

    // Get location at which tweet created 
    $tweet->location=$object[$k]->user->location; 

    // Perform sentiment analysis

    // This returns an associative array in the form of
    // ['neg'=> 0.0, 'neu'=> 0.337, 'pos'=> 0.663, 'compound'=> 0.7096]
    // Which are percentiles denoting how negative, neutral, positive some text is. 
    // So: 0% negative; 33.7% neutral; 66.3% positive; 

    // The Compound score is a metric that calculates the sum of all the lexicon ratings 
    // which have been normalized 
    // between -1(most extreme negative) and +1 (most extreme positive).

    // positive sentiment : (compound score >= 0.05)
    // neutral sentiment : (compound score > -0.05) and (compound score < 0.05)
    // negative sentiment : (compound score <= -0.05)


    $analysis = $analyzer->getSentiment($tweet->tweet);

    // Percentage of negative sentiment 
    $tweet->neg = $analysis['neg']*100;
    // Percentage of neutral sentiment
    $tweet->neu = $analysis['neu']*100; 
    // Percentage of positive sentiment
    $tweet->pos = $analysis['pos']*100; 
    // Overall sentiment 
    // $overall = "This string was, overall, "; 

    // If a JSON file does not exist, create one to hold our tweets that have been
    // analyzed

    if (!file_exists('./assets/json/analysis.json')){

        // Create an array that will store our tweets

        $array = json_encode(array());
        
       file_put_contents('./assets/json/analysis.json', $array);

    }

    else{

        // If a file does exist, get its contents in the form of an associative array

        $json_decode=json_decode(file_get_contents('./assets/json/analysis.json'), true);

        // Manually index this array, i.e., setting a key for each tweet as object 

        $json_decode["$k"]=$tweet; 
        
        // Encode this and set it back into our JSON file 

        $json_encode = json_encode($json_decode); 

        file_put_contents('./assets/json/analysis.json', $json_encode); 

    }


                // echo "<br>"; 
                // echo "String at position $k was: $tweet->tweet";
                // echo "<br>";

                // echo "This string rated at "
                // . $tweet->neg."% negative, "
                // .$tweet->neu."% neutral, and "
                // .$tweet->pos."% positive";
                // echo "<br>";
                
                // if ($tweet->pos > $tweet->neg){
                //     $positive++; 
                //     echo $overall .= "positive.";
                // }
                
                // else if ($tweet->neg > $tweet->pos){
                //     $negative++; 
                //     echo $overall .= "negative.";

                // }

                // else{
                //     $neutral++; 
                //     echo $overall .= "neutral.";
                // }
                // echo "<br>";

}
?>