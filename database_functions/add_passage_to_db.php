<?
include_once('../connect.php');


$title = strip_tags($_POST['title']);
$user_text = $_POST['user_text'];
$possible_paragraph_end_markers = array("</div>", "</p>", "<br>", "<br />", "\n", "\r");
$user_text = str_replace($possible_paragraph_end_markers, "\n\n", $user_text);


$user_text = "<span>".strip_tags($user_text)."</span>";
// $user_text = "<span class='word'>".$db->real_escape_string($user_text)."<br><div>")."</span>";

$user_text = str_replace("'","&#39", $user_text);
$punctuations = array(" ", ".","'s","!","?",":",";",",","–","\"");

foreach ($punctuations as $punctuation) {
	$user_text = str_replace($punctuation, "</span>|<span class='punctuation'>$punctuation</span>|<span class='word'>", $user_text);
}
$pattern = array ("/<span[^>]*><\\/span[^>]*>/"); 
$user_text = preg_replace($pattern, '', $user_text);
$words = explode("|", $user_text);



foreach ($words as $key=> $word) { //parse through the words
	$word_clean = strip_tags($word);
	$query = "Select * from AVL where word='$word_clean'"; //search for the word against the AVL
	/* $run = mysql_query($query) or die(mysql_error()); */ //run query
 
if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
}   
    
    if($result->num_rows > 0) {; //number of repeats
    	while ($results = $result->fetch_assoc()) {
				$words[$key] = "<span class='possible_avl'>".$word_clean."</span>";
			}
    }
    
} //end for each



$analyzed_text = "";

foreach ($words as $word) {
	$analyzed_text = $analyzed_text.$word;
}
$analyzed_text = $db->real_escape_string($analyzed_text);
$query = "Insert into Passages (title, passage, active) Values ('$title', '$analyzed_text', '1')";
// $run = mysql_query($query) or die(mysql_error());

if($db->query($query) === false) {
  trigger_error('Wrong SQL: ' . $query . ' Error: ' . $db->error, E_USER_ERROR);
}



echo $db->insert_id;




$result->free(); //free results

$db->close(); //close database

?>