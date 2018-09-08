<h3 class='ti'> Members </h3>

	<?php



	$query = mysqli_query($connect, "SELECT * FROM users"); //select all the users from the database, limit if the query becomes too large

	while($run_mem = mysqli_fetch_assoc($query)) //run until there are no members left
	{
			$user_id = $run_mem['id']; //get id for link to profile
			$username = $run_mem['username']; //get the username of the user
			$propic = getfield($user_id, 'profile_pic'); //get their profile pic for the image
			echo "<div class='col-md-3'>
			<a href='profile.php?user=$user_id' class='box' style='display:block'><img src='$propic' width='50' height='50'/> <br />$username</a>
			</div>"; //make it so that there is 4 to a line until next line
	}

	?> 
	
	<div class='col-md-12'>
	<?php
	include 'includes/footer.php';

	?>
	</div>
