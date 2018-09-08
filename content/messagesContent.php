<h6 class='ti'> Messages</h6>
	<br />
	<center>
	<h4>
	<a href='main.php?page=messages&mode=recieved'>Received</a> | <a href='main.php?page=messages&mode=sent'>Sent</a> 
	<!-- Two Modes, messages recieved and messages sent -->
	</h4>
	</center>
	<?php
		if(!loggedin()){
			header('location: index.php'); //only logged on users should see this
		}

		$my_id = $_SESSION['user_id'];
		$action = $_GET['action'];
		$mid = $_GET['id'];



		if(isset($_GET['mode']) && !empty($_GET['mode'])){
			$mode = $_GET['mode']; //messages shown will change based on mode
		}
		else {
			$mode = 'recieved';	//default mode is recieved
		}

		if ($mode == 'recieved') {
			$query = mysqli_query($connect, "SELECT * FROM msgs WHERE reciever='$my_id' ORDER BY datetime DESC"); //sql for seeing recieved messages
		}
		if ($mode == 'sent') {
			$query = mysqli_query($connect, "SELECT * FROM msgs WHERE sender='$my_id' ORDER BY datetime DESC"); //sql for seeing sent messages
		}


			if($action == 'delete'){
				if(mysqli_query($connect, "DELETE FROM `msgs` WHERE `id`= '".$mid."'AND `reciever`='".$my_id."'")){ //deletes message
					header('location: main.php?page=messages');
				}
				else {
					echo "Message Not Deleted";
				}
			}


		while($run_mem = mysqli_fetch_assoc($query)) { //loop through messages
			if ($mode == sent) { //id changes based on mode
						$user_id = $run_mem['reciever'];

			}
			if ($mode == recieved) {
						$user_id = $run_mem['sender'];

			}

			$id = $run_mem['id'];
			$username = getfield($user_id, 'username');
			$fname = getfield($user_id, 'firstname');
			$lname = getfield($user_id, 'lastname');
			$propic = getfield($user_id, 'profile_pic');
			$msg = getmsgbyid($id);
						

					if ($mode == sent) {
						echo "<br /> ";
			echo "
			<div class='col-md-12' style='border:1px solid #3b5998; margin:0px 0px'>
			<h6 class='ti'> To $fname $lname</h6>

					<div class='col-md-3'>

			<a href='profile.php?user=$user_id' class='box' style='display:block'><img src='$propic' width='50' height='50'/> <br />$username</a>
			</div>
					<div class='col-md-9'>
					<br />
									<br />

					$msg
						<br />

					</div>

			</div>
			";	//string to sent, different format because of actions that can be taken

			}
			if ($mode == recieved) {



	echo "<br /> ";
			echo "
			<div class='col-md-12' style='border:1px solid #3b5998; margin:0px 0px'>
			<h6 class='ti'> From $fname $lname</h6>

					<div class='col-md-3'>

			<a href='profile.php?user=$user_id' class='box' style='display:block'><img src='$propic' width='50' height='50'/> <br />$username</a>
			</div>
					<div class='col-md-8'>
					<br />
									<br />

				 	$msg
						<br />

					</div>
					<div class='col-md-1'>
					<br />
					<a href='sendmsg.php?user=$user_id' class='box'>
					Reply
					</a>
					<br />
									<br />

					<a href='main.php?page=messages&action=delete&id=$id' class='box'>
					Delete
					</a>
					<br />
				
					</div>

			</div>
			";		
			}


		
	}
		
	  

	  
	include 'includes/footer.php';

	?>
