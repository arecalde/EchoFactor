<?php
include 'includes/connect.php'; //link for database
include 'includes/functions.php'; //functions library



$action = $_POST['action']; //see what the user wishes to do
$user = $_POST['user']; //see id of other user
$my_id = $_POST['user_id']; //get id of user

if($action == 'send') {
	mysqli_query($connect, "INSERT INTO frnd_req VALUES(NULL, '$my_id', '$user')"); //send a friend request
  echo "Sent";
}
	
if($action == 'cancel'){
	mysqli_query($connect, "DELETE FROM frnd_req WHERE requester='$my_id' AND accepter='$user'");	 //cancels request by removing from database
  echo "Cancel Request";
}
	
if($action == 'accept'){ //accept a friend request
	mysqli_query($connect, "DELETE FROM frnd_req WHERE requester='$user' AND accepter='$my_id'"); //removes the request from database
	mysqli_query($connect, "INSERT INTO frnds VALUES(NULL, '$user', '$my_id')"); //adds both user ids to the friend database
  echo "Accepted Friend Request";
}
	
	
	if($action == 'unfriend'){ //removing someone as a friend
			mysqli_query($connect, "DELETE FROM frnds WHERE (user_one='$user' AND user_two='$my_id') OR (user_one='$my_id' AND user_two='$user')"); //will remove the 
			//entry from the friend database
    echo "Unfriended";
	}	
	//header('location: main.php?page=profile&user='.$user); //send user back to the place they came from

	
		
		
?>

		
		
	
