
	<?php
	$musicsql = "SELECT * FROM info WHERE user = $my_id";
	if($query = mysqli_query($connect, $musicsql)){
		while($mrun = mysqli_fetch_assoc($query)){
			$previousmusic = $mrun['favmusic'];
		}
	}
	echo "Old Music<br />";
	if($previousmusic) {echo $previousmusic;} //show the music before it is changed

	?>


	<br />
	<form method='post'>
		<input type= 'text' style="width: 100%;" name="favmusic" placeholder="Put Favorite Music Here" /><br /> <!-- Box for music-->
		<input type ='submit' value='Change' name='favmusics' /> <!--Change Music-->
	</form>


	<?php
		if (isset($_POST['favmusics'])) {
			$favmusic = mysqli_real_escape_string($connect, $_POST['favmusic']); //prevent sql injection
	
			if($favmusic){
				if($query = mysqli_query($connect, "UPDATE info SET favmusic='".$favmusic."' WHERE user='".$user."'")){ //update music in database
	
	
	
					if($query = mysqli_query($connect, $musicsql)){
						while($mrun = mysqli_fetch_assoc($query)){
							$cmusic = $mrun['favmusic'];
						}
						echo "Favorite Music changed to<br />".$cmusic."<br />";//show changed music

					}
					else {
								echo "Error Query Failed Code: 500:39";
					}
				}
				else {
							echo "Error Query Failed Code: 500:44";
						}
				
	
			}
			else{
					echo "Sorry Fill It In First";
				}
		}


	?>



