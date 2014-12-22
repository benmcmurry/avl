<?
include_once('../connect.php');

$word = $_POST['word'];

$query = "Select * from AVL where word='$word'";

if(!$result = $db->query($query)){
	die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()){
    echo "<div class='pos ".$row['pos']."'>".$row['word'].".".$row['pos']."</div>";
}   
?>
<div class='pos none' id='none'>none</div>