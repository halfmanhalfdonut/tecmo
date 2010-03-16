<?php
	
	class Player_Stats {
		
		const PLAYER_STATS_TABLE 	= 'player_stats';
		const RECORD_ID							= 'record_id';
		const GAME_ID								= 'game_id';
		const TEAM										= 'team';
		const HOME_OR_AWAY				= 'home_away';
		const NAME										= 'name';
		const POSITION								= 'position';
		const RUSH_ATTEMPTS				= 'rush_att';
		const RUSH_YARDS						= 'rush_yards';
		const PASS_PERCENT					= 'pass_percent';
		const PASS_YARDS						= 'pass_yards';
		const INTERCEPTIONS				= 'interceptions';
		const RECEIVED_YARDS				= 'rec_yards';
		const CATCHES								= 'catches';
	
		private $db = false;
		
		function __construct($db = null){
			if(!isset($db)){
				throw new Exception('Player_Stats constructor MUST recieve an ADODB connection object.');
			}
			$this->db = $db;
			//$this->db->debug = true;
		}
		
		public function deletePlayerStatsRecord($arrayOfIds){
			
			if(!is_array($arrayOfIds)) throw new Exception('Player_Stats deletePlayerStatsRecord($array) -> MUST receive an ARRAY of record ids');
			
			//this can be updated to delete more than one at a time.
			foreach($arrayOfIds as $thisId){
				$this->db->Execute('DELETE FROM '. self::PLAYER_STATS_TABLE .' WHERE '. self::RECORD_ID .' = ?',array($thisId));				
			}
		}
		
		public function deletePlayerStatsByGame($id){
			if(!is_numeric($id)) throw new Exception('Player_Stats deletePlayerStatsByGame($id) MUST receive a numeric game id');
			
			$this->db->Execute('DELETE FROM '. self::PLAYER_STATS_TABLE .' WHERE '. self::GAME_ID .' = ?',array($id));	
		}
		
		public function getTableNames(){
			$tableNames = array(self::PLAYER_STATS_TABLE);
			
			return $tableNames;
		}
		
		public function savePlayerStats($playerStats){
			//make sure an array is sent
			if(!is_array($playerStats)){
				throw new Exception('Player_Stats savePlayerStats($array) MUST receive an ARRAY of player stats');
			}
		
			$this->db->AutoExecute(self::PLAYER_STATS_TABLE,$playerStats,'INSERT');
		}
		
		public function getPlayersByGame($gameId){
			if(!is_numeric($gameId)){
				throw new Exception('Player_Stats getPlayersByGame($gameId) MUST receive an integer game id');
			}
			
			$this->db->SetFetchMode( ADODB_FETCH_ASSOC );
			return $this->db->GetAll('SELECT * FROM '. self::PLAYER_STATS_TABLE .' WHERE '. self::GAME_ID .' = ? ',$gameId);
		}
		
		public function createPlayerStatsTable(){
			$this->db->Execute("DROP TABLE IF EXISTS ". self::PLAYER_STATS_TABLE .";");

			$this->db->Execute("
				CREATE TABLE IF NOT EXISTS `". self::PLAYER_STATS_TABLE ."` (
				  `". self::RECORD_ID ."` int(11) NOT NULL AUTO_INCREMENT,
				  `". self::GAME_ID ."` int(5) NOT NULL,
				  `". self::TEAM ."` varchar(15) NOT NULL,
				  `". self::HOME_OR_AWAY ."` varchar(4) NOT NULL,
				  `". self::NAME ."` varchar(30) NOT NULL,
				  `". self::POSITION ."` varchar(2) NOT NULL,
				  `". self::RUSH_ATTEMPTS ."` int(4) DEFAULT NULL,
				  `". self::RUSH_YARDS ."` int(5) DEFAULT NULL,
				  `". self::PASS_PERCENT ."` decimal(5,0) DEFAULT NULL,
				  `". self::PASS_YARDS ."` int(5) DEFAULT NULL,
				  `". self::INTERCEPTIONS ."` int(3) DEFAULT NULL,
				  `". self::RECEIVED_YARDS ."` int(5) DEFAULT NULL,
				  `". self::CATCHES ."` int(4) DEFAULT NULL,
				  PRIMARY KEY (`". self::RECORD_ID ."`)
				) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
		}
	}
?>