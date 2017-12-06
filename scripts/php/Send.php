<?php
	require('../../../functions.php');

	require('../../includes/database/connect.db.php');
	require('../../includes/functions/chat.func.php');
	
	if(1 == 1) {
		$sender = "1";
		
		if(isset($_GET['message'])&&!empty($_GET['message'])) {
			$message = $_GET['message'];
			$datetime = date('Y-m-d H:i:s');
					$my_id = $_SESSION['user_id'];

$room = 0;
			$query = "INSERT INTO  `chat` 
VALUES (
NULL ,  '$my_id',  '$message',  '$room',  '$datetime'
)";
			
			if($run = mysqli_query($connect, $query)) {
				echo 'Message Sent';
			} else {
				echo 'Message wasn\'t sent';
			}
			
	
			

			
		} else {
			echo 'No Message was entered';
		}
		
	} else {
		echo 'No Name was entered.';
	}
	
?>