<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    $host="localhost";
} else {
	$host="127.0.0.1";
}

	$user="benmcmur_avl";
		$password="elcavl";
		$database="benmcmur_avl";
	$db = new mysqli($host, $user, $password, $database);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

// $db->autocommit(FALSE);
?>
