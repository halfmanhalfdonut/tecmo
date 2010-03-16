<?php
	
	require_once('classes/Main.php');
	require_once('classes/Users.php');
	require_once('classes/NestopiaExtractor.php');
	require_once('classes/Player_Stats.php');
	require_once('classes/Game_Stats.php');
	
	$user = new Users($db);
	
	//make sure user is logged in
	if(!$user->isLoggedIn()){
		header('Location: logout.php?message=1');
		exit;
	}
	
	//used to tell the template if a file was uploaded
	$uploadSuccess = false;
	
	//variable used to store error messages
	$notices = array();
	
	//make sure user selects if they were home team or away team
	if($_POST['homeAway'] == 'none'){
		$notices[]='Please select if you were the home or away team';
	}
	
	//make sure user selects who they played against
	if($_POST['against'] == 'none'){
		$notices[]='Please select which user you played against';
	}
	
	//all files that are uploaded are deleted at the end of this script. any file type and size may be uploaded unless php.ini is modified.
	// i will try to use javascript to double check everything on the client side so that some bandwidth may be saved.
	if(isset($_FILES['file'])){
		
		
		
		//temporary directory to store uploaded files 
		$target_path = "uploads/";
		$target_path = $target_path . basename( $_FILES['file']['name']); 

		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
			
			//make sure file is not too large
			if($_FILES['file']['size'] > 20000){
				$notices[]='Error - file size may not exceed 20K';
			}
			
			//check is file has a valid nestopia extension
			$allowedExtensions = array('nst', 'ns0', 'ns1', 'ns2', 'ns3', 'ns4', 'ns5', 'ns6', 'ns7', 'ns8', 'ns9');
			foreach ($_FILES as $file) {
				if ($file['tmp_name'] > '') {
					if (!in_array(end(explode(".",strtolower($file['name']))),$allowedExtensions)) {
				   
						$notices[]= 'Error - '.$file['name']. ' does not have a valid Nestopia extension (ex: .nst, .ns0, .ns9)';
					}
				}
			}
			
			//good so far, parse file
			if(empty($notices)){
				
				//call extactor class and parse file
				$fileParser = new NestopiaExtractor($_FILES['file']['name']);
				
				//save stats to stats var
				$stats = $fileParser->getVals();
				
				//call Game_Stats class to save player stats to db
				$gameStatsDB = new Game_Stats($db);
				
				//call Player_Stats class to save player stats to db
				$playerStatsDB = new Player_Stats($db);
				
				//tell the game stats class who is uploading the game and who they played against
				$uploaderInfo = array('user_upload' => $user->userName(), 'user_upload_home_away' => $_POST['homeAway'], 'user_against'  => $_POST['against']);
				
				//save game stats, get insert id for player stats
				$gameID = $gameStatsDB->saveGameStats(array_merge($stats,$uploaderInfo));
				
				//tell team name, game id, etc...
				$extraHomeStats = array('team' => $stats['home']['team'], 'home_away'  => 'home' , 'game_id' => $gameID);
				$extraAwayStats = array('team' => $stats['away']['team'], 'home_away'  => 'away' , 'game_id' => $gameID);
				
				
				//save player stats to player stats db
				$positions = array('QB','RB','WR');
				foreach($positions as $thisPosition){
					$position = array('position' => $thisPosition);
				
					$playerStatsHome = array_merge($position,$stats['home'][$thisPosition],$extraHomeStats);
					$playerStatsDB->savePlayerStats($playerStatsHome);
					
					$playerStatsAway = array_merge($position,$stats['away'][$thisPosition],$extraAwayStats);
					$playerStatsDB->savePlayerStats($playerStatsAway);
				}
				
				
				
				//send success message to template
				$notices[]= "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
				
				//tell the template a file was uploaded
				$uploadSuccess = true;
				
				//send stats to template
				$smarty->assign('stats',$stats);
				
				echo "Scroll down for your results, I am only leaving this here for a little while incase we spot any errors<br /><pre>";
				print_r($stats);
				echo "</pre>";
			}
			
			//delete file
			unlink($target_path);
		}
		else{
			//send error message to template
			$notices[]='There was an error uploading the file, please try again!';
		}
	}
	
	$smarty->assign('notices',$notices);
	$smarty->assign('uploadSuccess',$uploadSuccess);
	
	//send current users to template so user can say who they played against
	$smarty->assign('currentUsers',$user->getUsers());
	
	$smarty->assign('pageTitle','Save File Upload');
	$smarty->display('header.tpl');
	$smarty->display('upload.tpl');
?>