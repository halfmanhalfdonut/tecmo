<?php
	require_once('inc/config.php');
	
	
	DEFINE('TEAMS_TABLE','teams');
	DEFINE('DEFAULT_LOGO','');
	
	//accepts array with indexes of "name, logo, wins, losses, link" to create new team
	function createTeam($values = array()){
		
		if(empty($values['name'])){
			echo '<br />Error: Team name cannot be empty<br />';
			return false;
		}
		
		$sql = 'INSERT INTO '.TEAMS_TABLE.' (name, logo, wins, losses, link) VALUES (?, ?, ?, ?, ?) ';
		$sqlArray []=  $values['name'];
		$sqlArray []=  !empty($values['logo']) ? $values['logo'] : DEFAULT_LOGO;
		$sqlArray []=  !empty($values['wins']) ? $values['wins'] : 0;
		$sqlArray []=  !empty($values['losses']) ? $values['losses'] : 0;
		$sqlArray []=	 !empty($values['link']) ? $values['link'] : '';
		
		$GLOBALS['db']->Execute($sql, $sqlArray);
		
		return true;
	}

	//deletes team of id $id
	function deleteTeam($id){
		if(!is_int($id)){
			echo '<br />Error: ID must be supplied as int<br />';
			return false;
		}
		else{
			$sql = 'DELETE FROM '.TEAMS_TABLE.' WHERE team_id = ? ';
			$sqlArray = array($id);
			$GLOBALS['db']->Execute($sql, $sqlArray);
			
			return true;
		}
	}
	
	//accepts an array and makes changes to team_id supplied in array
	//team_id MUST be supplied, as well as at least one change.
	function updateTeam($values = array()){
		if(!count($values)){
			echo '<br />Error: New values must be supplied in an array<br />';
			return false;
		}
		elseif(!is_int($values['team_id'])){
			echo '<br />Error: ID must be supplied as an int<br />';
			return false;
		}
		else{
			$fields = array();
			foreach($values as $index => $value){
				if($index != 'team_id'){
					$fields []= ' '.mysql_real_escape_string($index).' = "'.mysql_real_escape_string($value).'"'; 
				}
			}
			
			if(!count($fields)){
				echo '<br />Error: No new values were supplied<br />';
				return false;
			}
			else{
				$sql = 'UPDATE '.TEAMS_TABLE.'  SET '.implode(',',$fields).' WHERE team_id = ? ';
				$sqlArray = array($values['team_id']);
				$GLOBALS['db']->Execute($sql, $sqlArray);
				return true;
			}
		}
	}
	
?>