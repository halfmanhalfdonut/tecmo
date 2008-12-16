<?php
	require_once('../adodb/adodb.inc.php');
	
	global $db;
	
	$db = NewADOConnection('mysql');
	//$db->Connect('p50mysql239.secureserver.net', 'opensource', 'Pr0g!(50UrC3).', 'opensource');
	//Connect($argHostname = "", $argUsername = "", $argPassword = "", $argDatabaseName = "", $forceNew = false) 
	//$db->Connect('localhost', 'opensource', 'Pr0g!(50UrC3).', 'opensource');
	$db->Connect('localhost', 'opensource', 'Pr0g!(50UrC3).', 'bowl_pick'); //sean
	$db->debug = true;
	
	
	
	
	
	require_once('Valid.php');
	require_once('Session.php');
	//require_once('User.php');
	
	//$user = new User($db);

?>