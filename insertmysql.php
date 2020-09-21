<?php 
// Store in a MySQL database

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'twitter';
$tablename = 'tweets';

$connection = new mysqli($host, $username, $password, $database);

if (!$connection){
    die($connection->connect_error);
}

else{

    // The API request returns an array of objects, each of which represents a single tweet
    // Therefore, to grab each individual tweet and inject it into a database, 
    // You have to iterate through the array, and access
    // the properties of each object 

    foreach($tweets as $k => $v) {

        // The author's name is located in the name property of the user object,
        // The author's location is, ibid.,
        // Both are located inside the tweet object,
        // inside the array

        $author = $tweets[$k]->user->name;
        $location = $tweets[$k]->user->location;

        // The timestamp of when the tweet was created, i.e., tweeted,
        // is inside the initial object
        // As is the text

        $created = $tweets[$k]->created_at;
        $text = $tweets[$k]->text;

        $query = "INSERT INTO $tablename(`author`, `created`, `location`, `text`)
        VALUES('$author',
        '$created',
        '$location',
        '$text'
        )";

        $result=$connection->query($query);

        if (!$result){

        echo "Sorry, I can only retrieve so many tweets from this user";
        echo "<br>";
        break;
        
        }
    }
}
?>