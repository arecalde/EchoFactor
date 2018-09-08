<h3 class='ti'> Friends  </h3>
<br />
<div class='col-md-12'>
	<?php
		$my_id = $_SESSION['user_id'];
		$friends_query = mysqli_query($connect, "SELECT user_one, user_two FROM frnds WHERE (user_one='$my_id') OR (user_two='$my_id')"); //sql for selecting the ids of my friends
		$row = mysqli_num_rows($friends_query);

		if ($row != 0) { //run only if the person has friends
			while($run_frnd = mysqli_fetch_assoc($friends_query)) {
				$user_one = $run_frnd['user_one'];
				$user_two = $run_frnd['user_two'];
	
				if($user_one == $my_id){ //make sure not to select my id and only to select the id of other people
					$user = $user_two;
				}
				else{
					$user = $user_one;
				}
	
				$name = getname($user); //returns first and last name
	
				$propic = getfield($user, 'profile_pic'); 
				echo "<div class='col-md-3'>
				<a href='profile.php?user=$user' class='box' style='display:block'><img src='$propic' width='50' height='50'/> <br />$name</a>
				</div>
				";
			}
		}

		else { //message to show if there are no friends
			echo "
			<div class='box'>
			<center>
			<h3>
			Find Friends on our <a href='members.php'>Members </a>Page
	
			</h3>
			</center>
	
			</div>
			";
		}

	?>  

	<br />
	<br />
	</div>

	<div class='col-md-12'>
	<?php
		include 'includes/footer.php'; //assure footer has it's own row
	?>

</div>
