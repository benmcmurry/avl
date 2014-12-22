<?php
include_once("connect.php");

$id= $_GET['id'];
if ($id !== "0") {

$query = "Select * from Passages where id='$id'";
if(!$result = $db->query($query)){
	die('There was an error running the query [' . $db->error . ']');
}   

while($row = $result->fetch_assoc()){
    $passage = $row['passage'];
}


$regular_word_count =  substr_count($passage, 'class="word"'); 
$possible_avl_count =  substr_count($passage, 'class="possible_avl"');
$avl =  substr_count($passage, 'class="avl"');
$total_words = $regular_word_count+$possible_avl_count+$avl;
?>
<h2>Statistics</h2>
<?
echo "Total Words: ".$total_words."<br />";
echo "Possible AVL: ".$possible_avl_count."<br />";
echo "AVL: ".$avl."<br />";

$formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
$avl_percentage = $formatter->format($avl/$total_words);
echo "AVL Percentage: ".$avl_percentage;
}
?>