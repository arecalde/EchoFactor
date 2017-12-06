<?php
include 'includes/connect.php'; //link for database
include 'includes/functions.php'; //functions library



$action = $_GET['action']; //see what the user wishes to do
$user = $_GET['user']; //see id of other user
$my_id = $_SESSION['user_id']; //get id of user

if($action == 'send') {
	mysqli_query($connect, "INSERT INTO frnd_req VALUES('', '$my_id', '$user')"); //send a friend request
}
	
if($action == 'cancel'){
	mysqli_query($connect, "DELETE FROM frnd_req WHERE requester='$my_id' AND accepter='$user'");	 //cancels request by removing from database
}
	
if($action == 'accept'){ //accept a friend request
	mysqli_query($connect, "DELETE FROM frnd_req WHERE requester='$user' AND accepter='$my_id'"); //removes the request from database
	mysqli_query($connect, "INSERT INTO frnds VALUES('', '$user', '$my_id')"); //adds both user ids to the friend database
}
	
	
	if($action == 'unfriend'){ //removing someone as a friend
			mysqli_query($connect, "DELETE FROM frnds WHERE (user_one='$user' AND user_two='$my_id') OR (user_one='$my_id' AND user_two='$user')"); //will remove the 
			//entry from the friend database
	}	
	header('location: main.php?page=profile&user='.$user); //send user back to the place they came from

	
		
		
?>

		
		
	
