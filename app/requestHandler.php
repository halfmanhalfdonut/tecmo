<?php
//get value from index js
$xdata=$_GET["xdata"];
switch ($xdata)
{	//makes calls to the appropriate Game_Stats methods
	case "home":
		echo "HOME PAGE STUFF";
		break;
	case "league":
		echo "NES SUPER TECMO BOWL LEAGUE of LEAGUES";
		break;
	case "standings":
		echo "Standings will be displayed here";
		break;
	case "teams":
		echo "Toronto Bills";
		break;
	default:
		echo "wambo";
}




?>