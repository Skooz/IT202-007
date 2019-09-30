<?php
	echo "<pre>" . var_dump($_GET, true) . "</pre>";

	// Full name!
	if(isset($_GET['firstname']) ){
		echo "<br>Your first name is  " . $_GET['firstname'] .  "<br>";
	}
	if(isset($_GET['lastname']) ){
		echo "<br>Your last name is  " . $_GET['lastname'] . "<br>";
	}

	$fullName = $_GET['firstname'] . " " . $_GET['lastname'];
	echo "<br>Your full name is  " . $fullName . "<br>";

	// Add numbers!
	if(isset($_GET['number1'])){
		if(is_numeric($_GET['number1'])){
			echo "<br>" . $_GET['number1'] . " is a number<br>";
		}
		else{
			echo "<br>" . $_GET['number1'] . " is not a number<br>";
		}
	}
	if(isset($_GET['number2'])){
		if(is_numeric($_GET['number2'])){
			echo "<br>" . $_GET['number2'] . " is a number<br>";
		}
		else{
			echo "<br>" . $_GET['number2'] . " is not a number<br>";
		}
	}

  if( isset($_GET['number2']) and isset($_GET['number1']) and is_numeric($_GET['number2']) and is_numeric($_GET['number1']) )
  {
	  $number3 = $_GET['number1'] + $_GET['number2'];
	  echo "<br>number1 + number2 = " . $number3 . "<br>";
   }
		
//handleRequestData.php?parameter1=a&p2=b	

?>