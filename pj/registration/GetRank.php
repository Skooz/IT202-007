<?php
    // https://gamedevelopment.tutsplus.com/tutorials/how-to-code-a-self-hosted-phpsql-leaderboard-for-your-game--gamedev-11627
  
    require('config.php');
    $db = mysql_connect($host, $dbUsername, $dbPassword) or die('Failed to connect: ' . mysql_error()); 
    mysql_select_db($database) or die('Failed to access database');
 
    $name = mysql_real_escape_string($_GET['name']); 
    
    //This is the cleaned up version of our name
    $politestring = sanitize($name);
    
      //Here's our query to grab a rank.
      $query = "SELECT  uo.*, 
          (
          SELECT  COUNT(*)
          FROM    Score ui
          WHERE   (ui.score, -ui.ts) >= (uo.score, -uo.ts)
          ) AS `rank`
      FROM    Score uo
      WHERE   name = '$politestring';";
      $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      
      //This is more elaborate than we need, considering we're only grabbing one rank, but you can modify it if needs be.
      $num_results = mysql_num_rows($result);  
      
      for($i = 0; $i < $num_results; $i++)
      {
           $row = mysql_fetch_array($result);
           echo $row['rank'] . "\n";
      }

/////////////////////////////////////////////////
// string sanitize functionality to avoid
// sql or html injection abuse and bad words
/////////////////////////////////////////////////
function no_naughty($string)
{
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

function my_utf8($string)
{
    return strtr($string,
      "/<>???????????? ??????????????????????????????????????????????",
      "![]YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
}

function safe_typing($string)
{
    return preg_replace("/[^a-zA-Z0-9 \!\@\%\^\&\*\.\*\?\+\[\]\(\)\{\}\^\$\:\;\,\-\_\=]/", "", $string);
}

function sanitize($string)
{
    // make sure it isn't waaaaaaaay too long
    $MAX_LENGTH = 250; // bytes per chat or text message - fixme?
    $string = substr($string, 0, $MAX_LENGTH);
    $string = no_naughty($string);
    // breaks apos and quot: // $string = htmlentities($string,ENT_QUOTES);
    // useless since the above gets rid of quotes...
    //$string = str_replace("'","&rsquo;",$string);
    //$string = str_replace("\"","&rdquo;",$string);
    //$string = str_replace('#','&pound;',$string); // special case
    $string = my_utf8($string);
    $string = safe_typing($string);
    return trim($string);
}


?>