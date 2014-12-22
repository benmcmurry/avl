<?
include_once('connect.php');
$link=connect(); //call function from external file to connect to database	


$user_text = "<span>".strip_tags($_POST['user_text'],"<br><div>")."</span>";
$user_text = str_replace("'","&#39", $user_text);
$punctuations = array(" ", ".","'s","!","?",":",";",",");

foreach ($punctuations as $punctuation) {
	$user_text = str_replace($punctuation, "</span>|<span>$punctuation</span>|<span>", $user_text);
}

$words = explode("|", $user_text);



foreach ($words as $key=> $word) { //parse through the words
	$word_clean = strip_tags($word);
	$query = "Select * from AVL where word='$word_clean'"; //search for the word against the AVL
	$run = mysql_query($query) or die(mysql_error()); //run query
    if(mysql_num_rows($run) > 0) {; //number of repeats
    	while ($results = mysql_fetch_assoc($run)) {
				$words[$key] = "<span class='possible_avl'>".$word_clean."</span>";
			}
    }
    
} //end for each





foreach ($words as $word) {
	echo $word;
}

?>