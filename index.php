<?php 

// Start session 
session_start();

//Require TwitterOAuth library 

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

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

$username = "@realDonaldTrump"; // Whomever

$numtweets=100; // Number of tweets to be analyzed

// Tweets returns an array of objects, some of which 
// contain further arrays and or objects
// The get method makes GET HTTP requests to Twitter's API

$tweets=$twitter->get('statuses/user_timeline', ['screen_name' => "$username", 'count' => $numtweets, "exclude_replies" => 1]);

// Store in JSON file 

$json = json_encode($tweets);

file_put_contents("data.json", $json);

?>