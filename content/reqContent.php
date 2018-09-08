<h3 class='ti'> Friend Requests </h3>
<br />

<?php


	$my_id = $_SESSION['user_id'];
	$action = $_GET['action'];
	$user = $_GET['user'];

	if($action){
		if($action == 'accept'){
			mysqli_query($connect, "DELETE FROM frnd_req WHERE requester='$user' AND accepter='$my_id'");
			mysqli_query($connect, "INSERT INTO frnds VALUES(NULL, '$user', '$my_id')");

			}
		if($action == 'reject') {
				mysqli_query($connect, "DELETE FROM frnd_req WHERE requester='$user' AND accepter='$my_id'");

		}
		header('location: main.php?page=req');
	}

	$query = mysqli_query($connect, "SELECT * FROM frnd_req WHERE accepter='$my_id'");
	if (mysqli_num_rows($query) != 0) { //only show if there are requests
			echo "<div class='col-md-12'>";
		while($run_mem = mysqli_fetch_assoc($query)) {

			$user_id = $run_mem['requester'];
			$name = getname($user_id); 
			$propic = getfield($user_id, 'profile_pic');
			echo "<div class='col-md-4' style='border:0px solid #3b5998; margin:0px 0px'><div class='col-md-12'>".
 				"<a href='profile.php?user=$user_id' class='box' style='display:block'><img src='$propic' width='45' height='45'/>".
				" $name</a></div><br /><div class='col-md-12'><a href='main.php?page=req&action=accept&user=$user_id'>Accept</a>".
				" | <a href='rmain.php?page=req&action=reject&user=$user_id'>Reject</a>  </div></div>";
				/*Will show the user a pic of their requests and a name, link takes them to profile below this it shows the option to accept or reject
				both lead to links of request. Using get variables the page determines what action the user wishes to take and what the id of the person is
				From here it will take the appropriate action, if they reject then it will delete the request if accepted it will delete the request and insert 
				the ids into the frnds table				
				*/
		}

	}

	else { //if no requests just tell that to the user
		echo "
		<div class='box'>
		<center>
		<h3>No Requests

		</h3>
		</center>

		</div>
		";
	}
?> 

<div class='col-md-12'>
	<?php
	include 'includes/footer.php';

	?>

	</div>


