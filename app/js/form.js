//validate forms
wambo.validate = function(formObj){
	$('#errors').html('');
	//set form to the form's id
	var form = formObj.id;
	//store errors here
	var errors = '';
	
	//validate whichever form it is and add errors to error var if they exist
	if(form == 'loginForm'){
		//login form
		if($('#usernameLogin').value === ""){
			errors += 'Error - Username field is empty\n';
		}
		if($('#password').value === ""){
			errors += 'Error - Password field is empty\n';
		}
	} else {
		var email1 = $('#email1').val();
		var email2 = $('#email2').val();
		var username = $('#usernameCreate').val();
		var password1 = $('#password1').val();
		var password2 = $('#password2').val();
		//create user form
		if(wambo.utils.trim(email1) === ""){
			errors += 'Error - Email field is empty\n';
		}
		if(wambo.utils.trim(email2) === ""){
			errors += 'Error - Confirm Email field is empty\n';
		}
		if(errors === ""){
			//both email fields have values, now check that they are the same
			if(!(email1 == email2)){
				errors += 'Error - Emails do not match\n';
			}
			else{
				//both email fields are the same, now check that they are valid emails
				if(!wambo.utils.isValidEmail(email1)){
					errors += 'Error - Email is not a valid address\n';
				}
			}
		}
		if(username === ""){
			errors += 'Error - Usename field is empty\n';
		}
		if(password1 === ""){
			errors += 'Error - Password field is empty\n';
		} else{
			if(!(password1 === password2)){
				errors += 'Error - Passwords do not match\n';
			}
		}
		if(password2 === ""){
			errors += 'Error - Confirm Password field is empty\n';
		}
	}
	
	//if errors var is empty then there are no errors
	if(errors === ""){
		//submit
		wambo.utils.log($('#'+form).attr('action'));
		$.ajax({
			url: $('#'+form).attr('action'),
			type: 'post',
			cache: false,
			data: $('#'+form).serialize(),
			success: function(data) {
				wambo.utils.log($('#'+form).serialize());
				wambo.user.login(data);
			},
			error: function(xhr, status, e) {
				wambo.utils.log("Error: " + status + " - " + e);
			}
		});
		return false;
	} else {
		//show errors
		if ($('#errors').length == 0) {
			var errorDiv = $('<div id="errors">'+errors+'</div>');
			$('#modalDialog').prepend(errorDiv);
		} else {
			$('#errors').html(errors);
		}
		
		//stop submission
		return false;
	}
}