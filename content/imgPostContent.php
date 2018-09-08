<form method='post' enctype='multipart/form-data'>
					<br /><center>
				<form method='post' enctype='multipart/form-data'>
					Available file extension: <b>.PNG .JPG .JPEG</b><br /><br /> <!-- Shows allowed types of extensions to user-->
					<input type='text' name='caption' placeholder='Caption' style='width:100%;' /> <!-- Box for caption -->
					<input type='file' name='image'><br /> <!-- Choose file button -->
					<input type='submit' name='change_pic' value='Upload'> <!--Upload button -->
				</form>
				<?php
					if(!loggedin()){
						header('location: index.php');
					}

					$my_id = $_SESSION['user_id'];

					$datetime = date('Y-m-d H:i:s');
					$caption = mysqli_real_escape_string($connect, $_POST['caption']);

					if(isset($_POST['change_pic'])) //when upload is pressed
					{
						$errors = array(); //store errors
						$allowed_e = array('png', 'jpg', 'jpeg'); //tell the computer allowed extensions
						$file_name = $_FILES['image']['name']; //get original file name
						$file_e = strtolower(pathinfo($file_name,PATHINFO_EXTENSION)); //change everything to lower
						$file_s = $_FILES['images']['size']; //get image size
						$file_tmp = $_FILES['image']['tmp_name']; //get the tmpname

						$rand = genRandomString(); //random string used for naming

						$new_name = $rand."_".$my_id."_".time().".".$file_e; //the name that the file will be stored under

						if(in_array($file_e, $allowed_e) === false) { //if file is not one of allowed types
							$errors[] = 'File Extension Not Allowed';	
						}
	
						if($file_s > 2097152) { //if size is above 2 MB
							$errors[] = 'File Is Above 2 MB';
						}
	
						if(empty($errors)) { //if both paremeters were met
							copy($file_tmp, 'images/'.$new_name); //actually move the file to the server
							$image_up = 'images/'.$new_name; //record the path of the image
							$sql = "INSERT INTO posts (id, user, content, datetime, type, caption) VALUES (NULL, '".$my_id."', '".$image_up."', '".$datetime."', '1',".
								  "'".$caption."') "; //insert everything, 1 indicates that it is a picture
							if($query = mysqli_query($connect, $sql)) {
								echo "Posted";
							}
							else {
								echo "Error code 500:77";
							}
						}
						else {
							foreach($errors as $error){
								echo $error."<br />"; //show errors
							}
						}
					}
					include 'includes/footer.php';
				?>
