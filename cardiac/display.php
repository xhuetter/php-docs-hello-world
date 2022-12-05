<?php

$hostname = 'cardiacdb.mysql.database.azure.com';
$username = 'UCFCARDIAC';
$password = 'SDProj2023';
$database = 'cardiacvr';

try
{
	$dbh = new PDO('mysql:host='. $hostname .';dbname='. $database,
         $username, $password);
}
catch(PDOException $e)
{
	echo '<h1>An error has occurred.</h1><pre>', $e->getMessage()
            ,'</pre>';
}

$sth = $dbh->query('SELECT * FROM students');
$sth->setFetchMode(PDO::FETCH_ASSOC);

$result = $sth->fetchAll();

if (count($result) > 0)
{
	foreach($result as $r)
	{
		echo $r['SID'], "\n _";
		echo $r['StudentName'], "\n _";
	}
}

?>
