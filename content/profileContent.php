		 
 <h4 class='ti'> 
	<?php
		$user = $_GET['user'];
		$fname = getfield($user, 'firstname');
		$lname = getfield($user, 'lastname');
		echo $fname." ".$lname."'s Profile"; //indicate the name of the profile
	?>
</h4>
<br />
<div class='col-md-12'>
		<div class='col-md-5'> <!-- This will be the left column of things -->
			
			<!-- Start Profile Pic -->
			<div class="col-md-12" style='border:1px solid #3b5998; margin:0px 3px'>
				<center>
					<?php
						$propic = getfield($user, 'profile_pic'); //gets path to profile pic
						echo "<img src='$propic' width='200' height='200'/>";
					?>
				</center>

			<!-- End Profile Pic -->
			<br />
			
			<!--Start Actions (Friend/Unfriend/Message) -->

	
					<h6 class='ti'>Connection</h6>
					<br />

				<?php
					echo "<a href='sendmsg.php?user=$user' class='box'>Message This Person</a><br /><br />"; //give option to message the user
					//begin friend check
					$sql = "SELECT id FROM frnds WHERE (user_one='$my_id' AND user_two='$user') OR (user_one='$user' and user_two='$my_id')";
					$check_frnd_query = mysqli_query($connect, $sql );
					$rows = mysqli_num_rows($check_frnd_query);
					//end friend check
					if($rows == 1) {
								echo "<a href='actions.php?action=unfriend&user=$user' class='box'>Unfriend</a>"; //if they are friends show the option to unfriend
					}
		
					else { //otherwise show different options with requests
				
						$sql = "SELECT * FROM `frnd_req` WHERE `requester` = '$user' AND `accepter` = '$my_id'";
						$from_query = mysqli_query($connect, $sql); //check to see if the user has already sent a request to me

						$sql = "SELECT * FROM `frnd_req` WHERE `requester` = '$my_id' AND `accepter` = '$user'";
						$to_query =   mysqli_query($connect, $sql); //check to see if I have sent a request to the user
		
						$from = mysqli_num_rows($from_query);
						$to = mysqli_num_rows($to_query);

          
		
						if ($from == 1) //if they have already sent a request give me the option to ignore or accept
						{ 
							echo "<span class='box'>Ignore</span> | <span onclick=\"handleAction($user, 'accept')\" class='box'>Accept</span>";
						}
						else if($to == 1) //if I have already sent a request give me the option to cancel
						{ 
							echo "<span onclick=\"handleAction($user, 'cancel')\" class='box'>Cancel Request</span>";
							}
						else //otherwise give me the option to send a friendrequest
						{
							echo "<span onclick=\"handleAction($user, 'send')\" class='box'>Send Friend Request</span>";
						}
	
					}
		
				?>
        <script type='text/javascript'>
          function handleAction(user, action){
            $.ajax({
              type: 'post',
              url: "actions.php",
              data: {
                  'action': action,
                  'user': user,
                  'user_id': <?php echo $_SESSION['user_id']; ?>
              },
              cache: false,
              success: function(data) {
                alert(data);
              }
          });
          }
        </script>
				<br />
				<br />


			<!-- End Actions -->			
	
			<!-- Begin Showing Friends -->	

				<h6 class='ti'>Friends</h6>
				<br />
				<br />
				<?php
		
					$my_id = $_SESSION['user_id'];
					$friends_query = mysqli_query($connect, "SELECT user_one, user_two FROM frnds WHERE (user_one='$user') OR (user_two='$user') ORDER BY rand() LIMIT 3");
					//randomly select some of the users friends and show them to me
					$row = mysqli_num_rows($friends_query); //count the number
					if ($row != 0) { //if they do not have any friends do not enter the loop
						while($run_frnd = mysqli_fetch_assoc($friends_query)) {
							$user_one = $run_frnd['user_one'];
							$user_two = $run_frnd['user_two'];
		
		
							 if($user_one == $user){ //make sure to get the other person, not the person we are viewing
								$user_id = $user_two;
								}
							else{
								$user_id = $user_one;
								}
		
							$username = getusername($user_id);
							$propic = getfield($user_id, 'profile_pic');
							$fname = getfield($user_id, 'firstname');
							$lname = getfield($user_id, 'lastname');

							echo "<a href='profile.php?user=$user_id' class='box' style='display:block'><img src='$propic' width='50' height='50'/> <br />$fname $lname</a>";
						}
					}
				?>
				<br />
				<!-- End Showing Friends -->
				
				<!-- Begin Showing Mutual Friends -->	
				<h6 class='ti'>Mutual Friends</h6>
						
						
				<?php
					$friends_query = mysqli_query($connect, "SELECT user_one, user_two FROM frnds WHERE (user_one='$user') OR (user_two='$user')");
					$row = mysqli_num_rows($friends_query);
					if ($row != 0){ //do not run if there are no friends
							while($run_friend = mysqli_fetch_assoc($friends_query)){
								$user_one = $run_friend['user_one'];
								$user_two = $run_friend['user_two'];
		

								 if($user_one == $user){ //make sure to get the other person, not the person we are viewing
									$user_id = $user_two;
								}
								else{
									$user_id = $user_one;
								}
								//check to see if their are mutual friends by getting the ids of their friends and checking if I have any
								//friends with matching ids
								$sql = "SELECT * FROM frnds WHERE (user_one='$my_id' AND user_two = $user_id) OR (user_one= $user_id AND user_two='$my_id')";
								$myfriends= mysqli_query($connect, $sql);

									while($runmy = mysqli_fetch_assoc($myfriends)){ //cycle through all of my friends that are matching
										$ouruser_one = $runmy['user_one'];
											$ouruser_two = $runmy['user_two'];
											 if($ouruser_one == $my_id){ //make sure to get the other person's id, not my id
												$ouruser = $ouruser_two;
												}
											else{
												$ouruser = $ouruser_one;
												}
													$propic2 = getfield($ouruser, 'profile_pic');
													$fname2 = getfield($ouruser, 'firstname');
													$lname2 = getfield($ouruser, 'lastname');
													 echo " <a href='profile.php?user=$ouruser' class='box' style='display:block'><img src='$propic2' width='50' height='50'/> <br />$fname2 															$lname2</a> ";
									}	
							}
					}
				?>
		
				</div>
			</div>
			<!-- End Left Column-->

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

			<!-- End Right Column-->
	
