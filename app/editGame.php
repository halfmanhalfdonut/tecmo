<?php

	require_once('classes/Main.php');
	require_once('classes/Users.php');
	require_once('classes/Player_Stats.php');
	require_once('classes/Game_Stats.php');
	
	$user = new Users($db);
	$player_stats = new Player_Stats($db);
	$game_stats = new Game_Stats($db);
	
	//make sure the user has the right to see this page
	if((!$user->isLoggedIn()) || (!$user->isAdmin())  ){
		header('Location: logout.php?message=2');
		exit;
	}
	
	//store errors and success messges here
	$notice = array();
	
	if(!isset($_GET['gameId'])){
		$notice[]= 'This page MUST receive a gameId';
	}
	else{
		//delete or load?
		if(isset($_GET['delete'])){
			//delete game
			$game_stats->deleteGameStats($_GET['gameId']);
			
			//delete players
			$player_stats->deletePlayerStatsByGame($_GET['gameId']);
			
			//send success message to template
			$notice[]= 'Game '.$_GET['gameId'].' deleted successfully';
		}
		else{
			//get game details
			$thisGame = $game_stats->getGameStats($_GET['gameId']);
			$gameHeaders = array_keys($thisGame[$_GET['gameId']]);
			$gamePlayers = $player_stats->getPlayersByGame($_GET['gameId']);
			$playerHeaders = array_keys($gamePlayers[0]);
			
			$smarty->assign('thisGame',$thisGame[$_GET['gameId']]);
			$smarty->assign('gameHeaders',$gameHeaders);
			$smarty->assign('gamePlayers',$gamePlayers);
			$smarty->assign('playerHeaders',$playerHeaders);
		}
	}

	$smarty->assign('notice',$notice);
	
	$smarty->assign('pageTitle','Edit Game');
	$smarty->display('header.tpl');
	$smarty->display('editGame.tpl');
?>