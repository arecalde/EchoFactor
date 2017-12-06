<h6 class='ti'> Invite Your Friends!</h6>
<p>Our developers worked hard to put together our little site, if you think it is worth mentioning to a few friends, why not do it?</p>


<form method="post">
			<input type='text' name='email' placeholder="Your friend's email"/> <br />
			<textarea rows="5" cols="80" placeholder="What do you want to say to them?" name="message"></textarea> <br /><!--Creates a large text field for message -->
			<input type='submit' name='submit' value='Send!' />
</form>
			
			
<?php
	  
	$email = $_POST['email']; //their friends email
	$message = $_POST['message']; //the message they typed
	$username = getfield($my_id, 'username'); //get the username of the person so the reciever knows who sent the email
	if(isset($_POST['submit']))
	{
		if ($email AND $message) { //try and prevent spam	

			$subject = "$username is inviting you to our site";
			$mailheader = "From: $username";
			$formcontent = "
			Dear Soon To Be EchoFactor, 
			\n
			$username is inviting you to our site!

			\n
			--------
			\n
			$message
			\n
			--------
			\n
			We are are a new site that is constantly adding content, features and more. If you want to be part of the new social network please join

			\n
			<a href='http://echofactor.com/register.php'>http://echofactor.com/register.php</a>
			"; //the message that will be sent to the user
			mail($email, $subject, $formcontent, $mailheader) or die("Error!");
			echo "Email successfully sent";
		}
		else{
			echo "Please type an email and a message";
		}

	}

?>
	<?php
include 'includes/footer.php';

?>
