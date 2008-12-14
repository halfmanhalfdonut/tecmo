<?php
	define('SALT_PRE', 3);
	define('SALT_AFF', 7);
	
	class User {
		private $username;
		private $password;
		private $errors;
		
		public function __construct($database) {
			$this->session	= new Session;
			$this->db		= $database;
		}
		
		public function create($username, $password, $email, $firstName, $lastName, $type) {
			if ($this->isUsernameValid($username) && $this->isPassValid($password) && $this->isEmailValid($email) && $this->isFirstNameValid($firstName) && $this->isLastNameValid($lastName)) {
			
				$this->username = $username;
				$this->password = $password;
				if ($this->usernameTaken()) {
					throw new Exception("Username already in use. Please choose a different username.");
				}
				$this->saltPassword();
				$rs	= $this->db->Execute("INSERT INTO users VALUES(NULL, ?, ?, ?, ?)",array($username, $email, $this->password, $firstName, $lastName, $type));
				return true;
			} else {
				// Invalid user input
				return $errors;
			}
		}
		
		public function checkUserPass($username, $password) {
			if (Valid::nameValid('Username',$username) && Valid::passValid($password)) {
				$this->username = $username;
				$this->password = $password;
				
				$rs = $this->db->Execute("SELECT password FROM users WHERE username = ?",array($this->username));

				// Salt the user-entered password to check against the database
				$this->saltPassword();

				// Remove the SALT_PRE and SALT_AFF
				$this->password = substr(substr($this->password, SALT_PRE), 0, -SALT_AFF);
				
				// Remove the pre/aff salt, and check against the stored password
				if (substr(substr($rs->fields['password'], SALT_PRE), 0, -SALT_AFF) == $this->password) {
					// Password is correct
					return true;
				} else {
					// Password is incorrect
					return false;
				}
			} else {
				// Invalid password
				return false;
			}
		}
		
		public function changePassword($password, $newPassword, $newPasswordVerified) {
			if ($this->session->loggedIn) {
				if (Valid::nameValid('Username',$this->session->username) && Valid::passValid($password) && Valid::passValid($newPassword)) {
					if ($this->checkUserPass($this->session->username, $password)) {
						// Assure new passwords match.
						if ($newPassword != $newPasswordVerified) {
							throw new Exception("New passwords do not match.");
						}
						
						// Salt and store the new password
						$this->password = $newPassword;
						$this->saltPassword();
						$rs	= $this->db->Execute("UPDATE users SET password = ? WHERE username = ?",array($this->password,$this->username));
						
						return true;
					} else {
						throw new Exception("Incorrect Password.");
					}
				}
			} else {
				throw new Exception("You are not logged in!");
			}
		}
		
		public function isUsernameValid($name) {
			try {
				Valid::isNameValid('Username', $name);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		public function isPasswordValid($password) {
			try {
				Valid::isPassValid($password);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		public function isEmailValid($email) {
			try {
				Valid::isEmailValid($email);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		public function isFirstNameValid($name) {
			try {
				Valid::isNameValid('First Name', $name);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		public function isLastNameValid($name) {
			try {
				Valid::isNameValid('Last Name', $name);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		/**********************************/
		/* HERE BE PRIVATE METHODS, MATEY */
		/**********************************/
		
		private function saltPassword() {
			// Get a unique id based on the current time, using rand() to eliminate possible concurrent connection issues
			// Digest and restrict the final string to the SALT_PRE value
			$password	= substr(sha1(uniqid(rand(), true)), 0, SALT_PRE);
			
			// Digest the password an arbitrary amount of times for added difficulty
			for ($i = 0; $i < 1164; $i++) {
				$this->password = sha1($this->password);
			}
			
			// Append the password to the salt
			$password .= $this->password;
			
			// Append the final salt in the same way the first salt was created
			$password .= substr(sha1(uniqid(rand(), true)), 0, SALT_AFF);
			
			// Assign the password
			$this->password = $password;
		}
		
		private function usernameTaken() {
			return (bool)$this->db->GetOne("SELECT COUNT(*) FROM users WHERE username = ?",array($this->username));
		}
	}
	
?>