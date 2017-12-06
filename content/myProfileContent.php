<h4 class='ti'>	
<?php 
	$user = $my_id;
	echo getname($user)."'s Profile (This Is You)"; 
?> </h4>
	  
<div class='col-md-12'>
		<br />
	<!-- Start Left Column -->
		<div class='col-md-4'>
			<div class="col-md-12" style='border:1px solid #3b5998; margin:0px 3px'>
		
		
			<br />
			<center>

			<?php
				$propic = getfield($user, 'profile_pic');
				echo "<img src='$propic' width='200' height='200'/>";
			?>
			</center>

			<!-- Show different profile related links-->
			<div class="col-md-12" style='border:1px solid; margin:0px 3px'>
				<a href='main.php?page=friends'>View Friends</a>
			</div>	
			<div class="col-md-12" style='border:1px solid; margin:0px 3px'>
				<a href='eprofile.php'>Edit My Profile</a>
			</div>
			<div class="col-md-12" style='border:1px solid; margin:0px 3px'>
				<a href='main.php?page=account'>My Account</a>
			</div>
			<div class="col-md-12" style='border:1px solid; margin:0px 3px'>
				<a href='main.php?page=gallery'>View My Photos</a>
			</div>
		</div>
	</div>
	<!-- End Left Column -->

	<!-- Start Right Column-->
	<div class='col-md-7' 	style='border:1px solid #3b5998; margin:0px 0px'>

	
		<?php
			//begin getting information about user
			$username = getusername($user);	
			$date = getfield($user, 'date');	
			$email = getfield($user, 'email');	
			$fname= getfield($user, 'firstname');	
			$lname= getfield($user, 'lastname');	
			$sex= getfield($user, 'gender');	
			$school= getinfofield($user, 'school');	
			$town= getinfofield($user, 'town');	
			$hometown= getinfofield($user, 'hometown');	
			$bday= getinfofield($user, 'birthday');	
			$phone= getinfofield($user, 'phone');	
			$status= getstatus($user);	
			$interests= getinfofield($user, 'interests');	
			$lookfor= getinfofield($user, 'lookingfor');	
			$inin= getinfofield($user, 'interestedin');	
			$favmusic= getinfofield($user, 'favmusic');	
			$favmovies= getinfofield($user, 'favmovies');	
			$pltviews= getinfofield($user, 'politicalviews');	
			$bday= getinfofield($user, 'birthday');	
			$rltstatus= getinfofield($user, 'relationshipstatus');	
			$aboutme= getinfofield($user, 'aboutme');	
			//end getting info about user
			
			//show all above info
			echo "<b>Account Info</b><br />";

			echo "<b>First Name:</b> ".$fname."<br />";		
			echo "Last Name: $lname<br />";
			echo "Member Since: ".$date." <br />";
			echo "<br />";

			echo "<b>Basic Info:</b><br />";
			echo "School: $school <br />";
			echo "Status: $status<br />";
			echo "Sex: $sex<br />";
			echo "Current Town: $town<br />";
			echo "Birthday: $bday<br />";
			echo "Hometown: $hometown<br />";
			echo "<br />";

			echo "<b>Contact Info:</b><br />";
			echo "Email: ".$email." <br />";
			echo "Username: ".$username." <br />";
			echo "Mobile: $phone<br />";
			echo "<br />";

			echo "<b>Personal Info Info:</b><br />";
			echo "Looking For: $lookfor<br />";
			echo "Interested In: $inin <br />";
			echo "Relationship Status: $rltstatus<br />";
			echo "Political Views: $pltviews<br />";
			echo "Interests: $interests<br />";
			echo "Favorite Music: $favmusic <br />";
			echo "Favorite Movies: $favmovies<br />";

			echo "About Me: <br />";
			echo "<br />";
		?>
	</div>

	<!-- End Right Column-->
</div>
