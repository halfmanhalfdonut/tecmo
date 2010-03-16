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
	
	//save ourselves from some computing. If nothing is being sent then there is nothing to check for, silly!
	if(!empty($_POST)){
		//edit user actions
		if(isset($_POST['editUsers'])){
			if($_POST['editUsersAction']=='delete'){
				//delete users by id
				$user->deleteUsers($_POST['editUsers']);
			}
			elseif($_POST['editUsersAction']=='makeAdmin'){
				
				//make each user an admin
				foreach($_POST['editUsers'] as $username){
					
					$user->changeUserType($username,1);
				}
			}
			elseif($_POST['editUsersAction']=='makeRegular'){
			
				//make each user a regular user
				foreach($_POST['editUsers'] as $username){
					$user->changeUserType($username,0);
				}
			}
			
		}
		
		//reset tables?
		if(isset($_POST['confirm'])){
			if($_POST['reset']=='users'){
				$user->createUsersTable();
			}
			elseif($_POST['reset']=='player_stats'){
				$player_stats->createPlayerStatsTable();
			}
			elseif($_POST['reset']=='game_stats'){
				$game_stats->createGameStatsTable();
			}
			
		}
	}
	
	//populate list of users in current users area
	$smarty->assign('currentUsers',$user->getUsers());
	
	//populate list of games
	$smarty->assign('currentGames',$game_stats->getGames());
	$smarty->assign('pageTitle','Admin Panel');
	$smarty->display('header.tpl');
	$smarty->display('admin.tpl');
?>