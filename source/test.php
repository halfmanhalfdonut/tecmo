<?php 
	include('inc/config.php');
	
	if (isset($_POST['create'])) {		
		$username 	= isset($_POST['username'])		? $_POST['username'] 	: false;
		$password	= isset($_POST['password'])		? $_POST['password'] 	: false;
		$email		= isset($_POST['email'])		? $_POST['email']		: false;
		$interests	= isset($_POST['interests'])	? $_POST['interests']	: "";
		
		echo $user->createNewUser($username, $password, $email, $interests);
	} else if (isset($_POST['check'])) {
		$username 	= isset($_POST['checkUsername'])		? $_POST['checkUsername'] 	: false;
		$password	= isset($_POST['checkPassword'])		? $_POST['checkPassword'] 	: false;
		
		echo $user->checkUserPass($username, $password);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>TEST</title>
	<style type="text/css">
		label {
			display: block;
		}
	</style>
</head>

<body>

<form id="user" name="user" method="post" action="test.php">
	<label>Username
	<input name="username" type="text" id="username" />
	</label>
	<label>Password
	<input name="password" type="password" id="password" />
	</label>
	<label>Email
	<input name="email" type="text" id="email" />
	</label>
	<label>Interests
	<textarea name="interests" id="interests"></textarea>
	</label>
	<input type="submit" name="create" value="Submit" />
</form>
<br />
<br />
<form id="login" name="login" method="post" action="test.php">
	<label>Username
	<input name="checkUsername" type="text" id="checkUsername" />
	<br />
	password
	<input name="checkPassword" type="password" id="checkPassword" />
	<br />
	<input name="check" type="submit" id="check" value="Submit" />
	</label>
</form>
<p>&nbsp;</p>
</body>
</html>
