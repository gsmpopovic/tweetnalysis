<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweetnalysis | Home</title>
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/bootstrap.css.map" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-fluid d-md-flex h-md-100 align-items-center">
    <div class="col-md-6">
    <div class="col-md-12"><h1>Tweetnalysis</h1></div>    

            <div>
                <form action="display.php" method="POST">
                    <div class="form-group">
                        <label for='searchbar-un'>Enter a Twitter handle

                            <input type='text' name='searchbar-un' class="form-control" id='searchbar-un' placeholder="@whomever" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>How many tweets would you like to analyze?

                            <select name="searchbar-nm" class="form-control" id='searchbar-nm'>
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
                        <input type="submit" name="search" class="btn btn-primary" id="submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>

</html>