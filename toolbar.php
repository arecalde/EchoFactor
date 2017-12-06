<?php 
$my_id = $_SESSION['user_id'];
if(loggedin()){
?>
<br />
<ul style='list-style:none;border:1px dashed #8b9dc3'>
	<li>
		<a href='main.php?page=myProfile'>
			My Profile
		</a>

		<a href='eprofile.php'>
			[Edit]
		</a>
	</li>

	<li>
		<a href='main.php?page=gallery'>
			Photos
		</a>
	</li>
	<li>
		<a href='main.php?page=friends'>Friends </a>

		(<?php 
		$frnds = countfrnds($my_id);
		echo $frnds;
		?>)

		<br />
		<a href='main.php?page=req'> Requests</a> (<?php 
		$req = countreq($my_id);
		echo $req;
		?>)
	</li>
	<li>

	<a href='main.php?page=feed'>
		News Feed
	</a>
	</li>

	<li>
	<a href='status.php'>
		Update Status
	</a>
	</li>
	<li>
	<a href='main.php?page=imgPost'>
		Post an image
	</a>
	</li>
	<li>
	<a href='main.php?page=startchat'>
		Start A Chat
	</a>
	</li>

	<li>
	<a href='main.php?page=account'>
		My Account
	</a>
	</li>

	<li>
	<a href='main.php?page=messages'>
		My Messages
	</a>
	</li>
</ul>
<?php }
else {
	?>               
                  <center>
                  <h5 class="login_box">Login To Your Account</h5>
<br />
<form method="post">

<input placeholder="Username" type="text" name= "username" /><br />
<input placeholder="Password" type="password" name="password"><br />
<label>
<input type="checkbox" name="rememberme">Remember Me
</label>
<br />
<input type="submit" value="Login" name='submit'/>
</form>
</center>
<?php
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = sha1($_POST['password']);
$rememberme = $_POST['rememberme'];

if(isset($_POST['submit'])){
if ($username && $password) {	


$query = mysqli_query($connect, "
SELECT *
FROM users 
WHERE username = '$username'
AND password = '".$password."'
") or die(mysql_error());

$row = mysqli_num_rows($query);
	if ($row == 1) {
		$get = mysqli_fetch_assoc($query);
		$user_id = $get['id'];
		$active = $get['active'];
		if ($active == 1){
		$_SESSION['user_id'] = $user_id;
		if($rememberme=="on"){
$hour = time() + 3600;
setcookie('user_id', $user_id, $hour);

//then redirect them to the members area
header("Location:index.php?action=reload");		}
		else if ($rememberme==""){
					$_SESSION['user_id'] = $user_id;

		}
		
		header('location: index.php');

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
	echo "Please fill in ALL fields $username $password";
}	

}
}

?>
