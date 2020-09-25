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

	echo <<<EOT
	<div class="card my-5">
	<div class="card-header">
		<div><p><a href="#">@TwitterHandle</a> - Author</p></div>  
	</div>
	<div class="card-body">
		<h5 class="card-title">Tweet id</h5>
		<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed aperiam provident corrupti esse! Architecto delectus consequuntur quisquam quas modi? Incidunt sit soluta aut amet ullam enim, iusto dicta quaerat ea.</p>
	</div>
	<div class="card-footer text-muted">created at </div>
</div>
EOT; 

    // echo "<br>";
    // print_r($object->$k);
    // echo "<br>";
}

?>