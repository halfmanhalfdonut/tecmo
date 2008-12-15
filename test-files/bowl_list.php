<?php
	require_once('config.php');	
	
	$sql = "SELECT t.team_name, u.user_name, g.game_name, x.team_name as winner, g.home_score as homescore, g.away_score as awayscore, h.team_name as home, a.team_name as away, ti.total
			FROM teams t
			INNER JOIN picks p ON p.team_id = t.id
			INNER JOIN users u ON p.user_id = u.id
			INNER JOIN games g ON p.game_id = g.id
			INNER JOIN teams h ON g.home_id = h.id
			INNER JOIN teams a ON g.away_id = a.id
			LEFT JOIN teams x ON x.id = g.winner
			LEFT JOIN tiebreakers ti ON p.game_id = ti.game_id AND p.user_id = ti.user_id
			GROUP BY u.user_name, g.game_name
			ORDER BY u.id, g.id";
	$rs	= $db->Execute($sql);
	
	$winners = array();
	while (!$rs->EOF) {
		if ($rs->fields['winner'] != "none") {
			$winners[] = $rs->fields['winner'];
		}
		$rs->MoveNext();
	}
	$rs->MoveFirst();
	$winners = array_unique($winners);
	
	$wincount = array();
	while (!$rs->EOF) {
		if ($rs->fields['winner'] == $rs->fields['team_name']) {
			$wincount[$rs->fields['user_name']]++;
		}
		$rs->MoveNext();
	}
	$rs->MoveFirst();
	
	$leaders = array();
	$leaders = $wincount;
	asort($leaders,SORT_NUMERIC);
	$leaders = array_reverse($leaders);
	$leaderNames = array_keys($leaders);
	$leaderVals = array_values($leaders);
?>

<html>
	<head>
		<title>Bowls 2007-2008</title>
		<link rel="stylesheet" href="bowls.css" />
		<script src="bowls.js" type="text/javascript"></script>
		<script src="prototype.js" type="text/javascript"></script>
		<script src="effects.js" type="text/javascript"></script>
	</head>
	<body>
		<?php /*
		<div class="user_name leader_link" id="leaderboard_toggle" style="border-bottom-width: 0px;">
			<a href="javascript: void(0);" onClick="toggleLeaders(this);">Hide Leaderboard</a>
		</div>
		<table width="200" border="0" cellpadding="2" cellspacing="0" class="bowls" id="leaderboard">
			<?php
				$position = 0;
				$iteration = 0;
				$lastVal = 0;
				while ($position < 10) {
					$alt = $iteration % 2 == 0 ? "line_1" : "line_2";
					
					if ($lastVal != $leaderVals[$iteration]) {
						$position++;
					}
					if ($lastVal != $leaderVals[$iteration] && $iteration >= 10) {
						break;
					}
					?>
					<tr class="<?php echo $alt; ?>">
						<td class="user_name"><?php if ($lastVal == $leaderVals[$iteration]) { echo "-"; } else { echo $iteration+1; } ?></td>
						<td><a href="javascript: void(0);" title="Show Picks" onClick="showPick('<?php echo str_replace(' ','_',$leaderNames[$iteration]); ?>');"><?php echo $leaderNames[$iteration]; ?></a></td>
						<td class="correct"><?php echo $leaderVals[$iteration]; ?></td>
					</tr>
					<?php
					$lastVal = $leaderVals[$iteration];
					$iteration++;
				}
			?>
		</table>
		<br />
		<br />
		*/ ?>
		<table cellspacing="0" cellspacing="2" border="0" class="bowls">
			<tr class="game_list">
				<td>&nbsp;</td>
		<?php
			$games = array();
			while (!$rs->EOF) {
				if (!in_array($rs->fields['game_name'],$games)) { 
				?>
					
					<td class="game_name"><?php echo $rs->fields['game_name']; ?></td>
				<?php
				 }
				
				$games[] = $rs->fields['game_name'];
				$rs->MoveNext();
			}
			?>
				<td class="game_name">Tiebreaker</td>
			<?php
			$rs->MoveFirst();
			
			$users = array();
			$user;
			$x = 0;
			while (!$rs->EOF) {
				if (!in_array($rs->fields['user_name'],$users)) { 
					$alt = $x % 2 == 0 ? "line_1" : "line_2";
				?>
					</tr><tr id="<?php echo str_replace(' ','_',$rs->fields['user_name']); ?>" class="<?php echo $alt; ?>" onMouseOver="this.addClassName('highlight');" onMouseOut="this.removeClassName('highlight');" onClick="toggleHighlight(this);"><td class="user_name"><?php echo $rs->fields['user_name']; ?> <br />(<?php if ($wincount[$rs->fields['user_name']] > 0) { echo $wincount[$rs->fields['user_name']]; } else { echo "0"; } ?>)</td>
				<?php $x++; $y = 1;
				}
				$users[] = $rs->fields['user_name'];
				$user = $rs->fields['user_name'];
				if ($rs->fields['user_name'] == $user) { ?>
					<td class="pick <?php if ((!in_array($rs->fields['team_name'],$winners)) && $y <= count($winners)) { echo "loser"; }?>">
						<?php 
							if ($rs->fields['homescore'] >= '00') {
								if ($rs->fields['team_name'] == $rs->fields['home']) {
									echo "<b>".$rs->fields['team_name']."</b><br /><small> (<b>".$rs->fields['home']." ".$rs->fields['homescore']."</b><br />".$rs->fields['away']." ".$rs->fields['awayscore'].")</small>";
								} else {
									echo "<b>".$rs->fields['team_name']."</b><br /><small> (".$rs->fields['home']." ".$rs->fields['homescore']."<br /><b>".$rs->fields['away']." ".$rs->fields['awayscore']."</b>)</small>";
								}
							} else 
								echo $rs->fields['team_name'];
						?>
					</td>
				<?php
				if ($rs->fields['game_name'] == 'Mythical Title') {
					?><td class="tiebreaker"><?php echo $rs->fields['total'];?></td>
				<?php } }
				$y++;
				$rs->MoveNext();
			}
		?>
			</tr>
		</table>
	</body>
</html>
