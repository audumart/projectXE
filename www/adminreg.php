<?php

	# include functions
	include 'includes/functions.php';
	
	# include header
	include 'includes/header.php';

	# include db connection
	include 'includes/db.php';
	
	

	$errors= [];

 if (array_key_exists('register', $_POST)) {
 	# cache errors
 	


 	# validate first name
 	if (empty($_POST['fname'])) {
 		$errors['fname'] = "please enter a first name";
 	}
 	# validate last name
 	if (empty($_POST['lname'])) {
 		$errors['lname'] = "please enter a last name";
 	}

 	if (empty($_POST['uname'])) {
 		$errors['uname'] = "please enter a username";
 	}

 	if (doesUsernameExist($conn, $_POST['uname'])) {
 		$errors['uname'] = "username already exists";
 	}

 	# validate email address
 	if (empty($_POST['email'])) {
 		$errors['email'] = "please enter an email address";

 	}
 	if (doesEmailExist($conn, $_POST['email'])) {
 		$errors['email'] = "email already exists";
 	}



 	# validate password
 	if (empty($_POST['password'])) {
 		$errors['password'] = "please enter a password";

 	}
 	# confirm password
 	if ($_POST['pword'] != $_POST['password']) {
 		$errors['pword'] = "passwords do not match";

 	}

 
 if (empty($errors)) {
 	// do database stuff

 	# eliminate unwanted spaces from values in the $_POST array
 	$clean = array_map('trim', $_POST);

 	# register admin
 	doAdminRegister($conn, $clean);
 	
	

		 } 

 	
}

?>
<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
			<?php
			$display = displayErrors($errors,'fname');
			echo $display;
			?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
			<?php
			$display = displayErrors($errors,'lname');
			echo $display;
			?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<?php
			$display = displayErrors($errors,'uname');
			echo $display;
			?>
				<label>last name:</label>	
				<input type="text" name="uname" placeholder="username">
			</div>

			<div>
			<?php
			$display = displayErrors($errors,'email');
			echo $display;
			?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
			<?php
			$display = displayErrors($errors,'password');
			echo $display;
			?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div><?php
			if (isset($errors['pword'])) { echo '<span class="err">'.$errors['pword'].'</span>'; }
			?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="adminlogin.php">login</a></h4>
	</div>
<?php	
# include footer
include 'includes/footer.php';	
?>