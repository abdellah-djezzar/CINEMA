<?php
function connect_db() 
{
	$connect_bdd = null;
	try /*Dans la fonction on va verifier si la base existe*/
	{
		$connect_bdd = new PDO('mysql: host=localhost;dbname=cinema', 'abdellah', 'abdellah');
	}
	catch (Exception $test)
	{
		die('Erreur : ' . $test->getMessage());
	}
	return $connect_bdd;
}
?>