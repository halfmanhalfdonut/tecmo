<?php
  require_once('config.php');

if ($_POST) {
	$user 	= isset($_POST['user']) ? $_POST['user'] : false;
	$games 	= isset($_POST['game']) ? $_POST['game'] : false;
	$tie  	= isset($_POST['tiebreaker']) ? $_POST['tiebreaker'] : false;
	
	if ($user && $games && $tie) {
		$x = 1;
		$sql	= "INSERT INTO picks(user_id,game_id,team_id) VALUES ";
		foreach ($games as $game) {
			$sql .= "($user,$x,$game), ";
			$x++;
		}
		$sql = rtrim($sql,', ');
		$rs = $db->Execute($sql);
		$sql_t	= "INSERT INTO tiebreakers(user_id,game_id,total) VALUES ($user,34,$tie)";
		$rs_t	= $db->Execute($sql_t);
		echo "GREAT SUCCESS!";
	} else {
		echo "Something didn't work...";
	}
}

	$sql_u  = "SELECT id,user_name as name
             FROM users
             WHERE status = ?
			 AND id NOT IN (SELECT user_id FROM picks)";
	$values = array(1);
	$rs_u   = $db->Execute($sql_u,$values);

	$sql    = "SELECT g.id, g.game_name, g.home_id, g.away_id, t.team_name as home, s.team_name as away
			 FROM games g, teams t, teams s
			 WHERE g.home_id = t.id
			 AND g.away_id = s.id";
	$rs     = $db->Execute($sql);

?>
  <html>
  <head>
  <title>Pick Games</title>
  </head>
  <body>
  <fieldset>
  <legend>Pick all games!</legend>
  <form name="form" id="form" action="bowl_pick.php" method="post">
  <select name="user">
  <option selected>Select User</option>
	  <?php
	   while (!$rs_u->EOF) { ?>
		 
		  <option value="<?php echo $rs_u->fields['id']; ?>">
			<?php echo $rs_u->fields['name']; ?>
		  </option>
	
		  <?php $rs_u->MoveNext();
		}
	  ?>
  </select>
  <br /><br />
	<?php while (!$rs->EOF) { ?>
		<label><?php echo $rs->fields['game_name']; ?>:</label>
		<input type="radio" name="game[<?php echo $rs->fields['id']; ?>]" value="<?php echo $rs->fields['home_id']; ?>" /><?php echo $rs->fields['home']; ?>
		<input type="radio" name="game[<?php echo $rs->fields['id']; ?>]" value="<?php echo $rs->fields['away_id']; ?>" /><?php echo $rs->fields['away']; ?>
		<br /><br />

<?php 
  $rs->MoveNext();
} ?>
  Tiebreaker: <input type="text" name="tiebreaker" /> <br /><br />
  <input type="submit" value="Submit" />
  </form>
  </body>
</html>