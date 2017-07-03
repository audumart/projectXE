<?php

	# include functions
	include 'includes/functions.php';
	
	

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
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Register</title>
        <link rel="stylesheet" href="../css/regstyle.css" type="text/css" />
</head>
  <div class="container">
  <!--<img src="../images/projectXE.png" alt="logo" width="20%" height="5%">-->
</div>



<div class="wrapper">
  <div class="container">
    <h1 id="register-label">Admin Register</h1>
    <hr>
    <form id="register"  action ="adminreg.php" method ="POST">
      <div>
      <?php
      $display = displayErrors($errors,'fname');
      echo $display;
      ?>
       
        <input type="text" name="fname" placeholder="first name">
      </div>
      <div>
      <?php
      $display = displayErrors($errors,'lname');
      echo $display;
      ?>
        
        <input type="text" name="lname" placeholder="last name">
      </div>
      <div>
      <?php
      $display = displayErrors($errors,'uname');
      echo $display;
      ?>
       
        <input type="text" name="uname" placeholder="username">
      </div>

      <div>
      <?php
      $display = displayErrors($errors,'email');
      echo $display;
      ?>
        
        <input type="text" name="email" placeholder="email">
      </div>
      <div>
      <div>
      <?php
      $display = displayErrors($errors,'password');
      echo $display;
      ?>
       
        <input type="password" name="password" placeholder="password">
      </div>

      <div>
        <?php
      if (isset($errors['pword'])) { echo '<span class="err">'.$errors['pword'].'</span>'; }
      ?>
      
        <input type="password" name="pword" placeholder="password">
      </div>

      <button type="submit" class="registerbtn" name="register" value="register">Register</button>
    </form>


    <h4 class="jumpto">Have an account? <a href="adminlogin.php">Login</a></h4>

</form>
  </div>
  </div>
</html>
