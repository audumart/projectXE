<?php 


session_start();
	$page_title = "Services";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view3.php';

	


?>

<div class="wrapper">
		<div id="stream">
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
