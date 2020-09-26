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