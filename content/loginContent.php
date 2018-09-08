<center>
<h5 class="login_box">Login To Your Account</h5>
<br />
<form method="post">
	<input placeholder="Username" type="text" name= "username" /><br />
	<input placeholder="Password" type="password" name="password"><br />
	<label>
	<input type="checkbox" name="rememberme">Remember Me</label> <!-- Remember me box is for cookies-->
	<br />
	<input type="submit" value="Login" name='submit' /> or <a href='register.php'>Register</a>
</form>

<?php
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = sha1($_POST['password']); //no need to check for sql injection b/c it is hashed
$rememberme = $_POST['rememberme'];

if(isset($_POST['submit'])){
	if ($username && $password) {	

	$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$query = mysqli_query($connect, $sql);

	$row = mysqli_num_rows($query);
		if ($row == 1) { //if username and password were found, then this should run
			$get = mysqli_fetch_assoc($query);
			$user_id = $get['id'];
			$active = $get['active'];
			if ($active == 1){ //make sure user has activated account
				$_SESSION['user_id'] = $user_id;
				if($rememberme=="on"){ //if the user wants to be remembered set a cookie
					$hour = time() + 3600; //set the cookie for an hour
					setcookie('user_id', $user_id, $hour); //set the cookie



				}
				else if ($rememberme==""){
					$_SESSION['user_id'] = $user_id; //if not remember me, just set a regular session variable
				}
				header('location: index.php'); //redirect to login
			}
			else {
				echo "Account Needs To Be Activated";
			}

		}
		else {
				echo "Username or Password Incorrect";
		}
	}
	else {
		echo "Please fill in ALL fields";
	}	

}

?>
</center>
