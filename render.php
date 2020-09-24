<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap --> 
    
</head>
<body>
<input type='hidden' name='formid' value='<?php echo time(); ?>'>
<?php

require_once('sentiment.php');

// Get JSON file

$json = file_get_contents("./assets/json/analysis.json");

$object=json_decode($json);

// The important keys/properties associated with these tweets are:
// 'created_at' (located in the initial object)
// 'text' (ditto)
// 'name' (located in the first object, located in the user object)

// Iterating over each array item as an object 

foreach($object as $k => $v){

    echo "<br>";
    print_r($object->$k);
    echo "<br>";
    // echo "<p>".$object[$k]->created_at."</p>";
    // echo "\n \n";
    // echo "<p>".$object[$k]->text."</p>";
    // echo "\n \n";
    // echo "<p>".$object[$k]->user->name."</p>";
}

// There's a bug where the app will make a request to Twitter's Api, parse the 
// returned data, etc., etc., and render it, BUT
// were the user to navigate back to index.php and select a higher number of tweets, 
// say, 5 the first time and 10 the second, data.json/analysis will contain 10 tweets
// but were the user to navigate back and select 5, 
// the app will render 10 instead of five 


// Temporary fix 

// Copy files into different destinations to save them 
    // copy('./assets/json/analysis.json', './assets/json/saveanalysis.json');
    // copy('./assets/json/data.json', './assets/json/savedata.json');

// Delete the original files so that the user can start over
    // unlink('./assets/json/analysis.json');
    // unlink('./assets/json/data.json');

?>
</body>
</html>