<?php 


session_start();
	$page_title = "Team Members";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view2.php';

	$errors = [];

	
	if (array_key_exists('edit', $_POST)) {
		$clean = array_map('trim', $_POST);
		editTeamMember($conn, $clean);
	}
	if (isset($_GET['success'])) {
		echo $_GET['success'];
	} 

	?>

	<div class="wrapper">
		<div id="stream">
			<p> 
		<?php

		if (isset($_GET['action'])) {
			if ($_GET['action'] = "edit") {
				
			
		



		?>
		<h3>Edit Member Details</h3>
			<form id="register" method="POST" action="members.php">
				<input type="text" name="member_name" placeholder="Member Name" value="<?php echo $_GET['member_name'];   ?>" />
				<input type="hidden" name="member_id" value="<?php echo $_GET['member_id'];  ?>">
				<input type="submit" name="edit" value="Edit">
			</form>
			<?php
		}
	}

	if (isset($_GET['act'])) {
		if ($_GET['act'] = "delete") {
			deleteTeamMember($conn, $_GET['member_id']);

		}
	}

			?>
			</p>
<h3>Current new members</h3>
	<table id="tab">
		<thead>
			<tr>
				
				<th>Name</th>
				<th>Number</th>
				<th>Email address</th>
				<th>Service</th>
				<th>picture</th>
				<th>edit member</th>
				<th>remove member</th>
			</tr>
		</thead>
		<tbody>
			<?php  $view = showTeamMember($conn); echo $view; ?>
		</tbody>
	</table>
		
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
