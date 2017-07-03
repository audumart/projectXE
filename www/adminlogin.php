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

	
	<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Administrator Login</title>
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
</head>
  <div class="container">
  <!--<img src="../images/projectXE.png" alt="logo" width="20%" height="5%">-->
</div>


<form action="adminhome.php" method="POST">
  <div class="container1">

    <div class="wrapper">
    <h1 id="register-label">Admin Login</h1>
    <hr>
    <form id="register"  action ="adminlogin.php" method ="POST">
      <div>
      
        <label>email:</label>
        <input type="text" name="email" placeholder="email" required>
      </div>
      <div>
      
        <label>password:</label>
        <input type="password" name="password" placeholder="password" required>
      </div>

     
   

    
      <button type="submit" name = "register" class="loginbtn" value="login">Login</button>
    

<h4 class="jumpto">Don't have an account? <a href="adminreg.php">register</a></h4>

</form>

</div>

  </div>
</html>
