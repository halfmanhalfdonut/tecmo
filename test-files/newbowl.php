<?php
	require_once('config.php');
	
	if ($_POST) {
		$game	= isset($_POST['game']) ? $_POST['game'] : false;
		$home	= isset($_POST['home']) ? $_POST['home'] : false;
		$away	= isset($_POST['away']) ? $_POST['away'] : false;
		
		if ($game && $home && $away) {
			$sql	= "INSERT INTO GAMES(game_name,home_id,away_id) VALUES (?,?,?)";
			$values = array($game,$home,$away);
			$rs		= $db->Execute($sql,$values);
			
			$msg	= "Successfully Added $game";
		} else {
			$msg =  "Missing fields, please go back and fix them.";
		}
	}
	
	$sql 	= "SELECT * FROM teams";
	$rs		= $db->Execute($sql);
?>

<html>
	<head>
		<title> Make New Bowl </title>
	</head>
	
	<body>
		<?php if ($msg) { ?>
			<div style="color: green";><?php echo $msg; ?></div>
		<?php } ?>
		<form name="newbowl" action="newbowl.php" method="post">
			<h1>Create a new bowl</h1>
			<p>Bowl Name: 
			  <input type="text" name="game" />
		  </p>
			<p>Home Team: 
			  <label>
			  <select name="home">
			  	<option selected>Select Team</option>
			  	<?php while (!$rs->EOF) { ?>
					<option value="<?php echo $rs->fields['id']; ?>"><?php echo $rs->fields['team_name']; ?></option>
				<?php $rs->MoveNext(); } $rs->MoveFirst(); ?>
		      </select>
			  </label>
			</p>
			<p>Away Team: 
			  <label>
			  <select name="away">
			  	<option selected>Select Team</option>
			  	<?php while (!$rs->EOF) { ?>
					<option value="<?php echo $rs->fields['id']; ?>"><?php echo $rs->fields['team_name']; ?></option>
				<?php $rs->MoveNext(); } ?>
		      </select>
			  </label>
			</p>
			<p>
			  <label>
			  <input type="submit" value="Submit">
			  </label>    
			</p>
		</form>
	</body>
</html>