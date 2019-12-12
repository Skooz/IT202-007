<?php
    // Reference: https://gamedevelopment.tutsplus.com/tutorials/how-to-code-a-self-hosted-phpsql-leaderboard-for-your-game--gamedev-11627

    // This file will sort through the scores so they can be displayed in-game.
    
    session_start(); 

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
         echo $row['name'] . "\t" . $row['score'] . "\n"; // And output them
    }
?>