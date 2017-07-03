<?php

	function doAdminRegister($dbconn, $input){
	# hash the password
	$hash = password_hash($input['password'], PASSWORD_BCRYPT);

	#insert data
	$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, username, email, hash) VALUES(:fn, :ln, :un, :e, :h)");
 	# bind params
 	$data = [

 	':fn' => $input['fname'],
 	':ln' => $input['lname'],
 	':ln' => $input['uname'],
 	':e' => $input['email'],
 	':h' => $hash

 	];

 	$stmt->execute($data);	
	}