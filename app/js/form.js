//validate forms
wambo.validate = function(formObj){
	//set form to the form's id
	var form = formObj.id;
	//store errors here
	var errors = '';
	
	//validate whichever form it is and add errors to error var if they exist
	if(form == 'loginForm'){
		//login form
		if(form.usernameLogin===""){
			errors += 'Error - Username field is empty\n';
		}
		if(form.password===""){
			errors += 'Error - Password field is empty\n';
		}
	}
	else{
		//create user form
		if(wambo.utils.trim(form.email1.value) === ""){
			errors += 'Error - Email field is empty\n';
		}
		if(form.email2.value===""){
			errors += 'Error - Confirm Email field is empty\n';
		}
		if(errors===""){
			//both email fields have values, now check that they are the same
			if(!(form.email1.value == form.email2.value)){
				errors += 'Error - Emails do not match\n';
			}
			else{
				//both email fields are the same, now check that they are valid emails
				if(!wambo.utils.isValidEmail(form.email1.value)){
					errors += 'Error - Email is not a valid address\n';
				}
			}
		}
		if(form.usernameCreate.value===""){
			errors += 'Error - Usename field is empty\n';
		}
		if(form.password1.value===""){
			errors += 'Error - Password field is empty\n';
		}
		else{
			if(!(form.password1.value === form.password2.value)){
				errors += 'Error - Passwords do not match\n';
			}
		}
		if(form.password2.value===""){
			errors += 'Error - Confirm Password field is empty\n';
		}
	}
	
	//if errors var is empty then there are no errors
	if(errors===""){
		//submit
		wambo.utils.log($('#'+form).attr('action'));
		$.ajax({
			url: $('#'+form).attr('action'),
			type: 'post',
			cache: false,
			data: $('#'+form).serialize(),
			success: function(data) {
				wambo.user.login(data);
			},
			error: function(xhr, status, e) {
				wambo.utils.log("Error: " + status + " - " + e);
			}
		});
		return false;
	}
	else{
		//show errors
		alert(errors);
		
		//stop submission
		return false;
	}
}