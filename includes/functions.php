<?php
session_start(); //used for all session related variables
function loggedin() {
	if(isset($_SESSION['user_id']) OR ($_COOKIE['user_id']) ) {
		return true; //if there is a cookie or a session variable, the user is loged in
	}
	else {
		return false;
	}
	
	
	
	
}

function gettablefield($id, $field, $table) {
	
	require 'connect.php'; //needed due to scope

	$check = mysqli_query($connect, "SELECT * FROM $table WHERE id='".$id."'");

	$row = mysqli_fetch_assoc($check);
	
	$username = $row[$field];
	return $username;
	
}

function getimagebyid($id){ //returns img src based on the image id
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM posts WHERE id='".$id."' AND type='1'");

	$row = mysqli_fetch_assoc($check);
	
	$image = $row['content'];
	return $image;
	
}


function getimageid($user_id){ //function not used
	require 'connect.php';
	$check = mysqli_query($connect, "SELECT * FROM images WHERE user='".$user_id."'");
	$row = mysqli_fetch_assoc($check);
	$image = $row['id'];
	return $image;
	
}

function getimagecapbyid($id){ //gets the caption for an image based on the id
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM posts WHERE id='".$id."' AND type='1'");

	$row = mysqli_fetch_assoc($check);
	
	$image = $row['caption'];
	return $image;
}

function countfrnds($id){ //returns the number of friends that a user has
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * 
	FROM frnds
	WHERE user_one =  '$id'
	OR user_two =  '$id'");

	$rows = mysqli_num_rows($check);
	
	return $rows;
	
}
function countreq($id){ //returns the number of requests that a user has
	
	require 'connect.php';
	$check = mysqli_query($connect, "SELECT *
	FROM frnd_req
	WHERE accepter='$id'");
	$rows = mysqli_num_rows($check);
	return $rows;
	
}

function getname($id) { //returns the full name of a user based on id
	
	require 'connect.php';
	$check = mysqli_query($connect, "SELECT * FROM users WHERE id='".$id."'");
	$row = mysqli_fetch_assoc($check);
	
	$fname = $row['firstname'];
	$lname = $row['lastname'];
	$name = $fname." ".$lname;
	return $name;
	
}

function getmonth($mn) { //function not used
	 $monthNum = $mn;
	 $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
	 return $monthName; // Output: May
}

function getfield($id, $field) { //gets a field based on id, and it returns that field
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM users WHERE id='".$id."'");

	$row = mysqli_fetch_assoc($check);
	
	$username = $row[$field];
	return $username;
	
}
function getstatus($id) { //gets most recent status from a user
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM posts WHERE user='".$id."' AND type='0' ORDER BY DESC LIMIT 1");

	$row = mysqli_fetch_assoc($check);
	
	$status = $row['content'];
	return $status;
	
}
function friendcheck($id1, $id2) { //chekcs if two users are friends
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM `frnds` WHERE (user_one='".$id1."' AND user_two = '".$id2."') OR (user_one='".$id2."' AND user_two='".$id1."')");

	$row = mysqli_num_rows($check);

	return ($row == 1);
	
}
function getstatusbyid($id) { //function not used
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM status WHERE id='".$id."'");

	$row = mysqli_fetch_assoc($check);
	
	$status = $row['status'];
	return $status;
	
}
function getmsgbyid($id) { //function not used
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM msgs WHERE id='".$id."'");

	$row = mysqli_fetch_assoc($check);
	
	$msg = $row['message'];
	return $msg;
	
}
function getinfofield($id, $field) { //get a field from the information table instead of the user table
	
	require 'connect.php';

	$check = mysqli_query($connect, "SELECT * FROM info WHERE user='".$id."'");

	$row = mysqli_fetch_assoc($check);
	
	$result = $row[$field];
	return $result;
	
}




function getusername($id) { //returns username of the user from id
	
	require 'connect.php';

	$check2 = mysqli_query($connect, "SELECT * FROM users WHERE id='".$id."'");

	$row2 = mysqli_fetch_assoc($check2);
	
	$username2 = $row2['username'];
	return $username2;
	

}
function genRandomString() //generates a random string of numbers, not my code
{ //helpful in naming things such as images
    $length = 5;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

    $real_string_length = strlen($characters) ;     
    $string="id";

    for ($p = 0; $p < $length; $p++) 
    {
        $string .= $characters[mt_rand(0, $real_string_length-1)];
    }

    return strtolower($string);
}

function emailsearch($email, $field) { //get the field from the main database based on email
	
	
	require 'connect.php';
	
	$sql = "SELECT * from users WHERE email ='".$email."'";
	
	$query = mysqli_query($connect, $sql);
	
	$rows = mysqli_num_rows($query);
	
	$run_mem = mysqli_fetch_assoc($query);

	$result = $run_mem[$field];
	$error = "Nothing Found";
	if($rows == 1){
		return $result;
	}
	else {
		return $error;
	}
	
	
}

function activate($email, $email_code) {
	
	
	require 'connect.php';
	
	$sql = "SELECT * from users WHERE email ='".$email."' AND email_code='".$email_code."' AND active = '0'"; //only run if the user is not active
	
	$query = mysqli_query($connect, $sql);
	
	$rows = mysqli_num_rows($query);
	
	$run_mem = mysqli_fetch_assoc($query);

	$id = $run_mem['id'];
			
	if($rows == 1){
		mysqli_query($connect, "UPDATE users SET active = '1' WHERE id = '".$id."'"); //update the user's active status
		return true;
	}
	else {
		return false;
	}
	
	
}

function fieldexists($field_input, $field) //checks to see if a field exists in users based on the input given
{
	require 'connect.php';
	$query = mysqli_query($connect, "SELECT * FROM users WHERE '".$field."' = '".$field_input."'"); 
	$rows = mysqli_num_rows($query);
	if ($rows == 1){
	   return true;
	}
	else {
	   return false;
	}
}

	


?>
