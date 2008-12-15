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
				if ($this->isUsernameTaken()) {
					$errors[] = "Username already in use. Please choose a different username.";
					return $errors;
				} else if ($this->isEmailTaken($email)) {
					$errors[] = "Email already in use.";
					return $errors;
				}
				$this->saltPassword();
				$rs	= $this->db->Execute("INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?)",array($username, $email, $this->password, $firstName, $lastName, $type));
				return true;
			} else {
				// Invalid user input
				return $errors;
			}
		}
		
		public function checkLogin($username, $password) {
			if ($this->isUsernameValid($username) && $this->isPassValid($password)) {
				$this->username = $username;
				$this->password = $password;
				
				// Check if username exists. If so, check against the DB for a good password
				if ($this->isUsernameTaken()) {
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
						$errors[] = "Password incorrect";
						return $errors;
					}
				} else {
					// Username isn't in the database
					$errors[] = "Username does not exist";
					return $errors;
				}
			} else {
				// Invalid password
				return $errors;
			}
		}
		
		public function changePassword($password, $newPassword, $newPasswordVerified) {
			if ($this->session->loggedIn) {
				if (Valid::nameValid('Username',$this->session->username) && Valid::passValid($password) && Valid::passValid($newPassword)) {
					if ($this->checkUserPass($this->session->username, $password)) {
						// Assure new passwords match.
						if ($newPassword != $newPasswordVerified) {
							$errors[] = "New passwords do not match.";
							return $errors;
						}
						
						// Salt and store the new password
						$this->password = $newPassword;
						$this->saltPassword();
						$rs	= $this->db->Execute("UPDATE users SET password = ? WHERE username = ?",array($this->password,$this->username));
						
						return true;
					} else {
						$errors[] = "Incorrect Password.";
						return $errors;
					}
				}
			} else {
				$errors[] = "You are not logged in!";
				return $errors;
			}
		}
		
		public function resetPassword($email) {
			if ($this->isEmailTaken($email)) {
				// Create a 6-character password from this random list
				$charList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
				$password = "";
				
				while (strlen($password) < 6) {
					$password .= $charList[(rand(0,(strlen($charList)-1))];
				}
				
				// Send email to user
				// 
				//
				
				$this->password = $password;
				$this->saltPassword();
				$rs	= $this->db->Execute("UPDATE users SET password = (?) WHERE email = (?)",array($this->password, $email));
				return true;
			} else {
				$errors[] = "No user registered with this email.";
				return $errors;
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
		
		private function isUsernameTaken() {
			return (bool)$this->db->GetOne("SELECT COUNT(*) FROM users WHERE username = ?",array($this->username));
		}
		
		private function isEmailTaken($email) {
			return (bool)$this->db->GetOne("SELECT COUNT(*) FROM users WHERE email = ?",array($email));
		}
		
		private function isUsernameValid($name) {
			try {
				Valid::isNameValid('Username', $name);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		private function isPasswordValid($password) {
			try {
				Valid::isPassValid($password);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		private function isEmailValid($email) {
			try {
				Valid::isEmailValid($email);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		private function isFirstNameValid($name) {
			try {
				Valid::isNameValid('First Name', $name);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
		
		private function isLastNameValid($name) {
			try {
				Valid::isNameValid('Last Name', $name);
				return true;
			} catch (Exception $e) {
				$errors[] = $e->getMessage();
				return false;
			}
		}
	}
	
?>