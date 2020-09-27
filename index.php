<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
        <link href="./assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="./assets/css/bootstrap.css.map" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container-fluid h-100">
            <div class="row h-15 mb-md-2">
                <div class="col-md-12">
                    <h1 class="h1 display-2" style="text-align: center;">Tweetnalysis</h1>
                </div>
            </div>
            <div class="row" id="index-body">
                <div class="col-md-6">
                    <form action="display.php" method="POST" class="p-5 bg-primary rounded text-light">
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
                <div class="col-md-9 h-40 my-md-2">
                        <div class="card">
                            <div class="card-body">
                                Tweetnalysis is a web application that retrieves tweets from a handle's timeline and analyzes their sentiment (the author's mood and attitude, as evidenced by their use of language). The PHP library is the work of David Oti, and can be found <a href="https://github.com/davmixcool/php-sentiment-analyzer">here</a>. The original project by C.J. Hutto et al. was written in Python, and can be found <a href="https://github.com/cjhutto/vaderSentiment">here</a>.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 h-40 my-md-2">
                        <div class="card">
                            <div class="card-body">
                                Sentiment analysis is performed using a VADER (Valence Aware Dictionary and SEntiment Reasoner) approach, where each tweet is decomposed and each word checked against a lexicon that which lists the sentiment of common words--whether, positive (e.g., "good"), negative (e.g., "bad"), or neutral (i.e., no strong attitude indicated). Words are checked both for polarity (whether good or bad) and their intensity (how good or bad). The overall sentiment of each tweet is broken down into percentages based on these scores.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/script.js"></script>
    </body>
</html>
