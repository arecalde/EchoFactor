
<h6 class='ti'> Gallery</h6>
<?php
	$my_id = $_SESSION['user_id'];

	if(!isset($_GET['user'])){
		$user = $my_id; //if no id is set, then assume it is for theirss
	}
	else {
		$user = $_GET['user'];
	}

	$query = mysqli_query($connect, "SELECT * FROM posts WHERE user='$user' AND type='1'"); //type 1 indiciates that the post is an image

	while($run_mem = mysqli_fetch_assoc($query)) {
		$id = $run_mem['id'];
		$image = getimagebyid($id); //get img src
		$cap = getimagecapbyid($id); //get img caption
		echo " <div class='col-md-6'> <img width = '300'src='".$image."' /> <br /> $cap <br /> </div> ";  //display img
	}
	echo " <br /><div class='col-md-12'>"; //make sure that the footer has it's own line even if there are an odd number of pictures
	include 'includes/footer.php'; 
	echo "</div>";
?>

