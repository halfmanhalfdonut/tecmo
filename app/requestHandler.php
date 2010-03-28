<?php
include('classes/Main.php');
include('classes/Game_Stats.php');

$gameStats=new Game_Stats($db);
//get value from index js
$xdata=$_GET["xdata"];
switch ($xdata)
{	//makes calls to the appropriate Game_Stats methods
	case "home":
		echo "HOME PAGE STUFF";
		break;
	case "league":
		echo "NES TECMO SUPER BOWL LEAGUE of LEAGUES";
		break;
	case "standings":
		$dbData=$gameStats->getGames();
		echo "Current Standings <br/>";
		?>
		<table>
		<thead><tr><td>User Name</td><td>Team</td><td>W</td><td>L</td><td>PF</td><td>PA</td><td>Dif</td></tr></thead>
		<?php
		foreach($dbData as $row)
			echo "<tr><td>".$row['user_upload']."</td><td>".$row['user_upload_team']."<td>1</td><td>0</td><td>".$row['home_total_score']."<td>".$row['away_total_score']."</td></tr>";
		?>
		</table>
		<?php
		
		break;
	case "teams":
		echo "Toronto Bills";
		break;
	default:
		echo "wambo";
}




?>