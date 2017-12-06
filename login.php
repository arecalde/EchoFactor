<html>

<head>
	<?php include 'includes/head.php' ?>
</head>

<body>
	<div class='col-md-12'>
		<?php include 'includer.php'; //include the database, a functions library, and the navigation bar 
			if(loggedin()){
				header('location: index.php'); //only not logged in users should see this page
			}
		?>
	</div>

		<div class='col-md-12' style='border:1px solid #3b5998; margin:0px 0px'>
	
			<?php include 'content/loginContent.php'; //login spans the entire page because the toolbar would show another login box ?>

			<?php include 'includes/footer.php'; ?>
		</div>




</body>

</html>



