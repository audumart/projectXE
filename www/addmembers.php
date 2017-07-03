<?php

	session_start();




	$page_title = "Add Team members";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';

	$errors = [];

	if (array_key_exists('save', $_POST)) {

		
		if (empty($_POST['title'])) {
			$errors['title'] = "Enter Book Title";
		}
		if (empty($_POST['author'])) {
			$errors['author'] = "Enter Book Author(s)";
		}
		if (empty($_POST['price'])) {
			$errors['price'] = "Enter Book Price";
		}
		if (empty($_POST['year'])) {
			$errors['year'] = "Enter Year of Publication";
		}
		
		if (empty($errors)) {
			$clean = array_map('trim', $_POST);

			addProduct($conn, $clean);
		}
	}



?>


<div class="wrapper">
		<div id="stream">
			<form id="register" method="POST" enctype="multipart/form-data">
				<p>Choose picture</p>
				<div>
					<input type="file" name="member">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'member_name');
			echo $display;
			?>
					
					<input type="text" name="member_name" placeholder="Enter Full name">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'member_number');
			echo $display;
			?>
					
					<input type="text" name="member_number" placeholder="Enter Contact phone number">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'member_service');
			echo $display;
			?>
					
					<input type="text" name="member_service" placeholder="Enter service rendered">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'member_email');
			echo $display;
			?>
					
					<input type="text" name="member_email" placeholder="Enter email address">
				</div>

				

				<input type="submit" name="save" value="Add to team">
			</form>
		</div>
	</div>

