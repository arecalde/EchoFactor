<h5 class='ti'>Activate Your Account!</h5>

<?php
$email = $_GET['email'];
$email_code = $_GET['code'];

if(isset($email) and isset($email_code)) {
	if(fieldexists($email, 'email')){
		
		if(!activate($email, $email_code)){
			echo "Sorry we had issues activating your account";
			
		}
		else {
			$id = emailsearch($email, 'id');
			$sql =  "INSERT INTO info (id, user) VALUES ('', '".$id."') ";
			if($query = mysqli_query($connect, $sql)){
				echo "Account successfully activated";
			}
			else {
				echo "Your account was successfully activated but there were issues, please contact supporrt 500:22";
			}
		}

		}
	
	else {
		echo "Email Address Not On File";
	}
}else{
	header('location: index.php');
}

?>
