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
            document.getElementById("neg").innerHTML = neg;
            document.getElementById("neu").innerHTML = neu;

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
<h1> So, I was able to get <b id = "numTweets">#</b> of <b id="author"></b> tweets.</h1>
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"> <b id="pos">#</b> was/were rated as positive.</h5>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>

			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-body">
					<h5 class="card-title"> <b id="neg">#</b> was/were rated as negative.</h5>
					</div>
				</div>
				<!-- Ratings card --> 
			</div>
			<div class="d-md-flex p-3 justify-content-center">
				<!-- Ratings card --> 
				<div class="card">
					<div class="card-body">
					<h5 class="card-title"> <b id="neu">#</b> was/were rated as neutral.</h5>
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
				<?php require_once('dynamichtml.php');?>
					<!-- Tweet cards -->
				</div>
			</div>
		</div>
		<!-- Second Half -->
		<!--===============================================================================-->
	</div>
	<!-- <script src='./assets/js/ajax.js'></script> -->
	</body>
</html>