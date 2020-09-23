<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php ?>

    <form action="render.php" method="POST">

        <label for='searchbar-un'>Enter a Twitter handle
        <input type='text' name='searchbar-un' id='searchbar-un' placeholder="@whomever">
        </label>
        <br></br>
        <label>How many tweets would you like to analyze? 
        <select name="searchbar-nm" id='searchbar-nm'> 
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select> 

        <input type="submit" name="search" id="submit">
        </label>
    </form>
    <script src="assets/js/script.js"></script>
</body>
</html>