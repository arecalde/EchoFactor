		<form method="post">

			<input placeholder="First Name" type="text" name= "firstname" />
			<input placeholder="Last Name" type="text" name= "lastname" >

			<input type="submit" value="Change" name='name'/>
		</form>
		<?php
			$fname = mysqli_real_escape_string($connect, $_POST['firstname']); //prevent sql injection
			$lname = mysqli_real_escape_string($connect, $_POST['lastname']); // same
	
			if(isset($_POST['name'])){
				if($fname && $lname){
					if($query = mysqli_query($connect, "UPDATE users SET firstname='".$fname."', lastname='".$lname."' WHERE id='".$user."'")){ //update in database
						echo "Updated";
					}
					else {
						echo "Query Failed Error 500:50";
					}
				}
				else{
					echo "Sorry Fill It In First";
				}
			}
		?>



	<form method="post">

	<input placeholder="School" type="text" name= "school" />
	<input type="submit" value="Change" name='schools'/>

	</form>
	<?php
		$school = mysqli_real_escape_string($connect, $_POST['school']); //prevent sql injection
		if(isset($_POST['schools'])){
			if($school){
				if($query = mysqli_query($connect, "UPDATE info SET school='".$school."' WHERE user='".$user."'")){ //update in database
					echo "Updated";
				}
				else {
						echo "Query Failed Error 500:77";
				}
			}
			else{
				echo "Sorry Fill It In First";
			}
		}
	?>


	<form method="post">
		<input placeholder="Residence" type="text" name= "residence" />
		<input type="submit" value="Change" name='town'/>
	</form>
	<?php
		$town = mysqli_real_escape_string($connect, $_POST['residence']);
		if(isset($_POST['town'])){
			if($town){
				if($query = mysqli_query($connect, "UPDATE info SET town='".$town."' WHERE user='".$user."'")){	
					echo "Updated";
				}
				else {
					echo "Error 500:96";
				}
			}
			else{
				echo "Sorry Fill It In First";
			}
		}
	?>



	<form method="post" action="eprofile.php">
		<input placeholder="Hometown" type="text" name= "hometown" />
		<input type="submit" value="Change" name='hts' />
	</form>
	<?php
		$hometown = mysqli_real_escape_string($connect, $_POST['hometown']);
		if(isset($_POST['hts'])){
			if($hometown){
				if($query = mysqli_query($connect, "UPDATE info SET hometown='".$hometown."' WHERE user='".$user."'")){
						echo "Updated";
					}
					else {
						echo "Error 500:116";
					}
			}
			else{
				echo "Sorry Fill It In First";
			}
		}
		?>



	<form method="post" action="eprofile.php">

	<input placeholder="Looking For" type="text" name= "lookingfor" />
	<input type="submit" value="Change" name='lfs'/>

	</form>
	<?php
		$lookfor = mysqli_real_escape_string($connect, $_POST['lookingfor']);
		if(isset($_POST['lfs'])){


			if($lookfor){
				if($query = mysqli_query($connect, "UPDATE info SET lookingfor='".$lookfor."' WHERE user='".$user."'")){
					echo "Updated";
				}
				else {
						echo "Sorry Bro, Try Again Line 326";
				}
			}
			else{
				echo "Sorry Fill It In First";
			}
		}
	?>

	<form method="post" action="eprofile.php">

	<input placeholder="Interested In" type="text" name= "interestedin" />
	<input type="submit" value="Change" name='ins'/>

	</form>
	<?php
		$lookfor = mysqli_real_escape_string($connect, $_POST['interestedin']);
		if(isset($_POST['ins'])){
			if($lookfor){
				if($query = mysqli_query($connect, "UPDATE info SET interestedin='".$lookfor."' WHERE user='".$user."'")){
					echo "Success";
				}
				else {
					echo "Error 500:166";
				}
			}
			else{
				echo "Sorry Fill It In First";
			}
		}
	?>



	<form method="post" action="eprofile.php">

	<input placeholder="Political Views" type="text" name= "politicalviews" />
	<input type="submit" value="Change" name='pltv'/>

	</form>
	<?php
		$pltviews = mysqli_real_escape_string($connect, $_POST['politicalviews']);
		if(isset($_POST['pltv'])){
			if($pltviews){
				if($query = mysqli_query($connect, "UPDATE info SET politicalviews='".$pltviews."' WHERE user='".$user."'")){
					echo "Updated";
				}
				else {
					echo "Error 500:191";
				}
			}
			else{
				echo "Sorry Fill It In First";
			}
		}
	?>
