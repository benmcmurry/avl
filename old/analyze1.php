<?
$user_text = $_GET['user_text'];

$punctuations = array(" ", ".","'s","!","?",":",";",",");
$sanitized_user_text = str_replace($punctuations, " ", $user_text);
$words = explode(" ", $sanitized_user_text);
include_once('connect.php');
$link=connect(); //call function from external file to connect to database	
?>
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
	<title></title>
	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta name="robots" content="" />

<script type="text/javascript" src="js/jquery.js">
</script>
<script type="text/javascript" src="js/jquery-ui.js">
</script>
<script type="text/javascript" src="js/js.js">
</script></head>
<body>
<?
$word_count = array();

foreach ($words as $key=> $word) { //parse through the words
	$query = "Select * from AVL where word='$word'"; //search for the word against the AVL
	$run = mysql_query($query) or die(mysql_error()); //run query
    if(mysql_num_rows($run) == 1) {; //number of repeats
    	while ($results = mysql_fetch_assoc($run)) {
				$word = $results['word']." (".$results['pos'].")";
				if(array_key_exists($word, $word_count)) {$word_count[$word]++;}
				else {$word_count[$word]=0;$word_count[$word]++;}
			}
    }
    if(mysql_num_rows($run) > 1) {
    	while ($results = mysql_fetch_assoc($run)) {
			$word_pos = $results['word']." (".$results['pos'].")";
			$context = $words[$key-3]." ".$words[$key-2]." ".$words[$key-1]." ".$words[$key]." ".$words[$key+1]." ".$words[$key+2]." ".$words[$key+3];
			?>
		    	<!--
<script type="text/javascript">
				var process = confirm("Is <? echo $word." a ".$results['pos']."?";?>\n<? echo $context; ?>");
				</script>
-->
			<?
			if(array_key_exists($word_pos, $word_count)) {$word_count[$word_pos]++;}
			else {$word_count[$word_pos]=0;$word_count[$word_pos]++;}
		}
				
	    
    }
    
} //end for each


arsort($word_count);
foreach ($word_count as $key => $value) {
	echo "$value $key<br />";
}

?>
</body>
</html>