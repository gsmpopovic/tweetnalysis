<?php 

// The class TweetAnalyzed is intended to represent each tweet 
// after it has been processed using a VADER sentiment analysis library
// i.e., as found in composer/davmixcool/php-sentiment-analyzer

// Its properties make reference to those of the each tweet as obtained
// from Twitter's API, 
// as well as post-analysis ratings

class TweetAnalyzed {

    // Contain text of tweet
    public $tweet = null;

    // Time at which tweet created 
    public $created_at = null; 

    // Tweet's author 
    public $author = null; 

    // Author's Twitter handle 

    public $handle = null; 

    // User's location when tweet created
    public $location = null; 

    // Percentages of rating broken down by 
    // positive, negative, and neutral 

    public $pos = null;     
    public $neg = null; 
    public $neu = null; 
    public $compound = null; 

    // Most predominant sentiment 

    public $overall = "The sentiment of this tweet was, overall, "; 

}

?>