<?
	include_once('connect.php');
	
	
	?>
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
	<title></title>
	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<link href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery.js">
	</script>
	<script type="text/javascript" src="js/jquery-ui.js">
	</script>
	<script type="text/javascript" src="js/jquery.dataTables.js">
		
	</script>
	<script>
$(document).ready(function(){
	
    $('#words').dataTable({
	    aLengthMenu: [
        [ -1],
        ["All"]
    ],
    });
});
</script>
<style>
	body {
		background-color:grey;
	}
	td {
		text-align: center;
		width: 40px;
	}
	
	td.word {
		text-align:left;
	}
	#content {
		width: 1200px;
		background-color: white;
		margin-left: auto;
		margin-right:auto;
		padding:25px;
		
	}
</style>
</head>
<body>
<div id="content">
	<table id="words" >
		<thead>
			<th>Word</th>
			<th>PoS</th>
			<th>AVL</th>
			<th>Business</th>
			<th>History</th>
			<th>Humanities</th>
			<th>Law</th>
			<th>Medicine</th>
			<th>Philosophy</th>
			<th>Science</th>
			<th>Sociology</th>
		</thead>
		<?
			$query = "Select * from AVL"; //search for the word against the AVL
			if(!$result = $db->query($query)){
							die('There was an error running the query [' . $db->error . ']');
						}   
			while($row = $result->fetch_assoc()){
   		        
			    echo "<tr>";
			    echo "<td class='word'>".$row['word']."</td>";
			    echo "<td>".$row['pos']."</td>";
			    echo "<td>".$row['id']."</td>";
			    echo "<td>".$row['bus']."</td>";
			    echo "<td>".$row['his']."</td>";
			    echo "<td>".$row['hum']."</td>";
			    echo "<td>".$row['law']."</td>";
			    echo "<td>".$row['med']."</td>";
			    echo "<td>".$row['phil']."</td>";
			    echo "<td>".$row['sci']."</td>";
			    echo "<td>".$row['soc']."</td>";
			    
			    
			    
				
			
			    echo "</tr>";
			
			}	
$result->free(); //free results

$db->close(); //close database?>
	</table>
</div>
</body>
</html>