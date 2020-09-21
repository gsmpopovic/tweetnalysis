<?php 

// Start session 

session_start();

//Require TwitterOAuth library 

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

// If the user has submitted the search form 

if(isset($_POST['search'])){

//Authentication variables 

// Our config file contains constants for our consumer key and consumer secret key 

require 'config.php';

// Create variables for: 
// OAuth access token, and access token secret

$access_token='1306362620967096324-EskIU2jNCQWDBox8axiRKyiPoDonkt';
$access_token_secret='HgUeFk4aw26P1YwdSiNZ4tZ3MQNshBjvGI4M9tmB4YuhX';

// Begin making API requests

function returnToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret){
    $twitter = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $twitter; 
}

$twitter = returnToken(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);

// Make an API request to get # tweets from $username's timeline

// $username = "@realDonaldTrump"; // Whomever
// $numtweets=100; // Number of tweets to be analyzed

// If the user has submiited the form, set username and number of tweets 

$username = $_POST['searchbar-un']; 

$numtweets = $_POST['searchbar-nm'] +1; 
// The Twitter API will obly retrieve count -1; 
// so, increment to compensate 

// Tweets returns an array of objects, some of which 
// contain further arrays and or objects
// The get method makes GET HTTP requests to Twitter's API

$tweets=$twitter->get('statuses/user_timeline', ['screen_name' => "$username", 'count' => $numtweets, "exclude_replies" => 1]);

// Store in JSON file

// Notice: As of 09/20/20 

// Data stored in JSON file is only meant to persist as long as the user's query. 
// i.e., every time the user submits a query, the former file will be erased. 

$json = json_encode($tweets);

file_put_contents("data.json", $json);}

// Redirect the user to a PHP script which will analyze each tweet for its sentiment, 
// i.e., whether it is "positive", "negative", or "neutral" 

// Output will be from JSON file herein created. 

header("location: sentiment.php");?>