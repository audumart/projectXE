<?php
	
	session_start();

	# title
	$page_title = "Login";

	#include function
	include 'includes/functions.php';

	#include db
	include 'includes/db.php';

	

	

	if (array_key_exists('register', $_POST)) {
		# error caching
		$errors = [];
		

		if (empty('email')) {
			$errors['email'] = "please enter your email";
		}
		if (empty('password')) {
			$errors['password'] = "please enter your password";
		}

		if (empty($errors)) {
			# select from db

			#remove unwanted vakues from the array $_POST
			$clean = array_map('trim', $_POST);

			$chk = adminLogin($conn, $clean);
					if($chk[0]){
						$_SESSION['id'] = $chk[1]['admin_id'];
						$_SESSION['email'] = $chk[1]['email'];
						//print_r($_SESSION); exit();
						redirect("adminhome.php");
		} else{
			 redirect("adminlogin.php?msg=invalid email or password");
		}
	}
}
?>

	
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="adminLogin.php" method ="POST">
			<div>
			
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
			
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="adminreg.php">register</a></h4>
	</div>
