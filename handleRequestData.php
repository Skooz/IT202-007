<?php
	echo "<pre>" . var_dump($_GET, true) . "</pre>";

	if(isset($_GET['name'])){
		echo "<br>Hello, " . $_GET['name'] .  "<br>";
	}
	if(isset($_GET['number'])){
		echo "<br>" . $_GET['number'] . " should be a number...";
		echo "<br>but it might not be<br>";
	}
	
//TODO
//handle addition of 2 or more parameters
//concatenate 2 or more parameter values and echo them
//Try passing multiple same-named parameters with different values
//Try passing a parameter value with special characters
//handleRequestData.php?parameter1=a&p2=b	

?>
