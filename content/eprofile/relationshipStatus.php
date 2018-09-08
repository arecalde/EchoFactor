<h4 class='ti'>Relationship Status</h4>
	<form method='post'>
	<input type='submit' name='single' value='Single'/> <!-- if user is not single they just need to press the button -->
	<br />
	<br />
	<select name="other" >
		<option value="00"<?php echo $with == '0' ? 'selected="selected"' : ''; ?>>In a relationship with:</option>

	<?php
	$friends_query = mysqli_query($connect, "SELECT user_one, user_two FROM frnds WHERE (user_one='$my_id') OR (user_two='$my_id')"); //get all friends
	while($run_frnd = mysqli_fetch_assoc($friends_query)) {

		$user_one = $run_frnd['user_one']; 
		$user_two = $run_frnd['user_two'];
	
	
		 if($user_one == $my_id){ //assure that I am not selecting my id
			$user_id = $user_two;
			}
		else{
			$user_id = $user_one;
			}
		$fname1 = getfield($user_id, 'firstname');
		$lname1 = getfield($user_id, 'lastname');
		echo "<option value='$user_id'>$fname1 $lname1</option>";
	}
	//this will be a dropdown of the user's friends, they may select one friend to be in a relationship with and
	//the value that their selection returns will be the result of the user
	?>
	</select>
	<input type='submit' name='with' value='Click after partner selected'/> <!-- Tells the user to wait until value is selected to change the relationship status-->
	</form>
		<?php
	
			$partnerid = $_POST['other']; //short for significant other
			$partnerf = getfield($partnerid, 'firstname');
			$partnerl = getfield($partnerid, 'lastname');
			$partner = $partnerf." ".$partnerl; //fullname of SO

			if(isset($_POST['single'])){ //if single just set relationship status to single
				if($query = mysqli_query($connect, "UPDATE info SET relationshipstatus='Single' WHERE user='".$user."'")){ 
					echo "Sucessfully changed";
				}
				else {
					echo "Error 500:45";
				}
			}	
			
			
				if(isset($_POST['with'])){ //if they indicated they are in a relationship, then change status to in a relationship with someone
					if($query = mysqli_query($connect, "UPDATE info SET relationshipstatus='In a relationshp with ".$partner."' WHERE user='".$user."'")){
						echo "Sucessfully changed";
					}
					else {
						echo "Error 500:55";
					}
				}
			?>
