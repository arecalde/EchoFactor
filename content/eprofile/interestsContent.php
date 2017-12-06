
	<?php
		$interestssql = "SELECT * FROM info WHERE user = $my_id"; //get info for user from database
		if($query = mysqli_query($connect, $interestssql)){
			while($irun = mysqli_fetch_assoc($query)){
				$previousinterests = $irun['interests']; //get interests from database
			}
		}
	?>

	<br />
	<?php 
		echo "Old Interests<br />";
		if($previousinterests) {echo $previousinterests;} //show old interests before editing
	?>
	<form method='post'>
		<input type= 'text' style="width: 100%;" name="interests" placeholder="Put Interests Here" /> <!-- Textbox for interests-->

		<br />
		<input type ='submit' value='Change' name='interestsBtn' /> <!-- Change the interests -->
	</form>


	<?php
		if (isset($_POST['interestsBtn'])) {
			$interests = mysqli_real_escape_string($connect, $_POST['interests']); //prevent sql injection
		
			if($interests){
					if($query = mysqli_query($connect, "UPDATE info SET interests='".$interests."' WHERE user='".$user."'")){ //update interests in database
						if($query = mysqli_query($connect, $interestssql)){
							while($irun = mysqli_fetch_assoc($query)){
								$cinterests = $irun['interests']; //get new interests
							}
							echo "Interests changed to<br />".$cinterests."<br />"; //show new interests to user
						}
						else {
							echo "Query Unsuccessful Error Code: 500:53";
						}
					}
					else {
						echo "Query Unsuccessful Error Code: 500:58";
						
					}
				
			
			}
			else{
					echo "Sorry Fill It In First";
			}
		}
	?>

