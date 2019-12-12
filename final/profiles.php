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
  
  <div class="content">
    	<?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
        	<h3>
            <?php 
            	echo $_SESSION['success']; 
            	unset($_SESSION['success']);
            ?>
        	</h3>
        </div>
    	<?php endif ?>
  
      <?php  if (isset($_SESSION['username'])) : ?>
      
        <p>
          <strong><a class="btn" href="index.php">Home</a></strong>
          <strong><a class="btn" href="Leaderboard.php">Leaderboard</a></strong>
        </p>
        
      	<p>
          <?php 
            // Login to DB again so we can get profile information here
            require('config.php');
            $db = mysqli_connect($host, $dbUsername, $dbPassword, $database);
            
            $profile = $_SESSION['username'];
            
            // Get info from users table
            $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE username='$profile'"));
            echo nl2br("Username: " . $user['username'] . "\nE-Mail: " . $user['email']);
            
            // Get info from Score table
            $user = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM Score WHERE name='$profile'"));
            echo nl2br("\nHigh Score: " . $user['score']);
          ?>
        </p>
        
      	<p> <a class="btn" href="index.php?logout='1'" style="color: cyan;">logout</a> </p>
      <?php endif ?>
  </div>
</body>
</html>