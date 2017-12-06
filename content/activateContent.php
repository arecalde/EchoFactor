<h5 class='ti'>Activate Your Account!</h5>

<?php
	$email = $_GET['email'];
	$email_code = $_GET['code'];

	if(isset($email) and isset($email_code)) {
		if(fieldexists($email, 'email')){ //make sure email is in system
		
			if(!activate($email, $email_code)){ //activate function updates the active field to 1
				echo "Sorry we had issues activating your account"; //tell the user that I couldn't activate their account
			}
			else {
				$id = emailsearch($email, 'id'); //get the id based on email
				$sql =  "INSERT INTO info (id, user) VALUES ('', '".$id."') "; //insert a new row into the information table
				if($query = mysqli_query($connect, $sql)){ 
					echo "Account successfully activated"; //everything went well
				}
				else {
					echo "Your account was successfully activated but there were issues, please contact supporrt 500:22"; //account activated but the info row was not inserted
				}
			}

			}
	
		else {
			echo "Email Address Not On File"; //email address not found in system
		}
	}
	else{
		header('location: index.php'); //redirect the user if they are here on accident
	}

?>
