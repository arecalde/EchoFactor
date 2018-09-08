
<?php 		
	$code = md5($myusername + $my_id + microtime()); //random unique code generated for room
?>


<h6 class='ti'> Invite Your Friends To A PRIVATE Chat!</h6>
<p>Choose some of your friends to add to the private chat, they will be messaged a unique link to the room</p>
<br />
<p>Link to the room is: <a href='chat.php?room=<?php echo $code;?>'>http://echofactor.com/chat.php?room=<?php echo $code;?></a>
<form method='post'>

<?php
$friends_query = mysqli_query($connect, "SELECT user_one, user_two FROM frnds WHERE (user_one='$my_id') OR (user_two='$my_id')"); //select friends from database
$row = mysqli_num_rows($friends_query);
if ($row != 0) { //if the user has friends then show them here
while($run_frnd = mysqli_fetch_assoc($friends_query)) {
		$user_one = $run_frnd['user_one'];
		$user_two = $run_frnd['user_two'];
		
		 if($user_one == $my_id){ //select the correct id
			$user = $user_two;
			}
		else{
			$user = $user_one;
			}
		$fname = getfield($user, 'firstname');
		$lname = getfield($user, 'lastname');
		$username = getfield($user, 'username');
		$myusername = getfield($my_id, 'username');
		echo "<label><input type='checkbox' name='friend[]' value='$user'> $fname $lname/$username<br></label>&nbsp;&nbsp;";
}	
?>
	<br />
	<input type='submit' name='chat'>
</form>
<?php
	}
?>
<?php
if(isset($_POST['chat'])){

 foreach($_POST['friend'] as $check) {


		$user_id = $check;
		$datetime = date('Y-m-d H:i:s');
		$sql = "INSERT INTO `newEcho`.`msgs` (`id`, `sender`, `reciever`, `message`, `datetime`) VALUES (NULL, '$my_id', '$check', '"."$myusername is inviting you to a <a href=\'main.php?page=chat&room=$code\'>private chat, click to join</a>"."', '1');"; //insert messages into database, use escape characters to prevent error
		if(mysqli_query($connect, $sql)){
			echo "Message sent to ".getname($check)."<br />"; //tell the user that they succesfully sent the message
		}else{
			echo "Error 500:57<br />";
		}
    }

}
?>


<?php
	include 'includes/footer.php';

?>

