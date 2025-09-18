<div class="row school-intro">

	<div class="col-four">
		<h1 class="intro-header" data-aos="fade-up">Login</h1>
	</div>
	<div class="col-eight">
		<p class="lead" data-aos="fade-up">
			Here is where you can login to your account.
			If you don't have an account, you can set one
			up using the "Register" feature! You must
			login to view the "Results" page.
		</p>
	</div>            
</div>
<div class="panel panel-success section">
	<div class="panel-body">
		<div class="row">
			<div class="col-twelve">
				<table class="display" id="login" data-aos="fade-up">
					<?php
						if (isset($_GET['msg'])) {
							switch ($_GET['msg']) {
								case "AccountCreateSuccess":
									echo '<div class="alert alert-success">Your Account Has Been Created Successfully!</div>';
									echo '<hr>';
									break;

								case "Invalid":
									echo '<div class="alert alert-danger">Invalid Credentials Provided!</div>';
									echo '<hr>';
									break;
									
								case "InvalidSid":
									echo '<div class="alert alert-danger">Invalid Session ID!</div>';
									echo '<hr>';
									break;

								case "sidNotFound":
									echo '<div class="alert alert-danger">Session ID could not be found!</div>';
									echo '<hr>';
									break;
							}
						}
						echo '<form method="post" action="">';
						renderInputBlock("usrLGN", "Username", "userName", "userName");
						renderInputBlock("pwLGN", "Password", "passWord", "passWord");
						echo '<hr>';
						echo '<button class="btn btn-success" type="submit" name="submit" value="submit">Login</button>';
						echo '<hr>';
						echo '<a href="index.php?page=register" class="btn btn-info" type="submit" name="submit" value="submit">Register</a>';
						echo '</form>';
					
						if(isset($_POST['submit']) && $_POST['submit']=="submit"){
							//get input and validate
							$userName=$_POST['userName'];
							$pw=$_POST['passWord'];
							
							$_SESSION['usrLGNData']=$userName;
							
							$salt="CS4413SU25";//salting string
							$pw_hash=hash('sha256', $salt.$pw.$userName);
							$dblink=db_connect("contact_data");
							$sql="Select `auto_id` from `accounts` where `pw_hash`='$pw_hash'";
							$result=$dblink->query($sql) or
								die("<h2>Something went wrong with: $sql<br>".$dblink->error."</h2>");
							if($result->num_rows<=0)//no rows returned -> invalid creds provided
								redirect("index.php?page=login&msg=Invalid");
							else{	//valid creds provided
								$info=$result->fetch_array(MYSQLI_ASSOC);
								$salt=microtime();//get unix timestamp in microsecondse
								$sid=hash('sha256',$salt.$pwHash);
								$sql="Update `accounts` set `session_id`='$sid' where `auto_id`='$info[auto_id]'";
								$dblink->query($sql) or
									die("<h2>Something went wrong with: $sql<br>".$dblink->error."</h2>");
								session_unset();//clear session data if used
								redirect("index.php?page=results&sid=$sid");
							}
							
						}
					?>
				</table>	
			</div>
		</div>
	</div>
</div>