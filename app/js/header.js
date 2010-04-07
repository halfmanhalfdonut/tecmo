(function($) {
	wambo.getData = function(val) {
		var handlerUrl = "requestHandler.php";
		$.ajax({
			url: handlerUrl,
			cache: false,
			data: { 'xdata': val },
			success: function(data) {
			if(val=='notices'){ 
				wambo.utils.log("Response data: " + data);
				$('#notices').html(data);
			}
			else{
				return data;
			}
			},
			error: function(xhr, status, e) {
				wambo.utils.log("Error: " + status + " - " + e);
			}
		});
	};
	
	$(document).ready(function() {
		wambo.userMenuToggle();
		$('#menu a').unbind('click').bind('click', function(e) {
			e.preventDefault();
			wambo.utils.log("Menu item: " + this.href);
			wambo.getData(this.id,'notices');
			return false;
		});
		
		$('#userMenu a').unbind('click').bind('click', function(e) {
			e.preventDefault();
			$('body').prepend('<div id="modalDialog"></div>');
			$('#modalDialog').load(this.id+'.php').dialog({modal: true, width: 400, height: 400});
			return false;
		});
	});
})(jQuery);