<?php
    // Reference: https://gamedevelopment.tutsplus.com/tutorials/how-to-code-a-self-hosted-phpsql-leaderboard-for-your-game--gamedev-11627
  
    // This file will retrieve the rank of the player.
  
    session_start(); 
  
    require('config.php');
    $db = mysql_connect($host, $dbUsername, $dbPassword) or die('Failed to connect: ' . mysql_error()); 
    mysql_select_db($database) or die('Failed to access database');
 
    //$name = mysql_real_escape_string($_GET['name']); 
    $name = mysql_real_escape_string($_SESSION['username'], $db); 
    
    //Here's our query to grab a rank.
    $query = "SELECT  uo.*, 
        (
        SELECT  COUNT(*)
        FROM    Score ui
        WHERE   (ui.score, -ui.ts) >= (uo.score, -uo.ts)
        ) AS `rank`
    FROM    Score uo
    WHERE   name = '$name';";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    
    //This is more elaborate than we need, considering we're only grabbing one rank, but you can modify it if needs be.
    $num_results = mysql_num_rows($result);  
    
    for($i = 0; $i < $num_results; $i++)
    {
         $row = mysql_fetch_array($result);
         echo $row['rank'] . "\n";
    }

?>