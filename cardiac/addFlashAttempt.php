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
$realHash = hash('sha256', $_GET['SID'] . $_GET['FID'] . $_GET['Grade'] .
                      $_GET['TimeTaken'] . $_GET['Confidence'] . $secretKey);

if($realHash == $hash)
{
	$sth = $dbh->prepare('INSERT INTO students VALUES (:id, :name
            , :section, :year )');
	try
	{
		$sth->bindParam(':SID', $_GET['SID'],
                  PDO::PARAM_INT);
		$sth->bindParam(':FID', $_GET['FID'],
                  PDO::PARAM_STR);
    $sth->bindParam(':Grade', $_GET['Grade'],
                  PDO::PARAM_STR);
    $sth->bindParam(':TimeTaken', $_GET['TimeTaken'],
                  PDO::PARAM_STR);
		$sth->bindParam(':Confidence', $_GET['Confidence'],
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
