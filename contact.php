<div class="row school-intro">

	<div class="col-four">
		<h1 class="intro-header" data-aos="fade-up">Contact Info</h1>
	</div>
	<div class="col-eight">
		<p class="lead" data-aos="fade-up">
			Here are some useful links where you can contact me or see some of the works I have created.
			Fill out the form below that by entering your information!
		</p>
	</div>            
</div>
<div class="panel panel-success section">
	<div class="panel-body">
		<div class="row">
			<div class="col-six">
				<p class="lead" data-aos="fade-up">School Email: darius.chavez@my.utsa.edu
				<br/>Personal Email: dariuschavez10@yahoo.com
				<br/>LinkedIn: <a href=https://www.linkedin.com/in/darius-chavez-161436264/ target="_blank">Darius Chavez</a>
				<br/>Github: <a href=https://github.com/Darcha01 target="_blank">Darcha01</a>
				<br/></p>
			</div>
		</div>
	</div>
</div>
<div class="row school-intro">
	<div class="col-four">
		<h1 class="intro-header">Contact Form</h1>
	</div>
	<?php
		if (isset($_GET['error']) && $_GET['error'] == "submitNull"){
			echo '<div class="col-eight alert alert-danger">Submit was Null!</div>';
		}
		if (isset($_GET['error']) && $_GET['error'] == "Success"){
			echo '<div class="col-eight alert alert-success">Your Response Has Been Submitted!</div>';
		}
	?>
	<form action="" method="post">
	<div class="col-eight">
		<?php
		renderInputBlock("fn", "First Name", "firstName", "firstName");
		renderInputBlock("ln", "Last Name", "lastName", "lastName");
		renderInputBlock("em", "Email Address", "eMail", "eMail");
		renderInputBlock("pn", "Phone Number", "phoneNum", "phoneNum");
		renderInputBlock("usr", "Username", "userName", "userName");
		renderInputBlock("pw", "Password", "passWord", "passWord");
		renderInputBlock("cmt", "Comments", "cmtBox", "cmtBox");
	?>
	<hr>
		<button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
	</form>
</div>
		
	
<?php
	//condition to execute code
	if(isset($_POST['submit']) && $_POST['submit']=="submit"){
		//start validating our post data
		$firstName=addslashes($_POST['firstName']);
		$lastName=addslashes($_POST['lastName']);
		$email=$_POST['eMail'];
		$phoneNum=$_POST['phoneNum'];
		$username=$_POST['userName'];
		$password=$_POST['passWord'];
		$comment=addslashes($_POST['cmtBox']);
		$errors="";//blank errors variable
		
		$errors.=checkNull($firstName, "fn");	//if first name is blank
		$errors.=checkNull($lastName, "ln");	//if last name is blank
		$errors.=checkNull($email, "em");		//if email is blank
		$errors.=checkNull($phoneNum, "pn");	//if phone num is blank
		$errors.=checkNull($username, "usr");	//if username is blank
		$errors.=checkNull($password, "pw");	//if password is blank
		$errors.=checkNull($comment, "cmt");	//if comments are blank
		
		$errors.=checkLength($firstName,"fn"); 	//if the length is too short
		$errors.=checkLength($lastName,"ln"); 	//if the length is too short
		$errors.=checkLength($phoneNum, "pn"); 	//if the length is too short
		$errors.=checkLength($username, "usr"); //if the length is too short
		$errors.=checkLength($password, "pw"); 	//if the length is too short
		
		$errors.=checkInvalid($firstName, "fn");//if there are any non alphabet characters
		$errors.=checkInvalid($lastName, "ln");
		$errors.=checkEmail($email, "em");		//if email is not in correct format
		$errors.=checkInvalid($phoneNum, "pn"); //if phone number has non number characters
		
		
		$_SESSION['fnData']=$firstName;
		$_SESSION['lnData']=$lastName;
		$_SESSION['emData']=$email;
		$_SESSION['pnData']=$phoneNum;
		$_SESSION['usrData']=$username;
		$_SESSION['pwData']=$password;
		$_SESSION['cmtData']=$comment;
		
		if($errors!=""){	//if errors has been updated,redirect with the error string
			redirect("index.php?page=contact&error=$errors");
		}
		else{	//else, redirect with success code
			//create my connection string
			$dblink=db_connect("contact_data");
			$sql="Insert into `contact_info` (`first_name`,`last_name`,`email`,`phone_number`,`user_name`,`password`,`comments`) 
			values ('$firstName','$lastName','$email','$phoneNum','$username','$password','$comment')";
			$dblink->query($sql) or
				die("<p>Something went wrong with: <br>$sql</p>".$dblink->error); //log errors and activate notis based on err severity
			
			// Clear session data if used (optional)
			session_unset();
			//redirect with success flag
			redirect("index.php?page=contact&error=Success");
		}
		
	}
?>
