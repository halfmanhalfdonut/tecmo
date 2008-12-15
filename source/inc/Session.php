<?php
	//sean test commit <- delete this stupid line
	define("COOKIE_EXPIRE", 60*60*24*90);  // 90 Days
	define("COOKIE_PATH", "/");  //Available in whole domain

	class Session {
	
		var $loggedIn;
		var $referrer; // referring URL (used for redirecting)
		//var $lastActivity; //to log out users after a certain period of time
		
		public function __construct(){
			$this->startSession();
		}
		
		private function startSession() {
			session_start();
			
			$this->loggedIn = false;
			
			$this->referrer = isset($_SESSION['url']) ? $_SESSION['url'] : "/";
		}
		
		//check if password and email are set in cookie and if valid
		private function checkCookie(){
			
			if (empty($_COOKIE['email'])	|| empty($_COOKIE['password'])) {
			
				return false;
			}
			else{
				//validate email and password with db, return true or false depending
				//dont forget cookie password is stored as sha1 already
			}
		}
		
		private function isLoggedIn(){
			
			//check if session variable is set
			if($this->loggedIn == false){
				return checkCookie();
			}
			else{
				return true;
			}
		}
		
		public function login($email = false, $password = false) {
			
			//set session variables
			$this->loggedIn = true;
			
			if($email && $password){
				//set cookie
				
				//cookie expiration period
				$days = 60;
				$hours = 0;
				$minutes = 0;
				//this is gonna get way funkier but i got an idea for the cookie i will try later
				setcookie(urlencode($email), urlencode(sha1($password)), time() + ((((($days * 24) + $hours) * 60) + $minutes ) * 60));
			}
			
			return true;
		}
		
		
		public function logout() {
			
			// Unset session variables.
			foreach($_SESSION as &$thisIndex){
				unset($thisIndex);
			}
			
			session_destroy();
		}
	}
	
?>