<form method='post'>
	<select name="birthYear" >
		<option value="0000"<?php echo $birthdayYear == '0000' ? 'selected="selected"' : ''; ?>>Year:</option>
		<?php
		for($i=date('Y'); $i>1899; $i--) {
			$selected = '';
			if ($birthdayYear == $i) $selected = ' selected="selected"';
			print('<option value="'.$i.'"'.$selected.'>'.$i.'</option>'."\n"); 
			//show all of the different years since 1899 counting down from current year to 1899
		}
		?>
	</select>



	<select name="birthMonth" >
		<option value="00"<?php echo $birthMonth == '00' ? 'selected="selected"' : ''; ?>>Month:</option>
		<?php
		for($k=1; $k<=12; $k++) {
			$selected2 = '';
			if ($birthMonth == $k) $selected2 = ' selected="selected"';
			print('<option value="'.$k.'"'.$selected2.'>'.getmonth($k).'</option>'."\n");
			//for loop counting up from 1 to 12, each number representing a different month
			//number is then displayed to user
		}
		?>
	</select>

	<select name="birthDay" >
		<option value="00"<?php echo $birthdayDay == '00' ? 'selected="selected"' : ''; ?>>Day:</option>

		<?php
		for($j=1; $j<32; $j++) {
			$selected1 = '';
			if ($birthdayDay == $j) $selected1 = ' selected="selected"';
			print('<option value="'.$j.'"'.$selected1.'>'.$j.'</option>'."\n");
			//show all days of the month, no special cases if it is a month with less than 31 days like febuary
			//for loop counting up from 1
		}
		?>

	</select>

	<input type='submit' name='bdays' value='Change'/> <!-- submit button for bday -->
	</form>
	<?php
	$byear = $_POST['birthYear'];
	$bmonth = $_POST['birthMonth'];
	$bdate = $_POST['birthDay'];
	//since numbers are generated from dropdowns, no need for sql check

	$bday = "$byear-$bmonth-$bdate"; //put in Y-m-d format
	if (isset($_POST['bdays'])){
		if($query = mysqli_query($connect, "UPDATE info SET birthday='".$bday."' WHERE user='".$user."'")){
			echo "Updated";
		}
		else {
			echo "Error 500:59";
		}
	}
	?>
