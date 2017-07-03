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

	function adminLogin ($dbconn, $enter){

		# prepared statement
		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");

		#bind params
		$stmt->bindParam(":e", $enter['email']);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$count = $stmt->rowCount();

		if ($count !== 1 || !password_verify($enter['password'], $row['hash'])) {

			$result[] = false;	
		} else{
			$result[] = true;
			$result[] = $row;
		}
		return $result;
	}

	function redirect($loca){
		header("Location: " .$loca);
	}

	function addTeamMember($dbconn, $add){
		define('MAX_FILE_SIZE', '2097152');

		$ext = ["image/jpg", "image/jpeg", "image/png"];

		$rnd = rand(0000000000, 9999999999);

		$strip_name = str_replace(" ", " _ ", $_FILES['member']['name']);

		$filename = $rnd.$strip_name;
		$destination = 'uploads/'.$filename;

			if (array_key_exists('save', $_POST)) {

				$errors = [];

			
			if (empty($_FILES['member']['name'])) {
				$errors[] = "Please choose a file";
			}

		if ($_FILES['member']['size'] > MAX_FILE_SIZE ) {
			$errors[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
		}
		if (!in_array($_FILES['member']['type'], $ext)) {
			$errors[] = "invalid file type";
		}
		if (empty($errors)) {
			if (!move_uploaded_file($_FILES['member']['tmp_name'], $destination)) {
				$errors[] = "file upload failed";
			}
		echo "done";
		}
		else{
			foreach ($errors as $err) {
				echo $err. '</br>';
			}
		}
	}
		

		

		$stmt = $dbconn->prepare("INSERT INTO team(member_name, member_number, member_service, member_email, file_path)
											VALUES(:mn, :mnu, :ms, :me, :fi)");
		$stmt->bindParam(':mn', $add['member_name']);
		$stmt->bindParam(':mnu', $add['member_number']);
		$stmt->bindParam(':mnu', $add['member_service']);
		$stmt->bindParam(':mnu', $add['member_email']);
		$stmt->bindParam(':fi',$destination);
		$stmt->execute();
		$data = [
			'mn' => $add['member_name'],
			':mnu' => $add['member_number'],
			':ms' => $add['member_service'],
			':pr' => $add['member_email'],
			':fi' => $destination

				];

			$stmt->execute($data);
	}
