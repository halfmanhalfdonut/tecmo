wambo.user = {};
wambo.user.login = function(data) {
	wambo.utils.log(data);
	var obj = eval(data);
	if (typeof obj.errors === 'undefined' || !obj.errors) {
		user = obj;
		wambo.utils.log(user.loggedIn);
		wambo.utils.log(user.name);
		
		$('.displayUsername').html(user.name);
		$('#userMenuIn').show();
		$('#userMenu').hide();
		$('#modalDialog').dialog('close');
	} else {
		var errorDiv = $('<div id="errors">'+obj.errors+'</div>');
		$('#modalDialog').prepend(errorDiv);
	}
};