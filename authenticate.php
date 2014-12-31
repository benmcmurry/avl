<?php

error_reporting(E_ALL);
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['user_id']))
{ 
    //Destroy anything they have in their old session.
    session_destroy();
    //If they do not have an active session we redirect them to the login page
    session_start();
    $_SESSION['ref'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    echo  "<meta HTTP-EQUIV='REFRESH' content='0; url=login.php'>";
    //Kill current page since the user needs to login first
    exit();
}
?>