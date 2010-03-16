<?php
	require_once('classes/Main.php');
	require_once('classes/Users.php');
	require_once('classes/Game_Stats.php');
	
	$user = new Users($db);
	
	//make sure user is logged in
	if(!$user->isLoggedIn()){
		header('Location: logout.php?message=1');
		exit;
	}
	
	$gameStats = new Game_Stats($db);
	
	$allGames = $gameStats->getGames();
	$smarty->assign('allGames',$allGames );
	echo '<pre>';
	print_r($allGames);
	echo '</pre>';
	
	$smarty->assign('userName',$user->userName());
	$smarty->display('header.tpl');
	$smarty->display('main.tpl');
?>