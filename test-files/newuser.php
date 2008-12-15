<?php
	require_once('config.php');
	
	if ($_POST) {
		$name	= isset($_POST['name']) ? $_POST['name'] : false;
		
		if ($name) {
			$sql	= "INSERT INTO USERS(user_name,status) VALUES (?,?)";
			$values = array($name,1);
			$rs		= $db->Execute($sql,$values);
			
			$msg	= "Successfully Added $name";
		} else {
			$msg =  "Missing fields, please go back and fix them.";
		}
	}
?>

<html>
	<head>
		<title> Make New User </title>
	</head>
	
	<body>
		<?php if ($msg) { ?>
			<div style="color: green";><?php echo $msg; ?></div>
		<?php } ?>
		<form name="newuser" action="newuser.php" method="post">
			<h1>Create a new user</h1>
			<p>User Name: 
			  <input type="text" name="name" />
		  	</p>
			<p>
			  <label>
			  <input type="submit" value="Submit">
			  </label>    
			</p>
		</form>
	</body>
</html>