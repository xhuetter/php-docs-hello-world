<?php

$hostname = 'cardiacdb.mysql.database.azure.com';
$username = 'UCFCARDIAC';
$password = 'SDProject2023';
$database = 'cardiacvr';
$secretKey = "mySecretKey";

try
{
	$dbh = new PDO('mysql:host='. $hostname .';dbname='. $database,
           $username, $password);
}
catch(PDOException $e)
{
	echo '<h1>An error has ocurred.</h1><pre>', $e->getMessage()
            ,'</pre>';
}

$hash = $_GET['hash'];
$realHash = hash('sha256', $_GET['id'] . $_GET['name'] . $_GET['section'] .
                      $_GET['year'] . $secretKey);

if($realHash == $hash)
{
	$sth = $dbh->prepare('INSERT INTO students VALUES (:id, :name
            , :section, :year )');
	try
	{
		$sth->bindParam(':id', $_GET['id'],
                  PDO::PARAM_INT);
		$sth->bindParam(':name', $_GET['name'],
                  PDO::PARAM_STR);
    $sth->bindParam(':section', $_GET['section'],
                  PDO::PARAM_STR);
    $sth->bindParam(':year', $_GET['year'],
                  PDO::PARAM_STR);
  	$sth->execute();
	}
	catch(Exception $e)
	{
		echo '<h1>An error has ocurred.</h1><pre>',
                 $e->getMessage() ,'</pre>';
	}
}

?>
