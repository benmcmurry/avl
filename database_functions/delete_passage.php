<?
include_once("../connect.php");
$id = $_POST['id'];
$query = "Update Passages set active='0' where id='$id'";
if(!$result = $db->query($query)){
	die('There was an error running the query [' . $db->error . ']');
}   


$result->free(); //free results

$db->close(); //close database
?>