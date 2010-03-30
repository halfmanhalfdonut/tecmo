/* Global wambo namespace */
if (typeof wambo == "undefined" || !wambo) {
	var wambo = {};
}
wambo.dev = (window.location.hostname.indexOf("localhost") >= 0 || window.location.hostname.indexOf("local.geared.us") > 0);
wambo.live = !wambo.dev;
wambo.debug = wambo.dev && window && typeof window.console !== "undefined";
wambo.namespace = function (nodes,root) {
	root = root == null ? wambo : root;
	var a = nodes, o = null, i, j, d;
	d = nodes.split(".");
	o = root;
	for(j = (d[0] == root) ? 1 : 0; j < d.length; j++){
		o[d[j]] = o[d[j]] || {};
		o = o[d[j]];
	}
	return o;
};
wambo.namespace("utils",wambo);
wambo.utils.trim = function(str){
	return str == null ? "" : str.replace(/^\s+|\s+$/g,"");
};

wambo.utils.log = function() {
	if(!wambo.debug) { return; }
	if(window.console && typeof window.console.debug !== "undefined") {
		window.console.debug.apply(window.console,arguments);
	} else {
		if(window.console && typeof window.console.log !== "undefined") {
			if(window.console.log.apply === "function") {
				window.console.log.apply(window.console,arguments);
			} else {
				window.console.log(arguments[0]);
			}
		}
	}
};

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
		if(errors.empty()){
			//both email fields have values, now check that they are the same
			if(!(form.email1.value == form.email2.value)){
				errors += 'Error - Emails do not match\n';
			}
			else{
				//both email fields are the same, now check that they are valid emails
				if(!isValidEmail(form.email1.value)){
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

/*
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
});*/