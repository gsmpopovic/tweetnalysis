<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
        <link href="./assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/bootstrap.css.map" rel="stylesheet" type="text/css" />

        <script>
            // AJAX error handling

            function parseJSON (){
                var file = "./process.php";

                var request = new XMLHttpRequest();

                try{
                var request = new XMLHttpRequest();
                }

                catch(error1){
                    try {
                        var request = new ActiveXObject("Msxm12.XMLHTTP");
                    }
                    catch (error2){

                        try {
                        var request = new ActiveXObject("Microsoft.XMLHTTP");
                        }

                        catch(error3){
                            alert ("Whoops. Can't AJAX.")

                        }
                    }
                }

            request.onreadystatechange = function(){
                
                if (request.onreadystatechange==4){
                    var json = JSON.parse(request.responseText);
                    console.log(json);
                //     if (json == "fail"){
                //     alert("C'mon, man. That's not a valid Twitter handle.");
                //     event.preventDefault();
                // }
                }
            }

            request.open("GET", file, true);
            request.send();

        }
            var submit = document.getElementById("submit");

            if (submit) {
                submit.addEventListener("click", parseJSON());
            }
            			
        </script>
    </head>
    <body style="overflow-x:hidden;">
        <div class="container-fluid h-100">
            <div class="row h-15 mb-md-2">
                <div class="col-md-12">
                    <h1 class="h1 display-2" style="text-align: center;">Tweetnalysis</h1>
                </div>
            </div>
            <div class="row" id="index-body">
                <div class="col-md-6">
                    <form action="displaycp.php" method="POST" class="p-5 rounded text-light" style="background:#35bdff;">
                        <div class="form-group">
                            <label for="searchbar-un" class="display-6"> 
                                Enter a Twitter handle:

                                <input type="text" name="searchbar-un" class="form-control" id="searchbar-un" placeholder="@whomever" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="display-6">
                                How many tweets would you like to analyze?

                                <select name="searchbar-nm" class="form-control" id="searchbar-nm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="search" class="btn btn-secondary" id="submit" />
                    </div>
                    </form>
                </div>
                <div class="col-md-6">
                <div class="col-md-9 h-40">
                        <div class="card">
                            <div class="card-body">
                        <p> Tweetnalysis is a web application that retrieves tweets from a handle's timeline and analyzes their sentiment (the author's mood and attitude, as evidenced by their use of language). The PHP library is the work of David Oti, and can be found <a href="https://github.com/davmixcool/php-sentiment-analyzer">here</a>. The original project by C.J. Hutto et al. was written in Python, and can be found <a href="https://github.com/cjhutto/vaderSentiment">here</a>.
</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-9 h-40">
                        <div class="card">
                            <div class="card-body">
                                <p>Sentiment analysis is performed using a VADER (Valence Aware Dictionary and SEntiment Reasoner) approach, where each tweet is decomposed into a string of words, and each word checked against against an entry in a lexicon. In this case, C.J. Hutto's lexicon lists the sentiment of common words as so rated by ten independent particpants, on a scale of +4 (exceedingly positive) to -4 (exceedingly negative).
</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 h-40">
                        <div class="card">
                            <div class="card-body">
                            <p>The average of these ten ratings composes each category, whether, positive (e.g., "good"), negative (e.g., "bad"), or neutral (i.e., no strong attitude indicated) associated with each Words are checked both for <i>polarity</i> (whether good or bad) and their <i>intensity</i> (how good or bad). The overall sentiment of each tweet is broken down into percentages based on these scores.
</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/script.js"></script>
    </body>
</html>
