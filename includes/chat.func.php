<?php

	function get_msg() {
			require('../database/connect.db.php');

		$query = "SELECT `Sender`, `Message` FROM `chat`.`chat` ORDER BY `Msg_ID` DESC";
		
		$run = mysqli_query($connect, $query);
		
		$messages = array();
		
		while($messages = mysqli_fetch_assoc($run)) {
			$message = $messages['Sender'];
			$sender = $messages['Message'];



		}
		
		
		
	}
	
	function send_msg($sender, $message) {
	require('../database/connect.db.php');

		if(!empty($sender) && !empty($message)) {
			
			$sender 	= mysqli_real_escape_string($connect, $sender);
			$message 	= mysqli_real_escape_string($connect, $message);
			
			$query = "INSERT INTO `chat`.`chat` VALUES (null, '{$sender}', '$message')";
			
			if($run = mysqli_query($connect, $query)) {
				return true;
			} else {
				return false;
			}
			
		} else {
			return false;
		}
	}

?>
