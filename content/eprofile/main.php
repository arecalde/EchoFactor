
<div class='col-md-12'>	
		<br />
		<div class='col-md-6'>
			<?php include 'changeImage.php'; ?>
		
	<div class="col-md-12" style='border:1px solid #3b5998; margin:0px 3px'>

	
	<h4 class='ti'>Lists</h4>

	<?php 
		include 'interestsContent.php';
		include 'musicContent.php';
		include 'movieContent.php';	
	
	?>

	</div>
	
	
	</div>

	<div class='col-md-6' 	style='border:1px solid #3b5998; margin:0px 0px'>
		
		
	<div class='col-md-12' style='border:1px solid #3b5998; margin:0px 0px'>
	
	<h6 class='ti'>Information</h6>


	<?php 
		include 'infoChain.php'; 
		include 'bday.php';
	?>


	</div>




	<div class='col-md-12' style='border:1px solid #3b5998; margin:0px 0px'>
	<?php include 'relationshipStatus.php'; ?>

	</div>

	</div>


	</div> 
	<br />
	<br />
	<div class='col-md-12'>
	<h3 class='ti'>About You!</h3>
	<form method='post'>
		<textarea name='aboutme'></textarea>
		<input type='submit' value='Post' name='aboutmes' /> <!-- Short bio where the user can talk about themselves -->
	</form>
	<?php 


	$aboutme = mysqli_real_escape_string($connect, $_POST['aboutme']); //protect from sql injection
	$amsql = "UPDATE info SET aboutme='".$aboutme."' WHERE user='".$my_id."'";
	if (isset($_POST['aboutmes'])) {
		if($aboutme) {
				if($amquery = mysqli_query($connect, $amsql)) {
					echo "Sucessfully Updated";
				}
				else {
					echo "Error 500:71";
				}
		}
		else {
			echo "Write some stuff first!";
		}
	}

	?>
	</div>

