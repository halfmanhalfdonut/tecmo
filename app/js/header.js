(function($) {
	//AJAX ////////////////////////////////////////////////////////////
	wambo.getData = function(val) {
		var handlerUrl = "requestHandler.php";
		var returnData =""
		$.ajax({
			url: handlerUrl,
			cache: false,
			data: { 'xdata': val },
			success: function(data) {
				if(val!=='userMenu'){ 
					wambo.utils.log("Response data: " + data);
					$('#notices').html(data);
				}
				else
					wambo.utils.log("value: " + val);
					wambo.utils.log("data: " + data);
					return data;
			},
			error: function(xhr, status, e) {
				wambo.utils.log("Error: " + status + " - " + e);
			}
			
		});
	};
	
	$(document).ready(function() {
		wambo.utils.log("User logged in? " + user.loggedIn);
		wambo.utils.log("User name: " + user.name);
		$('#menu a').unbind('click').bind('click', function(e) {
			e.preventDefault();
			wambo.utils.log("Menu item: " + this.href);
			wambo.getData(this.id,'notices');
			return false;
		});
		
		$('#userMenu a').unbind('click').bind('click', function(e) {
			e.preventDefault();
			$('body').prepend('<div id="modalDialog"></div>');
			$('#modalDialog').load(this.href + '?fetch=true').dialog({modal: true, width: 400, height: 400});
			return false;
		});
	});
})(jQuery);