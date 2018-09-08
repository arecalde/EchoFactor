<?php
	require('functions.php');
	require('connect.php');
	
	$room = $_GET['room'];

	$query = "SELECT * FROM  `chat` WHERE  `chatroom` =  '".$room."' ORDER BY datetime DESC"; //sql to get all messages from the server
	
	$run = mysqli_query($connect, $query);
	
	while($messages = mysqli_fetch_assoc($run)) {
		 $id= $messages['sender'];
		 $sender = getfield($id, 'username');
		 $message = $messages['message'];
		echo '<strong>Sender: '.$sender.'</strong><br />';
		echo $message.'<br /><br />';
	}
	

?>
