<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Winner</title>
</head>

<body>

<?php
	require_once('config.php');
	
	if ($_GET) {
		$game = isset($_GET['game']) ? $_GET['game'] : false;
		
		if ($game) {
			$sql = "SELECT g.id as gid, g.game_name as game, t.id as hid, x.id as aid, t.team_name as home, x.team_name as away
					FROM games g, teams t, teams x
					WHERE g.id = ?
					AND g.home_id = t.id
					AND g.away_id = x.id";
			$rs	= $db->Execute($sql,array($game));
			
			?>
	<form name="addwinner" action="add_winner.php" method="post">
			<h1><?php echo $rs->fields['game']; ?></h1>
			<input type="hidden" name="game" value="<?php echo $rs->fields['game']; ?>" />
			<input type="hidden" name="home" value="<?php echo $rs->fields['hid']; ?>" />
			<input type="hidden" name="away" value="<?php echo $rs->fields['aid']; ?>" />
			<?php echo $rs->fields['home']; ?> Score: <input type="text" name="homescore" /><br />
			<?php echo $rs->fields['away']; ?> Score: <input type="text" name="awayscore" /><br /><br />
			<input type="submit" value="Submit" />
	</form>
	<?php
		}
	} else if ($_POST) {
		print_r($_POST);
		$hs = isset($_POST['homescore']) ? $_POST['homescore'] : false;
		$as = isset($_POST['awayscore']) ? $_POST['awayscore'] : false;
		$hi = isset($_POST['home']) ? $_POST['home'] : false;
		$ai = isset($_POST['away']) ? $_POST['away'] : false;
		$game = isset($_POST['game']) ? $_POST['game'] : false;
		
		$winner = $hs > $as ? $hi : $ai;

		if ($hs && $as && $hi && $ai) {
			$sql = "UPDATE games SET home_score = ?, away_score = ?, winner = ? WHERE game_name = ?";
			$val = array($hs,$as,$winner,$game);
			$rs	 = $db->Execute($sql,$val);
			?>
				<?php echo $game; ?> Bowl Updated <br />
				<a href="add_winner.php">Add Winner</a>
			<?php
		}
	} else {
	
	$sql	= "SELECT id,game_name
				FROM games
				WHERE winner = 0";
	$rs		= $db->Execute($sql);
?>

<form name="addwinner" action="add_winner.php" method="get">
	Select Game: 
	<select name="game">
		<option selected>Select Game</option>
	<?php while (!$rs->EOF) { ?>
		<option value="<?php echo $rs->fields['id']; ?>"><?php echo $rs->fields['game_name']; ?></option>
	<?php 
		$rs->MoveNext();} ?>
	</select>
	<input type="submit" value="Submit" />
</form>
<?php } ?>
</body>
</html>
