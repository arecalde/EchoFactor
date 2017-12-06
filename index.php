<html>
<head>

	<?php include 'includes/head.php'; //contains the stylesheets and title ?>

</head>
<body>
	<div class='col-md-12'>
	<?php include 'includer.php'; //includes the database, functions lib, and the nav bar ?>

	</div>


	<div class='col-md-12'>

		<div class='col-md-2' style='border:1px dashed #8b9dc3; margin:0px 5px'>
		<?php
			include 'toolbar.php'; //shows user toolbar or login box depending on whether or not they are logged in
		?>
		</div>

		<div class='col-md-8' 	style='border:1px solid #3b5998; margin:0px 0px'>
		 		<?php include 'content/indexContent.php'; //pulls the content for the homepage ?> 


		</div>
				       

	</div>



</body>
</html>



