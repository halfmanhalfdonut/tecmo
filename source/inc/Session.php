<?php
	
	define("COOKIE_EXPIRE", 60*60*24*90);  // 90 Days
	define("COOKIE_PATH", "/");  //Available in whole domain

	class Session {
	
		private $loggedIn;
		private $referrer;
		
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
			if (empty($_COOKIE['username'])) {
				return false;
			} else {
				$this->loggedIn = true;
				return true;
			}
		}
		
		private function isLoggedIn(){
			//check if session variable is set
			if($this->loggedIn == false){
				return checkCookie();
			} else {
				return true;
			}
		}
		
		public function login($username = false, $password = false) {
			//set session variables
			$this->loggedIn = true;
			
			if ($username && $password) {
				$userCheck = User::checkLogin($username, $password);
				if ($userCheck == true) {
					// Login is good, set cookie
					//cookie expiration period
					$days = 90;
					$hours = 0;
					$minutes = 0;
					// just set a cookie with the username encoded
					setcookie("Pickem", urlencode($username), time() + ((((($days * 24) + $hours) * 60) + $minutes ) * 60));
				} else {
					// return errors
					return $userCheck;
				}
			}
			return true;
		}
		
		
		public function logout() {
			// Unset session variables.
			foreach($_SESSION as &$thisIndex){
				unset($thisIndex);
			}
			
			// remove cookie
			setcookie("Pickem", "", time() - 3600);
			session_destroy();
		}
	}
	
?>