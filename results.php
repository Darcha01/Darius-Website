<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Database Results Page</title>
<link href="assets/css/datatables.min.css" rel="stylesheet">
<script src="assets/js/jquery-3.5.1.js"></script>
<script src="assets/js/datatables.min.js"></script>
</head>
	
<div class="row school-intro">

	<div class="col-four">
		<h1 class="intro-header" data-aos="fade-up">Results</h1>
	</div>
	<div class="col-eight">
		<p class="lead" data-aos="fade-up">
			Here are the users that have filled out the contact form in the Contact section.
			This page is capable of displaying hundreds of users that have decided to share
			their identification details!
		</p>
	</div>            
</div>
<div class="panel panel-success section">
	<div class="panel-body">
		<div class="row">
			<div class="col-twelve">
				<table class="display" id="results" data-aos="fade-up">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>Username</th>
							<th>Password</th>
							<th>Comments</th>
						</tr>
					</thead>
					
					<tbody id="results_info">
						<?php
							include("query_contacts.php");
							if(isset($_GET['sid']) && $_GET['sid']!=""){
								$sid=$_GET['sid'];
								$sql="Select `auto_id` from `accounts` where `session_id`='$sid'";
								$result=$dblink->query($sql) or
									die("<h2>Something went wrong with: $sql<br>".$dblink->error."</h2>");
								if($result->num_rows<=0)//session id not found in db
									redirect("index.php?page=login&msg=InvalidSid");
							}
							else{
								redirect("index.php?page=login&msg=sidNotFound");
							}
						?>
					</table>
					</tbody>
			</div>
		</div>
	</div>
</div>
</html>
<script type="text/javascript">
	$('#results').DataTable();//same as document.getElementByID('results'); turn on datatables
	function refresh_data(){
		$.ajax({
			type: 'post',
			url: 'https://ec2-3-15-175-247.us-east-2.compute.amazonaws.com/hw16/query_contacts.php',
			success: function(data){
				$('#results_info').html(data);//write to current page
			}
		});
	}
	setInterval(function(){refresh_data();},1000);
</script>