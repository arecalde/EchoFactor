<br />
		<div id="input">
			<div id="feedback"></div>
			<?php
			if(!loggedin()){
				header('location: index.php'); //only logged in users should see this
			} 
			$my_id = $_SESSION['user_id'];
			$datetime = date('Y-m-d H:i:s'); 
			$username = getfield($my_id, 'username');
			$room = $_GET['room']; //see what chat the user is in
			if (!$room){
				$room = 0; //if there is no room, then enter the global chat room of 0
			}

			if(isset($_POST['send'])){ //user submits a msg for the chat
				$msg = mysqli_real_escape_string($connect, $_POST['message']);
				$sql = "INSERT INTO `chat` ( `id` , `sender` , `message` , `chatroom` , `datetime` ) VALUES ( '', '".$my_id."', '".$msg."', '".$room."', '".$datetime."' )";
				if($msg){ //only run if the message box is filled, prevents spam
					if($run = mysqli_query($connect, $sql)){ //insert message into database
						echo "Sent!";
					}
					else {
						echo "Error 500:50";
					}
				}
				else {
					echo "Fill It In";
				}
			}
			?>
			<form action="#" method="post" id="form_input">
				<br /><br /><input id = 'test_input' name="message" style="width: 100%;" placeholder='Enter Message' /><br />
				<input type="submit" name="send" id="send" value="Send Message"/>
			</form>
			<!-- Box for users to type messages -->
		</div>

	
		<div id="messages" style="overflow:auto; height:70%; border:1px solid #3b5998; margin:0px 0px">
			<!-- This is the div that the messages will be loaded into -->
		</div>
		
		<!-- Javascript -->
		<script type="text/javascript" src="scripts/js/jquery-1.7.2.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {
					var interval = setInterval(function() {
						$.ajax({
							url: 'includes/Chat.php?room=<?php echo $room;?>', //the page will load all of the comments from this room
							success: function(data) {
								$('#messages').html(data); //this loads the messages into the div
							}
						});
					}, 500); //setting the interval forces it to 
				});
		</script>		

		<?php
  			include('includes/footer.php');
  		?>
