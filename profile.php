<?php
//handled by main, but the program has many refrences to profile
	include 'includer.php';

	if(!loggedin()){
		header('location: index.php'); //only logged on users should see this
	}else{
		if(isset($_GET['user']) && !empty($_GET['user'])){
			$user = $_GET['user']; //get id of person being viewed
			header('location: main.php?page=profile&user='.$user); //redirect to main and have main handle the request
		}
		else {
			header('location: main.php?page=myProfile'); //if profile is empty, redirect to my profile
		}
	}
?>

