

<div id='nav'>

<ul>

<?php
if(loggedin()) { //show certain links to a user if they have an account
?>
	<li><a href='logout.php'>Logout</a></li>
	<li><a href='faq.php'>FAQ</a></li>
	<li><a href='main.php?page=invite'>Invite</a></li>
	<li><a href='main.php?page=member'>Members Directory</a></li>


<?php
} else { //show users these links if they are not logged
?>
	<li><a href='register.php'>Register</a></li>

	<li><a href='login.php'>Login</a></li>

<?php
}
?>
<li><a href='index.php'>Home</a></li>
<!-- Home is always shown -->
</ul>

<div class='navfix'></div>

</div>
