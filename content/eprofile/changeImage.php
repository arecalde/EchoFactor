<div class="col-md-12" style='border:1px solid #3b5998; margin:0px 3px'>
			
		
	<h6 class='ti'>Profile Pic</h6>

	<center>
		<form method='post' enctype='multipart/form-data'>

			Available file extension: <b>.PNG .JPG .JPEG</b><br /><br /> <!-- Shows allowed types of extensions to user-->
			<input type='file' name='image'><br /> <!-- Choose file button -->
			<input type='submit' name='change_pic' value='Upload'> <!--Upload button -->
		</form>
		<?php


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
		

						copy($file_tmp, 'images/'.$new_name); //put file on server
						$image_up = 'images/'.$new_name; //the path that the image is on
						if($query = mysqli_query($connect, "UPDATE users SET profile_pic='".$image_up."' WHERE id='".$my_id."'")){ //update profile pic in MySQL database
							echo "Profile Picture Changed Successfully";
						}
						else {
							echo "Query Unsuccessful Error 500:46";
						}

					}
					else {
						foreach($errors as $error){
							echo $error."<br />";
						}
					}
	
	
			}
		
			$propic = getfield($user, 'profile_pic');
			echo "<img src='$propic' width='200' height='200'/>";
		?>

		
	</center>
	</div>

	<br />
	<br />
		
		
