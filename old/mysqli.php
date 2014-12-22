<?
	$user="benmcmur_avl";
		$host="localhost";
		$password="elcavl";
		$database="benmcmur_avl";
	$db = new mysqli($host, $user, $password, $database);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = <<<SQL
    SELECT *
    FROM AVL 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()){
    echo $row['word'] . '<br />';
}

$result->free(); //free results

$db->close(); //close database
?>