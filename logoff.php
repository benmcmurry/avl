<?
	session_start();
	session_destroy();
	echo "logged off";
	echo  "<meta HTTP-EQUIV='REFRESH' content='0; url=index.php'>";
	?>