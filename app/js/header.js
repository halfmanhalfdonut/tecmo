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
				if(val!='userMenu'){ 
					wambo.utils.log("Response data: " + data);
					$('#notices').html(data);
				}
				else
					alert("HELP ME GET RETURNED: "+data);
			},
			error: function(xhr, status, e) {
				wambo.utils.log("Error: " + status + " - " + e);
			}
			
		});
	};
	//show the form that the user wants to see/////////////////////////////////
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
	
	//Add juice to the retro engines////////////////////////////////////////////
	userMenuToggle = function(){
		$('#userMenuIn').hide();
		var inOut = wambo.getData('userMenu');
		$('#notices').html("user logged in: "+ inOut);
		if(inOut=='true'){
			$('#userMenuIn').show();
			$('#userMenu').hide();
		}
		else{
			$('#userMenuIn').hide();
			$('#userMenu').show();
		}
	}
	
	$(document).ready(function() {
		userMenuToggle();
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