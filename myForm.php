
<html>
  <head></head>
  <body>
    <form mode="GET" action="#">
    <input name="username" type="text" placeholder="Enter your username"/>
    <input name="password" type="password" placeholder="Enter a password"/>
    <input name="confirmpassword" type="password" placeholder="Confirm your password"/>
    
    <input type="submit" value="Log in"/>
    
    </form>
  </body>
</html>


<?php

if( isset($_GET['password']) and isset($_GET['confirmpassword']) and $_GET['password'] == $_GET['confirmpassword'] ){
  echo "<br><pre>" . var_export($_GET, true) . "</pre><br>";
} elseif (isset($_GET['password']) and isset($_GET['confirmpassword']) and $_GET['password'] != $_GET['confirmpassword']){
  echo "Passwords do not match. Try again.";
} else {
  echo "Please enter a username and password.";
}

?>