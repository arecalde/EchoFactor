<?php



	$moviesql = "SELECT * FROM info WHERE user = $my_id";
	if($query = mysqli_query($connect, $moviesql)){
		while($morun = mysqli_fetch_assoc($query)){
			$previousmovies = $morun['favmovies'];
		}
	}
	echo "Old Movies<br />";
	if($previousmovies) {echo $previousmovies;} //show movies before they are changed


	?>


	<br />
	<br />
	<form method='post'>
		<input type= 'text' style="width: 100%;" name="favmovies" placeholder="Put Favorite Movies Here" /><br /> <!-- Box for movies -->
		<input type ='submit' value='Change' name='favmoviesub' /> <!-- Button to change movies -->
	</form>


	<?php
	if (isset($_POST['favmoviesub'])) { //begin change
		$favmovies = mysqli_real_escape_string($connect, $_POST['favmovies']); //prevent sql injection
		if($favmovies){
			if($query = mysqli_query($connect, "UPDATE info SET favmovies='".$favmovies."' WHERE user='".$user."'")){

				if($query = mysqli_query($connect, $moviesql)){
					while($morun = mysqli_fetch_assoc($query)){
						$cmovie = $morun['favmovies'];
					}
					echo "Favorite Movies changed to<br />".$cmovie."<br />"; //show now changed movies
				}
				else {
					echo "Query Failed Error Code 500:41";
				}
			}
		}
		else{
				echo "Sorry Fill It In First";
		}
	}
	?>



