<?php
include 'includes/functions.php'; //required for session_start

session_destroy(); //destroys session

setcookie('user_id','', time()-3600); //essentially destroys cookie by setting expiration time to an hour ago

header('location: index.php'); //redirects user to main page
?>
