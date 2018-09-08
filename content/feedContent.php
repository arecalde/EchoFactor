<h6 class='ti'> News Feed</h6>
<?php
	if(!loggedin()){
		header('location: index.php'); //only logged in users should see this
	}
	$my_id = $_SESSION['user_id'];	
	$query = mysqli_query($connect, "SELECT * FROM posts ORDER BY datetime DESC"); //make it so newest posts are shown first

	while($run_mem = mysqli_fetch_assoc($query)) {
		$user_id = $run_mem['user'];
		if(friendcheck($my_id, $user_id) OR $user_id==$my_id ){ //if one of my friends made the post, or I made the post then show it to me 
			$id = $run_mem['id'];
			$type = $run_mem['type']; //get the type of post, if it is textual or pictorial 
			$name = getname($user_id);
			$propic = getfield($user_id, 'profile_pic');
			$result = $run_mem['content']; //will either be text or source of picture

			if ($type == '1'){
				$content = "<img src='$result' width=300 />"; //with pics, the content is the img
				$caption = $run_mem['caption']; //get caption for the picture
				echo " <div class='col-md-12'> <div class='col-md-3'><a href='main.php?user=$user_id&page=profile' class='box' style='display:block'>".
					"<img src='$propic' width='50' height='50'/> <br />$name</a> </div> <div class='col-md-9'> <br /> <br /> $content <br /> $caption <br />".
					"</div></div> "; 	
			}
			else {
				$content = $result;
				echo " <div class='col-md-12'> <div class='col-md-3'><a href='main.php?user=$user_id&page=profile' class='box' style='display:block'>".
					"<img src='$propic' width='50' height='50'/> <br />$name</a> </div> <div class='col-md-9'> <br /> <br />"." $content <br /></div></div>"; 
			}

		}		
	} 
	include 'includes/footer.php';

?>
