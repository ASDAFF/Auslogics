<?php
try{
	$db = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
			
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$db->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
} catch (PDOException $e) {
	exit('Error!: ' . $e->getMessage() . '<br>');
}
?>