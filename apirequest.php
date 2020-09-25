<?php 

// Start session 

session_start();

//Require TwitterOAuth library 

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

// If the user has submitted the search form 

if (isset($_POST['search'])) {

//Authentication variables

    // Our config file contains constants for our consumer key and consumer secret key
    // as well as our access token and access token secret
    
    require './assets/inc/config.php';

    // Create variables for:
    // OAuth access token, and access token secret

    // Begin making API requests

    function returnToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret)
    {
        $twitter = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);

        if (!$twitter){
            throw new Exception ("Can't connect to Twitter's API."); 
            die();
        }else{
            return $twitter;
        }
    }

    try {
        $twitter = returnToken(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
    }
    catch(Exception $e){
        echo "Caught an issue: " . $e->getMessage();
    }

    // Make an API request to get # tweets from $username's timeline

    // $username = "@realDonaldTrump"; // Whomever
    // $numtweets=100; // Number of tweets to be analyzed

    // If the user has submiited the form, set username and number of tweets

    $username = $_POST['searchbar-un'];

    $numtweets = $_POST['searchbar-nm'];

    // Tweets returns an array of objects, some of which
    // contain further arrays and or objects
    // The get method makes GET HTTP requests to Twitter's API

        $tweets=$twitter->get('statuses/user_timeline', ['screen_name' => "$username", 'count' => $numtweets, "exclude_replies" => 1]);
    // Store in JSON file

    // Notice: As of 09/20/20

    // Data stored in JSON file is only meant to persist as long as the user's query.
    // i.e., every time the user submits a query, the former file will be erased.

    $json = json_encode($tweets);

    file_put_contents("./assets/json/data.json", $json);}
 
    // if i decide to have the data persist beyond the user's initial query 

    //     if (!file_exists("./assets/json/data.json")){

    //     file_put_contents("./assets/json/data.json", $json);

    // }

    // else{

    //     $json_d = json_decode(file_get_contents('./assets/json/data.json'));
    //     $json = json_encode(array_merge($tweets, $json_d));
    //     file_put_contents('./assets/json/data.json', $json);
    // }
// } // This last brace connects to isset(); 

// Redirect the user to a PHP script which will analyze each tweet for its sentiment, 
// i.e., whether it is "positive," "negative," or "neutral" 

// Output will be from JSON file herein created. 

?>