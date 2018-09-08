		<br />
		<form method='post' name='status'>
			<textarea name="comment"></textarea> <!-- Big textfield for status -->
			<input type='submit' name='submit' value='Post'/>
		</form>

		<?php

			if(!loggedin()){
				header('location: index.php');
			}

			$status = mysqli_real_escape_string($connect, $_POST['comment']); //prevent sql injection
			$datetime = date('Y-m-d H:i:s');

			if(isset($_POST['submit'])){
				$sql = "INSERT INTO posts (id, user, content, datetime, type) VALUES (NULL, '".$my_id."', '".$status."', '".$datetime."', '0')"; //0 for type of post, text-based
				if($query = mysqli_query($connect, $sql)) {
					echo "Successfully Posted";
				}
				else {
					echo "Error 500:21 $sql";
				}

			}

			include 'includes/footer.php';

		?>
