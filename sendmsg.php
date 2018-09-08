<html>
<head>
	<?php include 'includes/head.php';?>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
</head>
<body>
	<div class='col-md-12'>
	
	<?php
		include 'includer.php';
		if(!loggedin()){
			header('location: index.php');
		}
	?>

	<?php
		$action = $_GET['action'];
		$id = $_GET['id'];//id of message, if being deleted
		$my_id = $_SESSION['user_id'];

		if($action == 'delete'){ //if the user wants to delete a message
			if(mysqli_query($connect, "DELETE FROM `msgs` WHERE `id`= '".$id."'AND `reciever`='".$my_id."'")){
				echo "Message Deleted";
			}
			else {
				echo "Message not deleted";
			}
		}


		if(isset($_GET['user']) && !empty($_GET['user'])){ //only run the page if their is a user indicated
			$user = $_GET['user'];

		}
		else {
			header('location: index.php');	
		}
	?>


	</div>


	<div class='col-md-12'>

		<div class='col-md-2' style='border:1px dashed #8b9dc3;margin:0px 5px'>
			<?php
				include 'toolbar.php';

			?>

		</div>

	<div class='col-md-8' 	style='border:1px solid #3b5998; margin:0px 0px'>
		<form method='post' name='status'>
			<textarea name="comment"></textarea>
			<input type='submit' name='submit' value='Send'/>
		</form>

	<?php
		$user = $_GET['user'];

		$message = mysqli_real_escape_string($connect, $_POST['comment']);
		$datetime = date('Y-m-d H:i:s');

		if(isset($_POST['submit'])){
		if($query = mysqli_query($connect, "INSERT INTO msgs (id, sender, reciever, message, datetime) VALUES (NULL, '".$my_id."', '".$user."', '".$message."', '".$datetime."') ")) 
		{
				echo "Succesfully Sent";
		}
			else {
				echo "Error 500:80";
			}

		}

		include 'includes/footer.php';

	?>


	</div>

	</center>

	</div>



</body>
</html>



<?php


?>
