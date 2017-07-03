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
 	':un' => $input['uname'],
 	':e' => $input['email'],
 	':h' => $hash

 	];

 	$stmt->execute($data);	
	}

	function doesEmailExist($dbconn, $email) {
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE 	email=:e");
		# bind params
		$stmt->bindParam(":e", $email);
		$stmt->execute();

		# get number of rows returned
		$count = $stmt->rowCount();

		if ($count > 0) {
			$result = true;
		}

		return $result;

	}

function doesUsernameExist($dbconn, $uname) {
		$result = false;

		$stmt = $dbconn->prepare("SELECT username FROM admin WHERE 	username=:un");
		# bind params
		$stmt->bindParam(":un", $uname);
		$stmt->execute();

		# get number of rows returned
		$count = $stmt->rowCount();

		if ($count > 0) {
			$result = true;
		}

		return $result;

	}

	function displayErrors($open, $name){
		$result = "";

		if (isset($open[$name])) {
			
			$result = '<span class="err">'.$open[$name].'</span>';
		}

		return $result;
	}
