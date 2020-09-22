<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap --> 
    
</head>
<body>
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

?>
</body>
</html>