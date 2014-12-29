<?
include_once("../connect.php");

$id = $_POST['id'];
if (isset($_POST['text'])) {
$text = $_POST['text'];

$text= $db->real_escape_string($text);
$query = "Update Passages set passage='$text' where id='$id'";
if($db->query($query) === false) {
  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $db->error, E_USER_ERROR);
}




$db->close(); //close database
}
?>