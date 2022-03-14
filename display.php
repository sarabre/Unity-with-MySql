<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity_with_mysql";

try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
 
$sth = $conn->query('SELECT * FROM highscore ORDER BY highscore DESC LIMIT 5');
$sth->setFetchMode(PDO::FETCH_ASSOC);
 
$result = $sth->fetchAll();
 
if (count($result) > 0) 
{
	foreach($result as $r) 
	{
		echo $r['username'], "\n _";
		echo $r['highscore'], "\n _";
	}
}

?>