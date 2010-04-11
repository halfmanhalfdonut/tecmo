wambo.user = {};
wambo.user.login = function(data) {
	wambo.utils.log(data);
	user = eval(data);
	wambo.utils.log(user.loggedIn);
	wambo.utils.log(user.name);
	
	$('.displayUsername').html(user.name);
	$('#userMenuIn').show();
	$('#userMenu').hide();
	$('#modalDialog').dialog('close');
};