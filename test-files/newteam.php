<?php
	require_once('config.php');
	
	if ($_POST) {
		$name	= isset($_POST['name']) ? $_POST['name'] : false;
		
		if ($name) {
			$sql	= "INSERT INTO TEAMS(team_name) VALUES (?)";
			$values = array($name);
			$rs		= $db->Execute($sql,$values);
			
			$msg	= "Successfully Added $name";
		} else {
			$msg =  "Missing fields, please go back and fix them.";
		}
	}
?>

<html>
	<head>
		<title> Make New Team </title>
	</head>
	
	<body>
		<?php if ($msg) { ?>
			<div style="color: green";><?php echo $msg; ?></div>
		<?php } ?>
		<form name="newbowl" action="newteam.php" method="post">
			<h1>Create a new team</h1>
			<p>Team Name: 
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