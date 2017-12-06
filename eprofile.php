
<html>
<head>
	<?php include 'includes/head.php'; ?>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
	<!-- Above script needed for about me section. See content/eprofile/main.php for more info -->
</head>
<body>
	<div class='col-md-12'>


		<?php
			include 'includer.php';
			if(!loggedin()){
				header('location: index.php'); //only logged in users should see this page
			}
		?>

	</div>
	
	<div class='col-md-12'>

		<div class='col-md-2' style='border:1px dashed #8b9dc3;margin:0px 5px'>
			<?php
				include 'toolbar.php';
				$user = $_SESSION['user_id'];
				$username = getfield($user, 'username');
				//above variables will be used in main
			?>
		</div>
	<div class='col-md-8' style='border:1px solid #3b5998; margin:0px 0px'>

	 	<?php include 'content/eprofile/main.php';
			//entire folder dedicated to edit profile because there are a lot of complicated roles that
			//are completed by the page, they need to be broken down. Main pulls all of these together and
			//displays them to the user
		?>
	 
	  
	</div>
		              

	</div>

	<div class='col-md-12'>
	<?php

	include 'includes/footer.php'; //needed for legal stuff and various links

	?>

	</div>
</body></html>














  
