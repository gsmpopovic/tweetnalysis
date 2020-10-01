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
                    "positive"
                ) {
                    pos++;
                } else if (
                    json[key].overall ==
                    "negative"
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
			
			// Alter the HTML that states the overall sentiment. 

			var overall = document.getElementsByClassName("overall"); 

			for (elem of overall){
				if (overall.innerHTML == "positive"){

				elem.style="color: green;";
				}

				else if (overall.innerHTML=="negative"){

				elem.style="color:red;";
				}

				else{
				elem.style="color:blue;";
				}
			}
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

			<div class="d-md-flex p-3 justify-content-center align-content-center">
				<!-- Download tweets --> 
				<a href="assets/csv/analysis.csv" download><button class="btn btn-dark text-light rounded" style="height: 60px; width: 190px;">Download Analysis</button></a>

				<!-- Download tweets --> 
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
	</body>
</html>