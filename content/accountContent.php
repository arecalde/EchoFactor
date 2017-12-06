<script type="text/javascript">
                function toUnicode(elmnt, content) {
                    if (content.length == elmnt.maxLength) {
                        next = elmnt.tabIndex
                        if (next < document.maxform.elements.length) {
                            document.maxform.elements[next].focus()
                        }
                    }
                }
            </script>
            <h4 class='ti'> Change Account Settings </h4>

            <div class='col-md-12'>
                <div class='col-md-6' style='border:1px solid #3b5998; margin:0px 0px'>
                    <form name="maxform" method="post">
                        (
                        <input size="3" tabindex="1" placeholder="(123)" maxlength="3" type="tel" name="ac" onkeyup="toUnicode(this,this.value)">) -
                        <input placeholder="(456)" type="text" name="ft" size="3" tabindex="2" maxlength="3" onkeyup="toUnicode(this,this.value)"> -
                        <input placeholder="(7890)" type="text" name="lf" size="4" tabindex="3" maxlength="4" onkeyup="toUnicode(this,this.value)">
                        <input type="submit" value="Change" name='phone' />

                    </form>
				<!-- Form is for the phone number of the user, the javascript automatically changes from box to box depending on how many digits the user types-->
                    <?php
					if (!loggedin()) {
						header('location: index.php');	
					}
					$user     = $_SESSION['user_id'];
					$my_id    = $_SESSION['user_id'];
					$username = getusername($user);
					$ac = mysqli_real_escape_string($connect, $_POST['ac']); //areacode
					$ft = mysqli_real_escape_string($connect, $_POST['ft']); //first three
					$lf = mysqli_real_escape_string($connect, $_POST['lf']); //last 4
					$phone = "(".$ac.")-".$ft."-".$lf; //all of them together in phone format

					if (isset($_POST['phone'])) {
						if ($phone) {
							if ($query = mysqli_query($connect, "UPDATE info SET phone='" . $phone . "' WHERE user='" . $my_id . "'")) {
								echo "Succesfully updated";
							} else {
								echo "Error 500:63";
							}
						} else {
							echo "Sorry Fill It In First";
						}
					}
				?>

                        <form method="post">
                            <input placeholder="Email" type="text" name="email" />
                            <input type="submit" value="Change" name='emailS' />
                        </form>
					<!-- Form for the user to update their email-->
                        <?php
						$email = mysqli_real_escape_string($connect, $_POST['email']);
						if (isset($_POST['emailS'])) {
							if ($email) {
								if ($query = mysqli_query($connect, "UPDATE users SET email='" . $email . "' WHERE id='" . $my_id . "'")) {
									echo "Email Changed";
								} else {
									echo "Error 500:82";
								}
							} else {
								echo "Sorry Fill It In First";
							}
						}
					?>
                </div>
            </div>
		<div class='col-md-12'>
        		<?php include 'includes/footer.php';?>
    		</div>
