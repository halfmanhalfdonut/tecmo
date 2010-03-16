checkForm = function(){
	var file = $('file').value;
	
	//store errors here
	var errors = '';
	
	//check that there is something in the file select area
	if(!file.blank()){
		
		var validExtensions = new Array();
		
		validExtensions[0]= 'nst';
		validExtensions[1]= 'ns1';
		validExtensions[2]= 'ns2';
		validExtensions[3]= 'ns3';
		validExtensions[4]= 'ns4';
		validExtensions[5]= 'ns5';
		validExtensions[6]= 'ns6';
		validExtensions[7]= 'ns7';
		validExtensions[8]= 'ns8';
		validExtensions[9]= 'ns9';
		validExtensions[10]= 'ns0';
		
		//check that the file ends with a valid extension
		var extensionValid = false;
		for ( extension in validExtensions ) {
		   if(file.toLowerCase().endsWith('.' + validExtensions[extension])){
				extensionValid = true;
				break;
			}
		}
		
		//if an invalid extension, add to the error message
		if(!extensionValid){
			errors += 'Error - File does not have a valid Nestopia extension (ex: .nst, .ns0, .ns9)\n';
		}
	}
	else{
		//file select area is empty
		errors += 'Error - You must select a file to upload\n';
	}
	
	//check if user selected which team they were
	if($('homeAway').value == 'none'){
		errors += 'Error - Please select if you were the home or away team\n';
	}
	
	//check if user selected which user they played against
	if($('against').value == 'none'){
		errors += 'Error - Please select which user you played against\n';
	}
	
	if(errors.blank()){
		//everything checks out so far, submit form
		document.forms['fileUpload'].submit();
	}
	else{
		//show errors
		alert(errors);
	}
}

document.observe("dom:loaded", function() {
	if($('uploadSuccess').value){
		//show stats div
		$('gameStats').show();
	}
	else{
		//hide stats div
		$('gameStats').hide();
	}
});