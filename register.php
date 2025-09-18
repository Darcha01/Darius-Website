<div class="row school-intro">

	<div class="col-four">
		<h1 class="intro-header" data-aos="fade-up">Register</h1>
	</div>
	<div class="col-eight">
		<p class="lead" data-aos="fade-up">
			Create a unique username and password.
		</p>
	</div>            
</div>
<div class="panel panel-success section">
	<div class="panel-body">
		<div class="row">
			<div class="col-twelve">
				<table class="display" id="register" data-aos="fade-up">
					<?php
						echo '<form method="post" action="">';
						renderInputBlock("usrRGST", "Username", "userName", "userName");
						renderInputBlock("pwRGST", "Password", "passWord", "passWord");
						echo '<hr>';
						echo '<button class="btn btn-success" type="submit" name="submit" value="submit">Register</button>';
						echo '</form>';
					
					if(isset($_POST['submit']) && $_POST['submit']=="submit"){
						$userName=$_POST['userName'];
						$pw=$_POST['passWord'];
						$salt="CS4413SU25";//salting string
						$errors="";//blank errors variable
							
						$errors.=checkNull($userName, "usrRGST");	//if username is blank
						$errors.=checkNull($pw, "pwRGST");	//if password is blank

						$errors.=checkLength($userName, "usrRGST"); //if the length is too short
						$errors.=checkLength($pw, "pwRGST"); 	//if the length is too short

						$_SESSION['usrRGSTData']=$userName;
						$_SESSION['pwRGSTData']=$pw;

						if($errors!=""){	//if errors has been updated,redirect with the error string
							redirect("index.php?page=register&error=$errors");
						}
						else{
							$dblink=db_connect("contact_data");
							$pw_hash=hash('sha256', $salt.$pw.$userName);
							$sql="Select `auto_id` from `accounts` where `username`='$userName'";
							$result=$dblink->query($sql) or
								die("<h2>Something went wrong with: $sql<br>".$dblink->error."</h2>");
							
							if($result->num_rows>0)//if a row is returned -> username is not unique
								redirect("index.php?page=register&error=usrRGSTNotUnique"); //hardcoded for now, make dynamic later
							else{
								$sql="Insert into `accounts` (`username`, `pw_hash`) values ('$userName', '$pw_hash')";
								$dblink->query($sql) or
									die("<h2>Something went wrong with: $sql<br>".$dblink->error."</h2>");
								session_unset();//clear session data if used
								redirect("index.php?page=login&msg=AccountCreateSuccess");
							}
						}
					}
					?>
				</table>	
			</div>
		</div>
	</div>
</div>