<h6 class='ti'> Contact Us</h6>
  <br />
			<p>
			<form method='post'>
			<input type='text' name='email' placeholder='Email' style='width:100%'/>
			<input type='text' name='subject' placeholder='subject' style='width:100%'/>
			<textarea name='content'style='width:100%' placeholder='Message'></textarea>
			<input type='submit' name='send' value='Send' />

			</form>
			</p>
			  <br />

			
<?php


	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$content = $_POST['content']."\n\n\n From Contact Me Social Media"; //indicate to me what the issue is 
	$headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n" .'X-Mailer: PHP/' . phpversion();
	if (isset($_POST['send'])) {
		if($email AND $subject AND $content) { //prevent spam 
			if(mail('me@alexrecalde.com', $subject, $content, $headers)){
				echo "Success"; //if the mail is sent, then tell the user it works well
			}
			else {
				echo "Failed";
			}
		}
		else {
			echo "Fill it in"; 
		}
	}
	include 'includes/footer.php';

?>


