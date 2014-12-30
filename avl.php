<?
include_once("connect.php");
include_once("authenticate.php");
$user_id = $_SESSION['user_id'];

if(isset($_GET['id']))
{
     $id = $_GET['id'];
 } else {$id=0;}

?>


<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
	<title>Academic Vocabulary Word List Manual Tagger</title>
	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script src="https://apis.google.com/js/client:platform.js" async defer></script>

	<script type="text/javascript" src="js/jquery.js">
	</script>
	<script type="text/javascript" src="js/jquery-ui.js">
	</script>
	<script type="text/javascript" src="js/js.js">
	</script>
	<script>
		var id="<? echo $id; ?>";
	</script>
</head>
<body>
<div id="wrapper">
<header id="header">
	<h1>AVLMaT</h1>
	<div id="login">
		<div id="column1">
			<div id="name"><? echo $_SESSION['name']; ?></div>
			<div id="signOut" class="button">Sign Out</div>
		</div>
		<div id="image"><img src="<? echo $_SESSION['image']; ?>" /></div>
	</div>
</header>

<aside id="passages">
	<div class="button" id="new_folder">Add Folder</div>
	<div class="button" id="new_passage">Add Passage</div>
	<div id="passage_list">
		<?
			$query = "Select * from Passages where active=1 and owner='$user_id' order by title ASC ";
			if(!$result = $db->query($query)){
				die('There was an error running the query [' . $db->error . ']');
			} 
			while($row = $result->fetch_assoc()){
				echo "<a class='passages' href='avl.php?id=".$row['id']."'>".$row['title']."</a>";
			}  
			$result->free(); //free results
		?>	
		
	</div>
</aside>
<div id="content">
	
	<?
		$query = "Select * from Passages where id='$id'";
		if(!$result = $db->query($query)){
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while($row = $result->fetch_assoc()){
			echo "<h1 id='title'>".$row['title']."</h1>";
		echo "<div id='passage'>".$row['passage']."</div>";
    
}
?>
</div>

<div id="data">
	<div class='button' id='edit_passage'>Edit Passage</div><div class='button' id='delete_passage'>Delete Passage</div>
	<div id="stats">
	<?
		/* include("http://benmcmurry.com/avl/stats.php?id=$id") */;
	?>
	</div>
</div>
<footer> </footer>
</div>

<div id="popup">
	<div id="popup_arrow"></div>
	<div id="popup_content"></div>
</div>
<div id="pos_popup">
	<div id="pos_popup_arrow"></div>
	<div id="pos_popup_content"></div>
</div>
<div id="faded_background"></div>
</body>
</html>