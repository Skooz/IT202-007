<?php 
// Profile page. Shows user is logged in, if not they are sent to log in. 
// Used "https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database" as a resource.
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="header">
  	<h2>Profile Page</h2>
  </div>
  
  <div class="content" text-align: center>
    <p>
      <strong><a class="btn" href="index.php">Home</a></strong>
      <strong><a class="btn" href="profiles.php"><?php echo $_SESSION['username']; ?></a></strong>
    </p>
    <?php
        // We re-use the code from TopScores.php, but we have to format it for an HTML page.
        require('config.php');
        $db = mysql_connect($host, $dbUsername, $dbPassword) or die('Failed to connect: ' . mysql_error()); 
        mysql_select_db($database) or die('Failed to access database');
     
         //This query grabs the top 10 scores, sorting by score and timestamp.
        $query = "SELECT * FROM Score ORDER by score DESC, ts ASC LIMIT 10";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        //We find our number of rows
        $result_length = mysql_num_rows($result); 
        //And now iterate through our results
        for($i = 0; $i < $result_length; $i++)
        {
             $row = mysql_fetch_array($result);
             echo nl2br($i+1 . " - " . $row['name'] . " - " . $row['score'] . "\n"); // And output them
        }
    ?>
    
    <p> <a class="btn" href="index.php?logout='1'" style="color: cyan;">logout</a> </p>
  </div>
  
</body>
</html>