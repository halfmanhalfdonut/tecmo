<?php
	
	require_once('classes/Main.php');
	
	//log user out by deleting session variables
	session_destroy();
	
	//redirect error messages
	$message = '';
	if($_GET['message']){
		$message = '?message='.$_GET['message'];
	}
	
	//send user back to login page
	header('Location: index.php'.$message);
?>