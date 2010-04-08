<?php
require_once('classes/Main.php');
require_once('classes/Game_Stats.php');
require_once('classes/Users.php');
$user= new Users($db);
$gameStats=new Game_Stats($db);

//get value from index js
$xdata=$_GET["xdata"];

if($xdata=="userMenu"){
	if($user->isLoggedIn())
		echo true;
	else
		echo false;
}
else{
	switch ($xdata)
	{	
		case "home":
			echo "HOME PAGE STUFF";
			break;
		case "league":
			echo "NES TECMO SUPER BOWL LEAGUE of LEAGUES";
			break;
		case "standings":
			$dbData=$gameStats->getStandings();
			echo "Current Standings <br/>";
			?>
			<table>
			<thead><tr><td>User Name</td><td>Team</td><td>W</td><td>L</td><td>PF</td><td>PA</td><td>Dif</td><td>Pts</td></tr></thead>
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
}
?>