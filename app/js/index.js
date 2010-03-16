//validate forms
validate = function(formObj){
	//set form to the form's id
	var form = formObj.id;
	//store errors here
	var errors = '';
	
	//validate whichever form it is and add errors to error var if they exist
	if(form == 'loginForm'){
		//login form
		if($('usernameLogin').value.blank()){
			errors += 'Error - Username field is empty\n';
		}
		if($('password').value.blank()){
			errors += 'Error - Password field is empty\n';
		}
	}
	else{
		//create user form
		if($('email1').value.blank()){
			errors += 'Error - Email field is empty\n';
		}
		if($('email2').value.blank()){
			errors += 'Error - Confirm Email field is empty\n';
		}
		if(errors.empty()){
			//both email fields have values, now check that they are the same
			if(!($('email1').value == $('email2').value)){
				errors += 'Error - Emails do not match\n';
			}
			else{
				//both email fields are the same, now check that they are valid emails
				if(!isValidEmail($('email1').value)){
					errors += 'Error - Email is not a valid address\n';
				}
			}
		}
		if($('usernameCreate').value.blank()){
			errors += 'Error - Usename field is empty\n';
		}
		if($('password1').value.blank()){
			errors += 'Error - Password field is empty\n';
		}
		else{
			if(!($('password1').value === $('password2').value)){
				errors += 'Error - Passwords do not match\n';
			}
		}
		if($('password2').value.blank()){
			errors += 'Error - Confirm Password field is empty\n';
		}
	}
	
	//if errors var is empty then there are no errors
	if(errors.empty()){
		//submit
		return true;
	}
	else{
		//show errors
		alert(errors);
		
		//stop submission
		return false;
	}
}

//validate email function
isValidEmail = function(email) {
	return /^[^@]+@[^.]+(\.[^.]+)+$/.test(email);
}

//show the form that the user wants to see
toggleDisplay = function(toggleMe){
	if(toggleMe == 'login'){
		$('createUser').hide();
		$('login').show();
		$('notices').hide();
	}
	else{
		$('login').hide();
		$('createUser').show();
		$('notices').hide();
	}
}

//hide create user form when page loads
document.observe("dom:loaded", function() {
	//check if a particular form should be displayed when the page loads
	var form = $('showForm').value;
	
	//display the appropriate form
	if(!form.blank() && form == 'create'){
		$('login').hide();
	}
	else{
		$('createUser').hide();
	}
});