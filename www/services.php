<?php
	
	session_start();
	$page_title = "Services";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';

	$errors = [];

	if (array_key_exists('enter', $_POST)) {
		$clean = array_map('trim', $_POST);
		insertService($conn, $clean);
		}
	if (array_key_exists('edit', $_POST)) {
		$clean = array_map('trim', $_POST);
		editService($conn, $clean);
	}
	if (isset($_GET['success'])) {
		echo $_GET['success'];
	}
?>
<div class="wrapper">
		<div id="stream"><br/><br/>
		<p> 
		<?php

		if (isset($_GET['action'])) {
			if ($_GET['action'] = "edit") {
				
			
		



		?>
		<h3>Edit Service</h3>
			<form id="register" method="POST" action="services.php">
				<input type="text" name="service_name" placeholder="Service Name" value="<?php echo $_GET['service_name'];   ?>" />
				<input type="hidden" name="service_id" value="<?php echo $_GET['service_id'];  ?>">
				<input type="submit" name="edit" value="Edit">
			</form>
			<?php
		}
	}

	if (isset($_GET['act'])) {
		if ($_GET['act'] = "delete") {
			deleteService($conn, $_GET['service_id']);

		}
	}

			?>
		<h3>Add Service</h3>
		<form id="register" method="POST" action="services.php">
			<input type="text" name="service" placeholder="Service Name" />
			<input type="submit" name="enter" value="Add">
		</form>
		</p>
	<hr>
	<h3>Available Services</h3>
	<table id="tab">
		<thead>
			<tr>
				<th>Service ID</th>
				<th>Service Name</th>
				<th>edit</th>
				<th>delete</th>
			</tr>
		</thead>
		<tbody>
			<?php  $view = showService($conn); echo $view; ?>
		</tbody>
	</table>
		
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			
		</div>
	</div>


</body>
</html>