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

$twitter_data = json_decode(file_get_contents('./assets/json/data.json')); 

// Create an twitter_data that will store the contents of our JSON file 
        
$json = new stdClass();

// Iterate over data retrieved from twitter; 
// this data consist of twitter_datas containing all information 
// relevant to a tweet 

// echo "start of loop";

    foreach($twitter_data as $k => $v){

        // For reference as to each tweet's contents, see the dataref.json 

        // Create an instance of a class which will contain 
        // the highlights of each tweet, i.e., text, timestamp, author, location, 
        // and its semantic analysis 

        $tweet = new TweetAnalyzed();

        // Get tweet text

        // Twitter recently changed the property of text to full_text (09/25/20)
        $tweet->tweet = $twitter_data[$k]->full_text; 

        // Get tweet timestamp
        $tweet->created_at=$twitter_data[$k]->created_at; 

        // Get tweet's author 
        $tweet->author=$twitter_data[$k]->user->name; 

        // Get author's twitter handle 
        $tweet->handle=$twitter_data[$k]->user->screen_name; 

        // Get location at which tweet created 
        $tweet->location=$twitter_data[$k]->user->location; 

        // Perform sentiment analysis

        // This returns an associative array in the form of
        // ['neg'=> 0.0, 'neu'=> 0.337, 'pos'=> 0.663, 'compound'=> 0.7096]
        // Which are percentiles denoting how negative, neutral, positive 
        // the sentiment of some piece of text is. 
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
        // Percentage of compound sentiment
        $tweet->compound = $analysis['compound']*100; 
        // Overall sentiment 
        
        if (($tweet->neu > $tweet->neg) && ($tweet->neu > $tweet->pos)){
            $tweet->overall = "neutral";
        }
        else if ($tweet->neg > $tweet->pos){
            $tweet->overall = "negative";
        }

        else if ($tweet->pos > $tweet->neg){
            $tweet->overall = "positive";
        }

        // Cast index of our loop to string
        // in order to index our JSON 
        $key = strval($k); 

        // Set each tweet within our JSON file 
        $json->$key=$tweet; 

    }
        // Encode this and set it back into our JSON file 

        $json2 = json_encode($json); 

        file_put_contents('./assets/json/analysis.json', $json2); 

        // CSV processing 

        // $row = get_object_vars($tweet);
        // $column = array_keys($row);

        jsonToCSV("./assets/json/analysis.json", "./assets/csv/analysis.csv");

?>