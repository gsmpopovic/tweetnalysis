<?php 

// Store in a PostGRES database hosted via Heroku

$dsn = "pgsql:host=ec2-34-235-62-201.compute-1.amazonaws.com;dbname=d4cde6k5s3uff8";
$username = "develtqorjkwrw";
$password = "0b4a7dd7df8f80831d5502f72ef7bdac2f252c2a2cc0ef44fce21bab03a84947";
$tablename = "tweets"; 

try {
    $connection = new PDO($dsn, $username, $password);
    $dconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
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

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit; 
}

?>