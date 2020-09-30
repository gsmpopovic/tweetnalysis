<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Document</title>
	<link href="./assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="./assets/css/bootstrap.css.map" rel="stylesheet" type="text/css">

	<script>
	// AJAX

function parseJSON() {
    var file = "assets/json/analysis.json";

    var request = new XMLHttpRequest();

    try {
        // Chrome, Safari, etc.
        var request = new XMLHttpRequest();
    } catch (error) {
        // Internet explorer
        try {
            var request = new ActiveXObject("Msxm12.XMLHTTP");
        } catch (error) {
            try {
                var request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (error) {
                alert("whoops. Something went wrong when trying to perform AJAX.");
            }
        }
    }

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var json = JSON.parse(request.responseText);
			var length = Object.keys(json).length;

            // This will display to the user how many tweets were actually scraped
            // from Twitter's API
            document.getElementById("numTweets").innerHTML = length;

            var pos = 0;
            var neg = 0;
            var neu = 0;

            var author;

            for (var key in json) {
                if (
                    json[key].overall ==
                    "The sentiment of this tweet was, overall, positive."
                ) {
                    pos++;
                } else if (
                    json[key].overall ==
                    "The sentiment of this tweet was, overall, negative."
                ) {
                    neg++;
                } else {
                    neu++;
                }
            }

            // Alter the HTML that states how many tweets were rated positive,
            // negative, etc.

			document.getElementById("pos").innerHTML = pos;
			if (pos == 1){

				document.getElementById("poswere").innerHTML = "was";

			}
			document.getElementById("neg").innerHTML = neg;
			if (neg == 1){
				document.getElementById("negwere").innerHTML = "was";

			}
			document.getElementById("neu").innerHTML = neu;
			if (neu == 1){
				document.getElementById("neuwere").innerHTML = "was";

			}
			
            // Alter the HTML that states the author of the tweets

            var author = json[0].author;
            document.getElementById("author").innerHTML = author + "'s";
        }
    };

    request.open("GET", file, true);
    request.send();
}

parseJSON();
</script>

</head>
<body>
	<div class="d-md-flex h-md-100 align-items-center">
        <!--===============================================================================-->
		<!-- First Half -->
		<div class="col-md-6 p-0 bg-white h-md-100 overflow-auto">

		<div class="d-md-flex p-3 justify-content-center">
<h1> So, I was able to get <b id = "numTweets">#</b> of <b id="author">this author's</b> tweets.</h1>
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"> <b id="pos">#</b> <span id="poswere">were</span> rated as <b style="color:green;">positive</b>.</h5>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-body">
					<h5 class="card-title"> <b id="neg">#</b> <span id="negwere">were</span> rated as <b style="color:red;">negative</b>.</h5>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>
			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-body">
					<h5 class="card-title"> <b id="neu">#</b> <span id="neuwere">were</span> rated as <b style="color:blue;">neutral</b>.</h5>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>		
		</div>

		<!-- First Half -->

		<!-- Second Half -->
		<div class="col-md-6 h-md-100 overflow-auto" style="background: #35bdff;">
			<div class="d-md-flex h-100 text-center justify-content-center">
				<div class="logoarea py-5">
					<!-- Tweet cards -->
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
            $tweet->overall .= "neutral.";
        }
        else if ($tweet->neg > $tweet->pos){
            $tweet->overall .= "negative.";
        }

        else if ($tweet->pos > $tweet->neg){
            $tweet->overall .= "positive.";
        }
        // echo "end of conditional";

        // Cast index of our loop to string
        // in order to index our JSON 
        $key = strval($k); 

        // Set each tweet within our JSON file 
        $json->$key=$tweet; 

    }
// echo "end of loop";

        // Encode this and set it back into our JSON file 

        $json2 = json_encode($json); 

        file_put_contents('./assets/json/analysis.json', $json2); 

        // echo "abc";

// Get JSON file

// $json = file_get_contents("assets/json/analysis.json");

// $json = file_get_contents("https://tweetnalysis.herokuapp.com/assets/json/analysis.json");

// $tweets=json_decode($json);

$tweets=json_decode($json2); 

// if(isset($tweets)){
// 	print_r($tweets);

// }

// else{
// 	echo "nothing's here";
// }

// echo "Something";

// For reference, an entry in our JSON file looks like this: 

// "0": {
// 	"tweet": "RT @thebradfordfile: No journalist has ever asked Barack Hussein Obama to explain how the Trump campaign was spied on and General Flynn was\u2026",
// 	"created_at": "Fri Sep 25 14:13:10 +0000 2020",
// 	"author": "Donald J. Trump",
// 	"handle": "realDonaldTrump",
// 	"location": "Washington, DC",
// 	"pos": 0,
// 	"neg": 9.1,
// 	"neu": 90.9,
// 	"compound": -29.599999999999998,
// 	"overall": null
// }

foreach($tweets as $k => $v){

	$created = $tweets->$k->created_at;
	$location = $tweets->$k->location; 
	$handle = $tweets->$k->handle; 
	$text = $tweets->$k->tweet;
	$author = $tweets->$k->author;

	$pos = $tweets->$k->pos;
	$neg = $tweets->$k->neg;
	$neu = $tweets->$k->neu;
	$compound = $tweets->$k->compound;
	$overall=$tweets->$k->overall; 


	echo <<<EOT
	<div class="card mb-5">
	<div class="card-header">
		<div><p><a href="#">@$handle</a> - $author </p></div>  
	</div>
	<div class="card-body">
		<h5 class="card-title">Tweet id: $k</h5>
		<p class="card-text">$text</p>
	</div>
	<div class="card-header">
	<div>
	<h6>Rating:</h6>
	<p><b style="color:green;">Positive</b> sentiment: <b>$pos%</b> - <b style="color:red;">Negative</b> sentiment: <b>$neg%</b>- <b style="color:blue;">Neutral</b> sentiment: <b>$neu%</b></p> 
	<p>$overall</p>
	</div>  
</div>
	<div class="card-footer text-muted"> <p>Created at: $created</p>
	<p>Location: $location</p></div>
</div>
EOT;
}

?>
                    <!-- Tweet cards -->
				</div>
			</div>
		</div>
		<!-- Second Half -->
		<!--===============================================================================-->
	</div>
	</body>
</html>