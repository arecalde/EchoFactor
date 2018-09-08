 <h4 class='ti'> Register</h4>
  
<center>
<form method="post">

<input type="text" name="firstname" placeholder="First Name">
<input type="text" name="lastname" placeholder="Last Name">

<br />
<input type="text" autofill='no' name='username' placeholder="Username">

<br />
<input type="password" autofill='no' name="password" placeholder="Password">
<br />
<input type="password" name="repassword" placeholder="Confirm Password">
<br />
<input type="text" name ="email" placeholder="Email" >
<br />
<input type="radio" checked='yes' name="gender" value="male" /> Male
<input type="radio" name="gender" value="female" /> Female
<br />
<input type="submit" name="register" value="Register"> or <a href="login.php">Login</a>

</form>
<?php

if(loggedIn()){
	header('location: index.php');

}
$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$repass   = mysqli_real_escape_string($connect, $_POST['repassword']);
$email    = mysqli_real_escape_string($connect, $_POST['email']);
$gender   = $_POST['gender'];

$date  = date("Y-m-d");
$fname = mysqli_real_escape_string($connect, $_POST['firstname']);
$lname = mysqli_real_escape_string($connect, $_POST['lastname']);

if ($gender == "male") {
    $propic = "images/male_profile_pic.png";
} else if ($gender == "female") {
    $propic = "images/female_profile_pic.png";
}

$hash       = sha1($password);
$email_code = md5($username.microtime());

if (isset($_POST['register'])) {

   
    
    if ($username && $password && $repass && $email) { //make sure fields are filled in
        
        $ucheck = mysqli_query($connect, "
SELECT *
FROM users 
WHERE username = '$username'
") or die(mysql_error()); //make sure no username is taken



        $sql     = "INSERT INTO users (id, username, password, email, email_code, profile_pic, firstname, lastname, gender, date) VALUES (NULL, '" . $username . "', '" . $hash . "', '" . $email . "', '" . $email_code . "', '" . $propic . "', '" . $fname . "', '" . $lname . "', '" . $gender . "', '" . $date . "')";
	//sql for inserting the user into database
		$row     = mysqli_num_rows($ucheck);
        
        if (strlen($username) >= 5 && strlen($username) < 25) { //usernames are greater than or equal to 5 and less than 24 characters in length
            if (strlen($password) >= 6) { //password is at least 6 characters
                if ($password == $repass) { //passwords match
                    if ($row == 0) { //no other people with the same username
                        
                        if ($query = mysqli_query($connect, $sql)) { //query to complete registration
                            
                            
                            echo "Success! You have been registerd, check your email to activate your account";
                            
                            $subject    = "Welcome";
                            $mailheader = "From: EchoFactor \r\n";
                            
                            $formcontent = "
Username: $username
\n
Password: $password
\n
Activation Link:
http://echofactor.com/main.php?page=activate&email=" . $email . "&code=" . $email_code . "

\n
h
Welcome to EchoFactor! We are pretty new, but we are always adding more, check back regularly.
";
                            mail($email, $subject, $formcontent, $mailheader); //send confirmation email to register account
                        }
                        else {
                            echo "Faliure $sql";
                        }                        
                    } else {
                        echo "Username taken";
                    }
                } else {
                    echo "Passwords need to match!";
                }
            } else {
                echo "Passwords need to be more than 6 characters";
            }
        } else {
            echo "Usernames need to be  between 5 and 25 characters";
        }
    } else {
        echo "Please fill in ALL fields";
    }
}





?>
		

		
	<?php
include 'includes/footer.php';

?>

