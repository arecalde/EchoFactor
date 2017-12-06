<html>

<head>
	<?php include 'includes/head.php' //includes title, css that is universal for app?>
</head>

<body>
	<div class='col-md-12'>
		<?php include 'includer.php'; //include the database, a functions library, and the navigation bar ?>
	</div>


	<div class='col-md-12'>

		<div class='col-md-2' style='border:1px dashed #8b9dc3;margin:0px 5px'>
			<?php include 'toolbar.php'; ?>
		</div>

		<div class='col-md-8' style='border:1px solid #3b5998; margin:0px 0px'>

			<?php 
				$page = $_GET['page']; //gets what content it will be showing 
				include 'content/'.$page.'Content.php'; //load the content onto the page
			?>

		</div>


		</center>
	</div>
</body>

</html>



