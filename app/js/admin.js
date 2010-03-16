toggleWarning = function(){
	
	//IE workaround
	//part prototype part regular JS because IE doesn't like prototype
	if($('resetDbsField').className=='resetDbsField'){
		$('resetDbsField').className='resetDbsFieldCaution';
		$('resetButton').setStyle({'color': 'red'});
		alert('Reseting a table with delete ALL table data, proceed with caution!');
	}
	else{
		$('resetDbsField').className='resetDbsField';
		$('resetButton').setStyle({'color': 'black'});
	}
}