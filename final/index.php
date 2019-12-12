<?php 
// Index page. Shows user is logged in, if not they are sent to log in. 
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
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
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

    <!-- Main page -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>
      <strong><a class="btn" href="profiles.php"><?php echo $_SESSION['username']; ?></a></strong>
      <strong><a class="btn" href="Leaderboard.php">Leaderboard</a></strong>
      </p>
     
       <!-- The game! -->
        <head>
          <meta charset="utf-8">
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <title>Unity WebGL Player | Basic clicker game</title>
          <link rel="shortcut icon" href="TemplateData/favicon.ico">
          <script src="TemplateData/UnityProgress.js"></script>
          <script src="Build/UnityLoader.js"></script>
          <script>
            var unityInstance = UnityLoader.instantiate("unityContainer", "Build/Build.json", {onProgress: UnityProgress});
          </script>
        </head>
        <body>
          <div class="webgl-content">
            <div id="unityContainer" style="width: 600px; height: 400px"></div>
            <div class="footer">
              <div class="webgl-logo"></div>
              <div class="fullscreen" onclick="unityInstance.SetFullscreen(1)"></div>
              <div class="title">Basic clicker game</div>
            </div>
          </div>
        </body>

     
    	<p> <a class="btn" href="index.php?logout='1'" style="color: cyan;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>