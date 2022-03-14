<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity_with_mysql";
$secretKey = "2003";

try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
 
 
$hash = $_GET['hash'];
$realHash = hash('sha256', $_GET['name'] . $_GET['score'] . $secretKey);
	

if($realHash == $hash) 
{ 
	$sth = $conn->prepare('INSERT INTO highscore VALUES ( :username,:highscore)');
	
	try 
	{
		$sth->bindParam(':username', $_GET['name'], 
                  PDO::PARAM_STR);
		$sth->bindParam(':highscore', $_GET['score'], 
                  PDO::PARAM_INT);
		$sth->execute();
	}
	catch(Exception $e) 
	{
		echo '<h1>An error has ocurred.</h1><pre>', 
                 $e->getMessage() ,'</pre>';
	}
}

?>