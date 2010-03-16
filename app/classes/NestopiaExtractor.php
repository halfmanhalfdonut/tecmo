<?php

	class NestopiaExtractor {
	
		//private vars for storage of stats
		var $home;
		var $away;
		
		//hex locations for stats
		const SCORE_LOC 					= 0x3CD;
		const HOME_TEAM_ABBRV 	= 0xC0F;
		const AWAY_TEAM_ABBRV 	= 0xC2F;
		const HOME_RUNS_ATMPT		= 0xC14;
		const HOME_RUNS_YARDS		= 0xC18;
		const HOME_PASS					= 0xC1E;
		const HOME_FIRSTS				= 0xC26;
		const AWAY_RUNS_ATMPT		= 0xC34;
		const AWAY_RUNS_YARDS		= 0xC38;
		const AWAY_PASS					= 0xC3E;
		const AWAY_FIRSTS				= 0xC46;
		const HOME_RUNS					= 0xCF4;
		const AWAY_RUNS					= 0xD14;
		const HOME_PASSES				= 0xD54;
		const AWAY_PASSES				= 0xD74;
		const HOME_RECEIVES			= 0xDB4;
		const AWAY_RECEIVES			= 0xDD4;
		
	
		function __construct($fileName){
			
			if(empty($fileName)){
				   throw new Exception('NestopiaExtractor contructor MUST receive a file name');
			}
			
			//open file
			$state = fopen(ROOT.'/uploads/'.$fileName, 'rb');
		
			//arrays to keep data in
			$home = array();
			$away = array();
			
			//get scores
			$scores = self::getScores($state);
			
			//set parsed score values to their arrays
			$home['score'] = array();
			$away['score'] = array();
			$home['score'] = $scores['home'];
			$away['score'] =  $scores['away'];
			
			
			//get team abbreviations
			$teams = self::getTeams($state);
			
			//set team abbreviations to their parsed values
			$home['team'] = $teams['home'];
			$away['team'] = $teams['away'];
			
			//get team stats
			$stats = self::getStats($state);
			
			//set parsed team stats to their arrays
			$home['teamStats'] = array();
			$away['teamStats'] = array();
			$home['teamStats'] = $stats['home'];
			$away['teamStats'] = $stats['away'];
			
			
			//get runs
			$runs = self::getRuns($state);
			
			//set parsed run stats to their arrays
			$home['RB'] = array();
			$home['RB'] = $runs['home']['RB'];
			
			$away['RB'] = array();
			$away['RB'] = $runs['away']['RB'];
			
			
			//get passes
			$passes = self::getPasses($state);
			
			//set parsed pass stats to their arrays
			$home['QB'] = array();
			$home['QB'] = $passes['home']['QB'];
			$away['QB'] = array();
			$away['QB'] = $passes['away']['QB'];
			
			
			//get receives
			$receives = self::getReceives($state);
			
			//set parsed received stats to their arrays
			$home['WR'] = array();
			$home['WR'] = $receives['home']['WR'];
			$away['WR'] = array();
			$away['WR'] = $receives['away']['WR'];
			
			//close file
			fclose($state);
			
			//save parsed data
			$this->home = $home;
			$this->away = $away;
		}
		
		public function getVals(){
			//return parsed data
			return array('home' => $this->home, 'away' => $this->away);
		}
		
		private function getReceives($state){
			//parse receives
			$recvs['home']['WR'] = array();
			fseek($state, self::HOME_RECEIVES);
			$recvs['home']['WR']['name'] = trim(fread($state, 17));
			$recvs['home']['WR']['catches'] = trim(fread($state, 2));
			$recvs['home']['WR']['rec_yards'] = trim(fread($state, 4));
			
			$recvs['away']['WR'] = array();
			fseek($state, self::AWAY_RECEIVES);
			$recvs['away']['WR']['name'] = trim(fread($state, 17));
			$recvs['away']['WR']['catches'] = trim(fread($state, 2));
			$recvs['away']['WR']['rec_yards'] = trim(fread($state, 4));
			
			//return parsed data
			return $recvs;
		}
		
		private function getPasses($state){
			//parse passes
			$passes = array();
			$passes['home']['QB'] = array();
			
			fseek($state, self::HOME_PASSES);
			$passes['home']['QB']['name'] = trim(fread($state, 13));
			$passes['home']['QB']['pass_percent'] = trim(fread($state, 3));
			$passes['home']['QB']['pass_yards'] = trim(fread($state, 4));
			$passes['home']['QB']['interceptions'] = trim(fread($state, 3));
			
			$passes['away']['QB'] = array();
			fseek($state, self::AWAY_PASSES);
			$passes['away']['QB']['name'] = trim(fread($state, 13));
			$passes['away']['QB']['pass_percent'] = trim(fread($state, 3));
			$passes['away']['QB']['pass_yards'] = trim(fread($state, 4));
			$passes['away']['QB']['interceptions'] = trim(fread($state, 3));
			
			//return parsed pass data
			return $passes;
		}
		
		private function getRuns($state){
			//parse run data
			
			$runs = array();
			
			$runs['home'] = array();
			$runs['home']['RB'] = array();
			fseek($state, self::HOME_RUNS);
			$runs['home']['RB']['name'] = trim(fread($state, 17));
			$runs['home']['RB']['rush_att'] = trim(fread($state, 2));
			$runs['home']['RB']['rush_yards'] = trim(fread($state, 4));
			
			$runs['away'] = array();
			$runs['away']['RB'] = array();
			fseek($state, self::AWAY_RUNS);
			$runs['away']['RB']['name'] = trim(fread($state, 17));
			$runs['away']['RB']['rush_att'] = trim(fread($state, 2));
			$runs['away']['RB']['rush_yards'] = trim(fread($state, 4));
			
			//return run data
			return $runs;
		}
		
		private function getStats($state){

			$stats = array();
		
			// parse team stats
			$stats['home'] = array();
			$stats['home']['runs'] = array();
			fseek($state, self::HOME_RUNS_ATMPT);
			$stats['home']['runs']['att'] = trim(fread($state, 3));
			fseek($state, self::HOME_RUNS_YARDS);
			$stats['home']['runs']['yards'] = trim(fread($state, 3));
			fseek($state, self::HOME_PASS);
			$stats['home']['pass'] = trim(fread($state, 4));
			fseek($state, self::HOME_FIRSTS);
			$stats['home']['firsts'] = trim(fread($state, 2));
			
			$stats['away'] = array();
			$stats['away']['runs'] = array();
			fseek($state, self::AWAY_RUNS_ATMPT);
			$stats['away']['runs']['att'] = trim(fread($state, 3));
			fseek($state, self::AWAY_RUNS_YARDS);
			$stats['away']['runs']['yards'] = trim(fread($state, 3));
			fseek($state, self::AWAY_PASS);
			$stats['away']['pass'] = trim(fread($state, 4));
			fseek($state, self::AWAY_FIRSTS);
			$stats['away']['firsts'] = trim(fread($state, 2));
			
			//return team stats
			return $stats;
		}
		
		private function getTeams($state){
			
			$teams = array();
			
			//read team abbriviations from their respective locations
			fseek($state, self::HOME_TEAM_ABBRV);
			$teams['home'] = trim(fread($state, 4));
			
			fseek($state, self::AWAY_TEAM_ABBRV);
			$teams['away'] = trim(fread($state, 4));
			
			//return the team abbreviations
			return $teams;
		}
		
		private function getScores($state){
				
			//goto location in file
			fseek($state, self::SCORE_LOC);
			
			$scores = array();
			$scores['home'] = array();
			$scores['away'] = array();
			
			//parse scores from their locations
			// home
			$scores['home']['q1'] = trim(bin2hex(fread($state, 1)));
			$scores['home']['q2'] = trim(bin2hex(fread($state, 1)));
			$scores['home']['q3'] = trim(bin2hex(fread($state, 1)));
			$scores['home']['q4'] = trim(bin2hex(fread($state, 1)));
			$scores['home']['total'] = trim(bin2hex(fread($state, 1)));

			// away
			$scores['away']['q1'] = trim(bin2hex(fread($state, 1)));
			$scores['away']['q2'] = trim(bin2hex(fread($state, 1)));
			$scores['away']['q3'] = trim(bin2hex(fread($state, 1)));
			$scores['away']['q4'] = trim(bin2hex(fread($state, 1)));
			$scores['away']['total'] = trim(bin2hex(fread($state, 1)));

			//return parsed values
			return $scores;
		}
	}

	
?>