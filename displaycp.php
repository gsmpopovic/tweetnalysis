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

require_once('sentiment.php');

// Get JSON file

// $json = file_get_contents("assets/json/analysis.json");

// $json = file_get_contents("https://tweetnalysis.herokuapp.com/assets/json/analysis.json");

// $tweets=json_decode($json);

$tweets=$json; 

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