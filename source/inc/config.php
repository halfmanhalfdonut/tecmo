<?php
	include('../adodb/adodb.inc.php');
		
	$db = NewADOConnection('mysql');
	//$db->Connect('p50mysql239.secureserver.net', 'opensource', 'Pr0g!(50UrC3).', 'opensource');
	$db->Connect('localhost', 'opensource', 'Pr0g!(50UrC3).', 'opensource');
	$db->debug = true;
	
	include('Valid.php');
	include('Session.php');
	include('User.php');
	
	$user = new User($db);

?>