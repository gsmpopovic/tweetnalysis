<?php

require_once('sentiment.php');

// Get JSON file

$tweets=json_decode(file_get_contents('assets/json/analysis.json')); 

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