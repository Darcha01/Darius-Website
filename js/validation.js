// JavaScript Document
//Global variables
var elFirstName = document.getElementById('firstName');
var elLastName = document.getElementById('lastName');
var elEmail = document.getElementById('eMail');
var elPhoneNum = document.getElementById('phoneNum');
var elUsername = document.getElementById('userName');
var elPassword = document.getElementById('passWord');
var elComment = document.getElementById('cmtBox');

// Function to check user input
function checkName(minLength, elInput, elOutput, elGroup){ 
	console.log('elOutput: ' + elOutput); // Logs the value of our output el
	
	var elCheck = document.getElementById(elInput);
	var elOut = document.getElementById(elOutput);
	var elGroupDiv = document.getElementById(elGroup);
	
		if(!elCheck.value) { 
			// If name is null, "", undefined, false, 0, or NaN
			elOut.innerHTML = elInput +' cannot be empty';
			elGroupDiv.classList.add('has-error');
		}
		else if(elCheck.value.match(/[0-9]+/g)){
			// If name has numbers
			elOut.innerHTML = elInput +' cannot have numbers in it';
			elGroupDiv.classList.add('has-error');
		}
		else if(elCheck.value.length < minLength){
			// If name too short
			elOut.innerHTML = elInput +' must be ' + minLength + ' characters or more';
			elGroupDiv.classList.add('has-error');
		}
		else { 
			// Success
			elOut.innerHTML = '';
			elGroupDiv.classList.remove('has-error');
			elGroupDiv.classList.add('has-success');
		}
}

function checkEmail(email, elOutput, elGroup){
	console.log('elEmail: ' + elOutput); // Logs the value of our email el
	
	var validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var elEmChk = document.getElementById(email);
	var elOut = document.getElementById(elOutput);
	var elGroupDiv = document.getElementById(elGroup);
	
	if(elEmChk.value.match(validRegex)){
		//code to display valid email address was entered
		elOut.innerHTML = '';
		elGroupDiv.classList.remove('has-error');
		elGroupDiv.classList.add('has-success');
	}
	else{
		//invalid logic
		elOut.innerHTML = 'Email format is incorrect';
		elGroupDiv.classList.add('has-error');
	}
}

function checkPhoneNum(numLength, phoneNum, elOutput, elGroup){
	console.log('elPhoneNum: ' + elOutput); // Logs the value of our phone number el
	
	var elPNChk = document.getElementById(phoneNum);
	var elOut = document.getElementById(elOutput);
	var elGroupDiv = document.getElementById(elGroup);
	var numRegex = /[0-9]/;
	var count = (elPNChk.value.match(new RegExp(numRegex, "g")) || []).length; //counts the number of times a single number occurs in the user's input
	
	if(!elPNChk.value){
		// If phone number is null, "", undefined, false, 0, or NaN
		elOut.innerHTML =  'Phone Number cannot be empty';
		elGroupDiv.classList.add('has-error');
	}
	else if(elPNChk.value.match(/[-()]/g)){
		// If phone number has parenthesis or hyphens
		elOut.innerHTML =  'Phone Number cannot have parenthesis or hyphens';
		elGroupDiv.classList.add('has-error');
	}
	else if(count != numLength){
		// If phone number's not 10 digits
		elOut.innerHTML = 'Phone Number must be ' + numLength + ' characters exactly';
		elGroupDiv.classList.add('has-error');
	}
	else{
		// Success
		elOut.innerHTML = '';
		elGroupDiv.classList.remove('has-error');
		elGroupDiv.classList.add('has-success');
	}
}

function checkUserOrPass(minLength, elInput, elOutput, elGroup){
	console.log('elOutput: ' + elOutput); // Logs the value of our output el
	
	var elCheck = document.getElementById(elInput);
	var elOut = document.getElementById(elOutput);
	var elGroupDiv = document.getElementById(elGroup);
	
		if(!elCheck.value){ 
			// If input is null, "", undefined, false, 0, or NaN
			elOut.innerHTML = elInput +' cannot be empty';
			elGroupDiv.classList.add('has-error');
		}
		else if(elCheck.value.length < minLength){
			// If input too short
			elOut.innerHTML = elInput +' must be ' + minLength + ' characters or more';
			elGroupDiv.classList.add('has-error');
		}
		else { 
			// Success
			elOut.innerHTML = '';
			elGroupDiv.classList.remove('has-error');
			elGroupDiv.classList.add('has-success');
		}
}

function checkComment(comment, elOutput, elGroup){
	console.log('elOutput: ' + elOutput); // Logs the value of our comment el
	
	var elCmtCheck = document.getElementById(comment);
	var elOut = document.getElementById(elOutput);
	var elGroupDiv = document.getElementById(elGroup);
	
		if(!elCmtCheck.value){ 
			// If input is null, "", undefined, false, 0, or NaN
			elOut.innerHTML = 'Comment box cannot be empty';
			elGroupDiv.classList.add('has-error');
		}
		else { 
			// Success
			elOut.innerHTML = '';
			elGroupDiv.classList.remove('has-error');
			elGroupDiv.classList.add('has-success');
		}
}

elFirstName.addEventListener('blur', function(){checkName(2,'firstName', 'fnFeedBack', 'fnGroup');}, false);
elLastName.addEventListener('blur', function(){checkName(2,'lastName', 'lnFeedBack', 'lnGroup');}, false);
elEmail.addEventListener('blur', function(){checkEmail('eMail', 'emFeedBack', 'emGroup');}, false);
elPhoneNum.addEventListener('blur', function(){checkPhoneNum(10,'phoneNum', 'pnFeedBack', 'pnGroup');}, false);
elUsername.addEventListener('blur', function(){checkUserOrPass(6,'userName', 'usrFeedBack', 'usrGroup');}, false);
elPassword.addEventListener('blur', function(){checkUserOrPass(6,'passWord', 'pwFeedBack', 'pwGroup');}, false);
elComment.addEventListener('blur', function(){checkComment('cmtBox', 'cmtFeedBack', 'cmtGroup');}, false);

