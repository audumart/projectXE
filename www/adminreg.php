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
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

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


<div class="container1">
<div class="wrapper">
    <h1 id="register-label">Admin Register</h1>
    <hr>
    <form id="register"  action ="adminlogin.php" method ="POST">
      <div>
      <?php
      $display = displayErrors($errors,'fname');
      echo $display;
      ?>
        
        <input type="text" name="fname" placeholder="first name" required>
      </div>
      <div>
      <?php
      $display = displayErrors($errors,'lname');
      echo $display;
      ?>
        
        <input type="text" name="lname" placeholder="last name" required>
      </div>

      <?php
      $display = displayErrors($errors,'uname');
      echo $display;
      ?>
        
        <input type="text" name="uname" placeholder="username" required>
      </div>

      <div>
      <?php
      $display = displayErrors($errors,'email');
      echo $display;
      ?>
       
        <input type="text" name="email" placeholder="email" required>
      </div>
      <div>
      <?php
      $display = displayErrors($errors,'password');
      echo $display;
      ?>
       
        <input type="password" name="password" placeholder="password" required>
      </div>
 
      <div><?php
      if (isset($errors['pword'])) { echo '<span class="err">'.$errors['pword'].'</span>'; }
      ?>
         
        <input type="password" name="pword" placeholder="confirm password" required>
      </div>

      <button type="submit" class="registerbtn" name="register" value="register">Register</button>
    </form>

     

    
     
      
    
  

    <h4 class="jumpto">Have an account? <a href="adminlogin.php">login</a></h4>

    </div>

  </div>
</html>
