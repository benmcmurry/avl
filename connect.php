<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

	$user="benmcmur_avl";
		$host="localhost";
		$password="elcavl";
		$database="benmcmur_avl";
	$db = new mysqli($host, $user, $password, $database);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

// $db->autocommit(FALSE);
?>
