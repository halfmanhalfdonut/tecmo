<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tecmo Bowl</title>
	<style type="text/css">
		.headings {
			font-weight: bold;
		}
		
		.winner {
			font-weight: bold;
			font-style: italic;
		}
		
		.loser {
			font-weight: normal;
			font-style: normal;
		}
	</style>
</head>

<body>

<?php
	$state = fopen('tecmo-super-bowl.nst', 'rb');
	
	$home = array();
	$away = array();
	$homeClass = '';
	$awayClass = '';
	
	// scores
	// home
	fseek($state, 0x3CD);
	$home['score']['q1'] = bin2hex(fread($state, 1));
	$home['score']['q2'] = bin2hex(fread($state, 1));
	$home['score']['q3'] = bin2hex(fread($state, 1));
	$home['score']['q4'] = bin2hex(fread($state, 1));
	$home['score']['total'] = bin2hex(fread($state, 1));

	// away
	$away['score'] = array();
	$away['score']['q1'] = bin2hex(fread($state, 1));
	$away['score']['q2'] = bin2hex(fread($state, 1));
	$away['score']['q3'] = bin2hex(fread($state, 1));
	$away['score']['q4'] = bin2hex(fread($state, 1));
	$away['score']['total'] = bin2hex(fread($state, 1));
	
	// team abbreviation
	fseek($state, 0xC0F);
	$home['team'] = fread($state, 4);
	
	fseek($state, 0xC2F);
	$away['team'] = fread($state, 4);
	
	// team stats
	$home['teamStats'] = array();
	$home['teamStats']['runs'] = array();
	fseek($state, 0xC14);
	$home['teamStats']['runs']['att'] = fread($state, 3);
	fseek($state, 0xC18);
	$home['teamStats']['runs']['yards'] = fread($state, 3);
	fseek($state, 0xC1E);
	$home['teamStats']['pass'] = fread($state, 4);
	fseek($state, 0xC26);
	$home['teamStats']['firsts'] = fread($state, 2);
	
	$away['teamStats'] = array();
	$away['teamStats']['runs'] = array();
	fseek($state, 0xC34);
	$away['teamStats']['runs']['att'] = fread($state, 3);
	fseek($state, 0xC38);
	$away['teamStats']['runs']['yards'] = fread($state, 3);
	fseek($state, 0xC3E);
	$away['teamStats']['pass'] = fread($state, 4);
	fseek($state, 0xC46);
	$away['teamStats']['firsts'] = fread($state, 2);
	
	// team leader
	// RUN
	$home['teamLeader'] = array();
	$home['teamLeader']['runs'] = array();
	fseek($state, 0xCF4);
	$home['teamLeader']['runs']['player'] = fread($state, 17);
	$home['teamLeader']['runs']['att'] = fread($state, 2);
	$home['teamLeader']['runs']['yards'] = fread($state, 4);
	
	$away['teamLeader'] = array();
	$away['teamLeader']['runs'] = array();
	fseek($state, 0xD14);
	$away['teamLeader']['runs']['player'] = fread($state, 17);
	$away['teamLeader']['runs']['att'] = fread($state, 2);
	$away['teamLeader']['runs']['yards'] = fread($state, 4);
	
	
	// PASS
	$home['teamLeader']['pass'] = array();
	fseek($state, 0xD54);
	$home['teamLeader']['pass']['player'] = fread($state, 13);
	$home['teamLeader']['pass']['att'] = fread($state, 3);
	$home['teamLeader']['pass']['yards'] = fread($state, 4);
	$home['teamLeader']['pass']['ints'] = fread($state, 3);
	
	$away['teamLeader']['pass'] = array();
	fseek($state, 0xD74);
	$away['teamLeader']['pass']['player'] = fread($state, 13);
	$away['teamLeader']['pass']['att'] = fread($state, 3);
	$away['teamLeader']['pass']['yards'] = fread($state, 4);
	$away['teamLeader']['pass']['ints'] = fread($state, 3);
	
	
	// RECEIVE
	$home['teamLeader']['rec'] = array();
	fseek($state, 0xDB4);
	$home['teamLeader']['rec']['player'] = fread($state, 17);
	$home['teamLeader']['rec']['catches'] = fread($state, 2);
	$home['teamLeader']['rec']['yards'] = fread($state, 4);
	
	$away['teamLeader']['rec'] = array();
	fseek($state, 0xDD4);
	$away['teamLeader']['rec']['player'] = fread($state, 17);
	$away['teamLeader']['rec']['catches'] = fread($state, 2);
	$away['teamLeader']['rec']['yards'] = fread($state, 4);

	fclose($state);
?>
<h1>Post Game Stats</h1>
	<table class="game-score">
		<tr class="headings">
			<td>Team</td>
			<td>1st</td>
			<td>2nd</td>
			<td>3rd</td>
			<td>4th</td>
			<td>Final</td>
		</tr>
		<tr class="home">
			<td><?php echo $home['team']; ?></td>
			<td><?php echo $home['score']['q1'] ?></td>
			<td><?php echo $home['score']['q2'] ?></td>
			<td><?php echo $home['score']['q3'] ?></td>
			<td><?php echo $home['score']['q4'] ?></td>
			<td class="<?php echo $homeClass; ?>"><?php echo $home['score']['total']; ?></td>
		</tr>
		<tr class="away">
			<td><?php echo $away['team']; ?></td>
			<td><?php echo $away['score']['q1']; ?></td>
			<td><?php echo $away['score']['q2']; ?></td>
			<td><?php echo $away['score']['q3']; ?></td>
			<td><?php echo $away['score']['q4']; ?></td>
			<td class="<?php echo $awayClass; ?>"><?php echo $away['score']['total']; ?></td>
		</tr>
	</table>
	
	<h2>Team Statistics</h2>
	
	<table width="80%" border="0">
		<tr>
			<th scope="col">&nbsp;</th>
			<th scope="col">Run att</th>
			<th scope="col">Run yards</th>
			<th scope="col">Pass</th>
			<th scope="col">1st Downs</th>
		</tr>
		<tr>
			<td><div align="right"><?php echo $home['team']; ?></div></td>
			<td><div align="right"><?php echo $home['teamStats']['runs']['att']; ?></div></td>
			<td><div align="right"><?php echo $home['teamStats']['runs']['yards']; ?></div></td>
			<td><div align="right"><?php echo $home['teamStats']['pass']; ?></div></td>
			<td><div align="right"><?php echo $home['teamStats']['firsts']; ?></div></td>
		</tr>
		<tr>
			<td><div align="right"><?php echo $away['team']; ?></div></td>
			<td><div align="right"><?php echo $away['teamStats']['runs']['att']; ?></div></td>
			<td><div align="right"><?php echo $away['teamStats']['runs']['yards']; ?></div></td>
			<td><div align="right"><?php echo $away['teamStats']['pass']; ?></div></td>
			<td><div align="right"><?php echo $away['teamStats']['firsts']; ?></div></td>
		</tr>
	</table>
	<h2>Team Leader</h2>
	<h3>Runs</h3>
	<table width="80%" border="0">
		<tr>
			<td><div align="right"><?php echo $home['team']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['runs']['player']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['runs']['att']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['runs']['yards']; ?></div></td>
		</tr>
		<tr>
			<td><div align="right"><?php echo $away['team']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['runs']['player']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['runs']['att']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['runs']['yards']; ?></div></td>
		</tr>
	</table>
	
	<h3>Pass</h3>
	<table width="80%" border="0">
		<tr>
			<td><div align="right"><?php echo $home['team']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['pass']['player']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['pass']['att']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['pass']['yards']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['pass']['ints']; ?></div></td>
		</tr>
		<tr>
			<td><div align="right"><?php echo $away['team']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['pass']['player']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['pass']['att']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['pass']['yards']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['pass']['ints']; ?></div></td>
		</tr>
	</table>
	
	<h3>Receive</h3>
	<table width="80%" border="0">
		<tr>
			<td><div align="right"><?php echo $home['team']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['rec']['player']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['rec']['catches']; ?></div></td>
			<td><div align="right"><?php echo $home['teamLeader']['rec']['yards']; ?></div></td>
		</tr>
		<tr>
			<td><div align="right"><?php echo $away['team']; ?>;</div></td>
			<td><div align="right"><?php echo $away['teamLeader']['rec']['player']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['rec']['catches']; ?></div></td>
			<td><div align="right"><?php echo $away['teamLeader']['rec']['yards']; ?></div></td>
		</tr>
	</table>

</body>
</html>
