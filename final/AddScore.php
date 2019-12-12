<?php 
    // Reference: https://gamedevelopment.tutsplus.com/tutorials/how-to-code-a-self-hosted-phpsql-leaderboard-for-your-game--gamedev-11627
    
    // This file handles adding the score to the database, pairing it with the logged in user.
    
    session_start(); 

    require('config.php');
    $db = mysql_connect($host, $dbUsername, $dbPassword) or die('Failed to connect: ' . mysql_error()); 
    mysql_select_db($database) or die('Failed to access database');

    // These are our variables.    
    $name = mysql_real_escape_string($_SESSION['username'], $db); 
    $score = mysql_real_escape_string($_GET['score'], $db); 
    $hash = $_GET['hash']; 
    
    // Secret key for additional hashing protection.
    $secretKey="j9ukxS6l4c";
    
    // Check the hash from Unity to see if it checks out.
    $expected_hash = md5($score . $secretKey); 
    
    //If what we expect is what we have:
    if($expected_hash == $hash) { 
        // Insert/update scores!
        $query = "INSERT INTO Score
        SET name = '$name'
           , score = '$score'
           , ts = CURRENT_TIMESTAMP
        ON DUPLICATE KEY UPDATE
           ts = if('$score'>score,CURRENT_TIMESTAMP,ts), score = if ('$score'>score, '$score', score);"; 
        //And finally we send our query.
        $result = mysql_query($query) or die('Query failed: ' . mysql_error()); 
    } 
    
?>