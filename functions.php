<?php
	function redirect($url){?>
		<script type="text/javascript">
			document.location.href="<?php echo $url;?>";
		</script>
	<?php die;
	} 
	
	//function to read user input and spit out the correct div
	function renderInputBlock($inputType, $labelText, $inputId, $inputName) {
		$error = isset($_GET['error']) ? $_GET['error'] : ""; //Check $_GET['error'] for any error related to the input type
		$sessionKey = $inputType."Data";
		$value = isset($_SESSION[$sessionKey]) ? htmlspecialchars($_SESSION[$sessionKey]) : ""; //Use $_SESSION to repopulate the field if needed
		$hasError = false;
		$feedbackMsg = "";

		//Output the proper <div> with the correct class, value, and error message
		if ($error !== "") {
			if (strstr($error, $inputType."Null")) {
				$hasError = true;
				$feedbackMsg = $labelText." cannot be blank!";
				$value = ""; // clear the field if null
			}
			else if (strstr($error, $inputType."InvalidChars") && $inputType=="pn") {
				$hasError = true;
				$feedbackMsg = $labelText." can only contain numbers! No hyphens or parentheses.";
			}
			else if (strstr($error, $inputType."InvalidChars") && $inputType!="pn") {
				$hasError = true;
				$feedbackMsg = $labelText." can only contain alphabet characters, hyphens, and/or apostrophes!";
			}
			else if (strstr($error, $inputType."InvalidLength") && $inputType=="pn") {
				$hasError = true;
				$feedbackMsg = $labelText." length must be 10 digits!";
			}
			else if (strstr($error, $inputType."InvalidLength") && $inputType!="pn") {
				$hasError = true;
				$feedbackMsg = $labelText." length is too short!";
			}
			else if (strstr($error, $inputType."Invalid")) { // for general format errors like email
				$hasError = true;
				$feedbackMsg = $labelText." cannot be recognized!";
			}
			else if(strstr($error, $inputType."NotUnique")) { //for registering an acc
				$hasError = true;
				$feedbackMsg = $labelText." is already taken!";
			}
		}

		$groupClass = $hasError ? "form-group has-error" : "form-group";
		$feedbackId = $inputType."FeedBack";
		$groupId = $inputType."Group";

		echo "<div id=\"$groupId\" class=\"$groupClass\">";
		echo "<label class=\"control-label\">$labelText: </label>";
		echo "<input type=\"text\" class=\"form-control\" id=\"$inputId\" name=\"$inputName\" value=\"$value\">";
		echo "<span id=\"$feedbackId\" class=\"help-block\">$feedbackMsg</span>";
		echo "</div>";
	}

	//function to check for null values
	function checkNull($value, $inputType){
		if($value=="")
			return $inputType."Null_";
	}
	
	//function to check for invalid characters such as:
	//non-alphabet chars (except hyphens/apostrophes) and non-numbers (for phone#)
	function checkInvalid($value, $inputType){
		$namePattern = "/^[a-zA-Z\-\/'\\\\]+$/";
		if(!preg_match($namePattern,$value) && ($inputType=="fn" || $inputType=="ln")){
			return $inputType."InvalidChars_";
		}
		else if(!ctype_digit($value) && $inputType=="pn"){
			return $inputType."InvalidChars_";
		}
	}
	
	//function to check email params
	function checkEmail($value, $inputType){
		$emailPattern = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
		if(!preg_match($emailPattern, $value)){
			return $inputType."Invalid_";
		}
	}

	//function to check param length
	function checkLength($value, $inputType){
		switch ($inputType) {
			case "fn":
			case "ln":
				if (strlen($value) < 2)
					return $inputType."InvalidLength_";
				break;
			case "pn":
				if (strlen($value) != 10)
					return $inputType."InvalidLength_";
				break;
			case "usr":
			case "pw":
			case "usrRGST":
			case "pwRGST":
				if (strlen($value) < 6)
					return $inputType."InvalidLength_";
				break;
		}
		return "";
	}

	function db_connect($db){
		$dbUser="web_user";
		$dbPassword="Chec-oyBNf-eHcND";
		$host="localhost";//connect to internal database (never do this real world btw)
		$dblink=new mysqli($host,$dbUser,$dbPassword,$db);
		return $dblink;
	}
?>