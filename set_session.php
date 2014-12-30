<?
session_start();
$_SESSION['user_id'] = $_POST['user_id'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['image'] = $_POST['image'];
$_SESSION['profile'] = $_POST['profile'];
$ref = $_POST['ref'];

echo  "<meta HTTP-EQUIV='REFRESH' content='0; url=$ref'>";
echo "<a href='$ref'>Return to App</a>";
?>
