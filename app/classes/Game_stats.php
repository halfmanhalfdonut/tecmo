<?php
	
	class Game_Stats {
		
		const GAME_STATS_TABLE 				= 'game_stats';
		const GAME_ID						 				= 'game_id';
		const USER_UPLOAD							= 'user_upload';
		const USER_UPLOAD_TEAM				= 'user_upload_team';
		const UPLOADER_HOME_AWAY		= 'user_upload_home_away';
		const USER_AGAINST						 	= 'user_against';
		const USER_AGAINST_TEAM			 	= 'user_against_team';
		const FLAGGED									 	= 'flagged';
		const HOME_Q1								 		= 'home_q1_score';
		const AWAY_Q1								 		= 'away_q1_score';
		const HOME_Q2								 		= 'home_q2_score';
		const AWAY_Q2								 		= 'away_q2_score';
		const HOME_Q3								 		= 'home_q3_score';
		const AWAY_Q3								 		= 'away_q3_score';
		const HOME_Q4								 		= 'home_q4_score';
		const AWAY_Q4								 		= 'away_q4_score';
		const HOME_SCORE						 	= 'home_total_score';
		const AWAY_SCORE						 		= 'away_total_score';
		const HOME_RUSH_ATTEMPTS		= 'home_rush_att';
		const AWAY_RUSH_ATTEMPTS			= 'away_rush_att';
		const HOME_RUSH_YARDS				= 'home_rush_yards';
		const AWAY_RUSH_YARDS				= 'away_rush_yards';
		const HOME_PASS_YARDS					= 'home_pass_yards';
		const AWAY_PASS_YARDS					= 'away_pass_yards';
		const HOME_FIRST_DOWNS				= 'home_first_downs';
		const AWAY_FIRST_DOWNS				= 'away_first_downs';
	
		private $db = false;
		
		function __construct($db = null){
			if(!isset($db)){
				throw new Exception('Game_Stats constructor MUST recieve an ADODB connection object.');
			}
			$this->db = $db;
			//$this->db->debug = true;
		}
		
		public function deleteGameStats($id){
			
			if(!is_numeric($id)) throw new Exception('Game_Stats deleteGameStats($id) MUST receive an integer record id');
			
			$this->db->Execute('DELETE FROM '. self::GAME_STATS_TABLE .' WHERE '. self::GAME_ID .' = ? ',$id);				
		}
		
		public function getTableNames(){
			$tableNames = array(self::GAME_STATS_TABLE);
			
			return $tableNames;
		}
		
		public function getGames(){
			//$this->db->SetFetchMode( ADODB_FETCH_ASSOC );
			return $this->db->GetAssoc('SELECT * FROM '. self::GAME_STATS_TABLE .' WHERE 1 ');
		}
		
		public function getGameStats($id){
			//make sure an int id is sent
			if(!is_numeric($id)){
				throw new Exception('Game_Stats getGameStats($id) MUST receive an int id');
			}
			
			$this->db->SetFetchMode( ADODB_FETCH_ASSOC );
			return $this->db->GetAssoc('SELECT * FROM '. self::GAME_STATS_TABLE .' WHERE '. self::GAME_ID .' = ? ',$id);
		}
		
		public function saveGameStats($gameStats){
			//make sure an array is sent
			if(!is_array($gameStats)){
				throw new Exception('Game_Stats saveGameStats($array) MUST receive an ARRAY of game stats');
			}
			
			$record = array();
			$record[self::USER_UPLOAD] 								= $gameStats['user_upload'];
			$record[self::USER_UPLOAD_TEAM]					= ($gameStats['user_upload_home_away'] == 'home' ? $gameStats['home']['team'] : $gameStats['away']['team']);
			$record[self::UPLOADER_HOME_AWAY]				= $gameStats['user_upload_home_away'];
			$record[self::USER_AGAINST] 								= $gameStats['user_against'];
			$record[self::USER_AGAINST_TEAM] 					= ($gameStats['user_upload_home_away'] == 'home' ? $gameStats['away']['team'] : $gameStats['home']['team']);
			
			$record[self::HOME_Q1] 											= $gameStats['home']['score']['q1'];
			$record[self::HOME_Q2] 											= $gameStats['home']['score']['q2'];
			$record[self::HOME_Q3] 											= $gameStats['home']['score']['q3'];
			$record[self::HOME_Q4] 											= $gameStats['home']['score']['q4'];
			$record[self::HOME_SCORE] 									= $gameStats['home']['score']['total'];
			
			$record[self::AWAY_Q1] 											= $gameStats['away']['score']['q1'];
			$record[self::AWAY_Q2] 											= $gameStats['away']['score']['q2'];
			$record[self::AWAY_Q3] 											= $gameStats['away']['score']['q3'];
			$record[self::AWAY_Q4] 											= $gameStats['away']['score']['q4'];
			$record[self::AWAY_SCORE] 									= $gameStats['away']['score']['total'];
			
			$record[self::HOME_RUSH_ATTEMPTS] 				= $gameStats['home']['teamStats']['runs']['att'];
			$record[self::HOME_RUSH_YARDS] 						= $gameStats['home']['teamStats']['runs']['yards'];
			$record[self::HOME_PASS_YARDS] 						= $gameStats['home']['teamStats']['pass'];
			$record[self::HOME_FIRST_DOWNS] 					= $gameStats['home']['teamStats']['firsts'];			
			
			$record[self::AWAY_RUSH_ATTEMPTS] 				= $gameStats['away']['teamStats']['runs']['att'];
			$record[self::AWAY_RUSH_YARDS] 						= $gameStats['away']['teamStats']['runs']['yards'];
			$record[self::AWAY_PASS_YARDS] 						= $gameStats['away']['teamStats']['pass'];
			$record[self::AWAY_FIRST_DOWNS] 					= $gameStats['away']['teamStats']['firsts'];

		
			$this->db->AutoExecute(self::GAME_STATS_TABLE,$record,'INSERT');
			
			return $this->db->Insert_ID();
		}
		
		public function createGameStatsTable(){
			$this->db->Execute("DROP TABLE IF EXISTS ". self::GAME_STATS_TABLE .";");

			$this->db->Execute("
				CREATE TABLE IF NOT EXISTS `". self::GAME_STATS_TABLE ."` (
				  `". self::GAME_ID ."` int(5) NOT NULL AUTO_INCREMENT,
				  `". self::USER_UPLOAD ."` varchar(15) NOT NULL,
				  `". self::USER_UPLOAD_TEAM ."` varchar(15) NOT NULL,
				  `". self::UPLOADER_HOME_AWAY ."` varchar(4) NOT NULL,
				  `". self::USER_AGAINST ."` varchar(15) NOT NULL,
				  `". self::USER_AGAINST_TEAM ."` varchar(15) NOT NULL,
				  `". self::FLAGGED ."` varchar(15) DEFAULT NULL,
				  `". self::HOME_Q1 ."` int(3) NOT NULL,
				  `". self::AWAY_Q1 ."` int(3) NOT NULL,
				  `". self::HOME_Q2 ."` int(3) NOT NULL,
				  `". self::AWAY_Q2 ."` int(3) NOT NULL,
				  `". self::HOME_Q3 ."` int(3) NOT NULL,
				  `". self::AWAY_Q3 ."` int(3) NOT NULL,
				  `". self::HOME_Q4 ."` int(3) NOT NULL,
				  `". self::AWAY_Q4 ."` int(3) NOT NULL,
				  `". self::HOME_SCORE ."` int(4) NOT NULL,
				  `". self::AWAY_SCORE ."` int(4) NOT NULL,
				  `". self::HOME_RUSH_ATTEMPTS ."` int(4) NOT NULL,
				  `". self::AWAY_RUSH_ATTEMPTS ."` int(4) NOT NULL,
				  `". self::HOME_RUSH_YARDS ."` int(5) NOT NULL,
				  `". self::AWAY_RUSH_YARDS ."` int(5) NOT NULL,
				  `". self::HOME_PASS_YARDS ."` int(5) NOT NULL,
				  `". self::AWAY_PASS_YARDS ."` int(5) NOT NULL,
				  `". self::HOME_FIRST_DOWNS ."` int(4) NOT NULL,
				  `". self::AWAY_FIRST_DOWNS ."` int(11) NOT NULL,
				  PRIMARY KEY (`". self::GAME_ID ."`)
				) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			");
		}
	}
?>