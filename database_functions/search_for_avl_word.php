<?
include_once('../connect.php');

$word = $_POST['word'];
$part_of_speech = $_POST['part_of_speech'];


$query = "Select * from AVL where word='$word' and pos='$part_of_speech'";

if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
}

if ($result->num_rows > 0) {echo "true";} else {echo "false";}

?>