<?php
// Server.php handles forms for registration and login, and connection to the database
// Used "https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database" as a resource.

session_start();

// variables
$username = "";
$email    = "";
$errors = array(); 

// establish connection with database
require('config.php');
$db = mysqli_connect($host, $dbUsername, $dbPassword, $database);

// REGISTER USER
if (isset($_POST['reg_user'])) 
{
  // get raw values from form
  $rawUsername   = mysqli_real_escape_string($db, $_POST['username']);
  $rawEmail      = mysqli_real_escape_string($db, $_POST['email']);
  $rawPassword_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $rawPassword_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // make sure form is filled correctly
  if (empty($rawUsername))   { array_push($errors, "Username is required"); }
  if (empty($rawEmail))      { array_push($errors, "Email is required"); }
  if (empty($rawPassword_1)) { array_push($errors, "Password is required"); }
  if ($rawPassword_1 != $rawPassword_2) { array_push($errors, "The two passwords do not match"); }

  // check database for existing users
  $user_check_query = "SELECT * FROM users WHERE username='$rawUsername' OR email='$rawEmail' LIMIT 1";
  $result           = mysqli_query($db, $user_check_query);
  $user             = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $rawUsername) 
    {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $rawEmail) 
    {
      array_push($errors, "E-mail already exists");
    }
  }

  // if there's no errors, process that info!
  if (count($errors) == 0) 
  {
    /////////////////////////////////////////////////
    // string sanitize functionality to avoid
    // sql or html injection abuse
    /////////////////////////////////////////////////
    function no_naughty($string){
        // ie does not understand "&apos;" &#39; &rsquo;
        $string = preg_replace("/'/i", '&rsquo;', $string);
        $string = preg_replace('/%39/i', '&rsquo;', $string);
        $string = preg_replace('/&#039;/i', '&rsquo;', $string);
        $string = preg_replace('/&039;/i', '&rsquo;', $string);
        $string = preg_replace('/"/i', '&quot;', $string);
        $string = preg_replace('/%34/i', '&quot;', $string);
        $string = preg_replace('/&034;/i', '&quot;', $string);
        $string = preg_replace('/&#034;/i', '&quot;', $string);
    
        return $string;
    }
    function my_utf8($string){
        return strtr($string,
          "/<>???????????? ??????????????????????????????????????????????",
          "![]YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
    }
    function safe_typing($string){
        return preg_replace("/[^a-zA-Z0-9 \!\@\%\^\&\*\.\*\?\+\[\]\(\)\{\}\^\$\:\;\,\-\_\=]/", "", $string);
    }
    function sanitize($string){
        $MAX_LENGTH = 250;
        $string = substr($string, 0, $MAX_LENGTH);
        $string = no_naughty($string);
        $string = my_utf8($string);
        $string = safe_typing($string);
        return trim($string);
    }
    
    // If they did something stupid, then they don't really need to know about it.
    // Sanitize!
    $username   = sanitize($rawUsername);
    $email      = sanitize($rawEmail);
    $password_1 = sanitize($rawPassword_1);
    
    // Now encrypt and insert.
  	$password = md5($password_1); //encrypt password before saving
  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success']  = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) 
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) 
  {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) 
  {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) 
  {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) 
    {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}
    else 
    {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>