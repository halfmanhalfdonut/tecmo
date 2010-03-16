<?php
	define('PARANOIA', 17);
	
	class Users {
		
		const USERS_TABLE 		= 'users';
		const USER_EMAIL			= 'email';
		const USER_PASSWORD = 'password';
		const USER_NAME 			= 'username';
		const USER_TYPE 			= 'role'; //either 1 for admin OR 0 for users (defaults to 0)
	
		private $db = false;
		
		function __construct($db = null){
			if(!isset($db)){
				throw new Exception('Users constructor MUST recieve an ADODB connection object.');
			}
			$this->db = $db;
			//$this->db->debug = true;
		}
		//Reset user password - mail random 10 char string
		public function resetPassword($username){
			//valid user
			if($this->db->GetOne('SELECT COUNT(*) FROM `'. self::USERS_TABLE .'` WHERE `'. self::USER_NAME .'` = ? ',$username) == 1)
			{
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
				for($x = 0; $x<10; $x++)
				{
					$tempPassword.=substr($chars,rand(0,58),1);
				}
				mail('john@geared.us', 'TSB Password Reset', 'Your new TSB League password is: '.$tempPassword);
				$tempMsg = $tempPassword; //testing delete in production
				$tempPassword = $this->saltPassword($tempPassword);
				//update db with new password
				$this->db->Execute('UPDATE '. self::USERS_TABLE .' SET password = ?', $tempPassword .' WHERE '. self::USER_NAME .' = ?', $username);
				//email password --- needs to be completed with actual user pasword!!!!!
				return "You will receive an email shortly. ".$tempMsg;
			}		
			return "User not found.";
		}
		public function changeUserType($username,$newType){
			$acceptableTypeValues = array(1,0);
			
			//check if new type is a valid user type
			if(!in_array($newType,$acceptableTypeValues)){
				throw new Exception('Users changeUserType() Error - User type '.$newType.' NOT acceptable. MUST be 1 OR 0');
			}
			
			//check that user exists
			if($this->db->GetOne('SELECT COUNT(*) FROM `'. self::USERS_TABLE .'` WHERE `'. self::USER_NAME .'` = ? ',$username) == 1){
				
				//even though we know this is a valid user id because we have come this far, why not be extra safe? Safety is NO ACCIDENT!
				$username =mysql_escape_string($username);
				//user exists, update their user type
				$this->db->AutoExecute(self::USERS_TABLE, array(self::USER_TYPE=>$newType), 'UPDATE' , self::USER_NAME.' = "'.$username.'"');
			}
			else{
				throw new Exception('Users changeUserType() Error - User '.$username.' does NOT exist in users table.');
			}
		}
		
		public function login($username,$password){
			
			//load user info
			$userDetails = $this->db->GetRow('SELECT * FROM `'. self::USERS_TABLE .'` WHERE `'. self::USER_NAME .'` = ? 
				AND '. self::USER_PASSWORD .' = ? ',array($username,$this->saltPassword($password)));
			
			//make sure there was a user with provided username and password
			if(!empty($userDetails)){
				//set session info to match user info
				$_SESSION['userType'] = ($userDetails[self::USER_TYPE]  == 1? 'admin' : 'user');
				$_SESSION['userName'] = $userDetails[self::USER_NAME];
				$_SESSION['loggedIn'] = true;
				return true;
			}
			else{
			
				//user does not exist
				return false;
			}
		}
		
		public function deleteUsers($deleteNames){
			//make sure an array is received
			
			if(!is_array($deleteNames)) throw new Exception('Users deleteUsers() -> MUST receive an ARRAY');
			
			//this can be updated to delete more than one at a time.
			foreach($deleteNames as $username){
				$this->db->Execute('DELETE FROM '. self::USERS_TABLE .' WHERE '. self::USER_NAME .' = ?',array($username));				
			}
		}
		
		public function isAdmin(){
			return $_SESSION['userType'] == 'admin';
		}
		
		public function userName(){
			return $_SESSION['userName'];
		}
		
		public function userEmail(){
			return $_SESSION['userEmail'];
		}
		
		public function isLoggedIn(){
			return $_SESSION['loggedIn'] == true;
		}
		
		public function createUser($email,$password,$username){
		
			//check if email is valid format
			if($this->emailValid($email)){
			
				//check that username is not in use
				if($this->usernameAvailable($username)){
					
					//check that password is not empty
					if(strlen($password) > 0){
					
						//all checks are good, create user
						$this->saveUser($email,$password,$username);
						return true;
					}
					else{
						return 'Password cannot be left blank';
					}
				}
				else{
					return 'Email In Use';
				}
			}
			else{
				return 'Invalid Email Address';
			}
		}
		
		public function checkLoginInfo($username,$password){
		
			//check that there is a username and password that match supplied information
			return ($this->db->GetOne('SELECT COUNT(*) FROM `'. self::USERS_TABLE .'` WHERE `'. self::USER_NAME .'` = ? 
				AND '. self::USER_PASSWORD .' = ? ',array($username,$this->saltPassword($password))) == 1);
		}
		
		
		public function emailAvailable($email){
		
			//check if supplied email is already being used
			return ($this->db->GetOne('SELECT COUNT(*) FROM `'. self::USERS_TABLE .'` WHERE `'. self::USER_EMAIL .'` = ? ',$email) == 0);
		}
		
		public function usernameAvailable($username){
		
			//check if supplied email is already being used
			return ($this->db->GetOne('SELECT COUNT(*) FROM `'. self::USERS_TABLE .'` WHERE `'. self::USER_NAME .'` = ? ',$username) == 0);
		}
		
		
		public function emailValid($email) {
		
			//validate email address format
			return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		}
		
		public function getTableNames(){
			$tableNames = array(self::USERS_TABLE);
			
			return $tableNames;
		}
		
		public function getUsers(){
		
			//return all users ordered by user id
			return $this->db->GetAll('SELECT * FROM '. self::USERS_TABLE .' WHERE 1 ORDER BY '. self::USER_NAME .' ASC ');
		}
		
		private function saveUser($email,$password,$username){
		
			//insert new user data into users table
			$record[self::USER_EMAIL] = $email;
			
			$record[self::USER_NAME] = $username;

			//encrypt user password
			$record[self::USER_PASSWORD] = $this->saltPassword($password); 
			
			//default to regular user
			$record[self::USER_TYPE] = 0;

			$this->db->AutoExecute(self::USERS_TABLE,$record,'INSERT');
		}
		
		private function saltPassword($password) {
			
			//create a salt encoded in sha1 made from the password + the password in reverse
			$salt	= sha1($password . strrev($password));
			
			// Digest the password an arbitrary amount of times for added difficulty
			for ($i = 0; $i < PARANOIA; $i++) {
				$password = sha1($password);
			}
			
			// Append the salt to the digested password
			$password .= $salt;
			
			// return the password
			return $password;
		}
		
		public function createUsersTable(){
			$this->db->Execute("DROP TABLE IF EXISTS ". self::USERS_TABLE .";");

			$this->db->Execute("
				CREATE TABLE IF NOT EXISTS `". self::USERS_TABLE ."` (
				  `". self::USER_EMAIL ."` text NOT NULL,
				  `". self::USER_PASSWORD ."` varchar(1000) NOT NULL,
				  `". self::USER_NAME ."` varchar(15) NOT NULL,
				  `". self::USER_TYPE ."` int(1) NOT NULL,
				  PRIMARY KEY (`". self::USER_NAME ."`)
				) ENGINE=MyISAM;
			");
		}

	}
?>