<?php

	class Valid {
		public function __construct() {}
		
		
		public static function isValidArray($check = array()){
			$invalid = array();
			
			foreach($check as $type => $value){
				$validFunction = 'is'.$type.'Valid';
				if(!$this->$validFunction($value)){
					$invalid [$type][]= $value;
				}
			}
			
			if(!count($invalid)){
				return true;
			}
			else{
				return $invalid;
			}
		}
		
		public static function isNameValid($tag = 'name', $name) {
			if (trim($name) == "") {
				// Name is empty
				throw new Exception("No ".$tag." provided.");
			} else {
				if (!preg_match('/\w+/',$name)) {
					// Not alphanumeric
					throw new Exception($tag." must be alphanumeric (a-z, 0-9).");
				}
			}
			return true;
		}
		
		public static function isPassValid($password) {
			if (trim($password) == "") {
				// Password is empty
				throw new Exception("Password is empty.");
			} else {
				if (!preg_match('/\w+/', $password)) {
					// Password isn't alphanumeric
					throw new Exception("Password must be alphanumeric (a-z, 0-9).");
				}
			}
			// Password is valid
			return true;
		}
		
		public static function isDateValid($date) {
			if (trim ($date) == "") {
				// Date is empty
				throw new Exception("No date provided");
			} else {
				if (!preg_match('/(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])/', $date)) {
					// Date is of an invalid format
					throw new Exception("Date invalid");
				}
			}
			// Date is a-ok
			return true;
		}
		
		public static function isEmailValid($email) {
			if (trim($email) == "") {
				// No email
				throw new Exception("No email provided");
			} else {
				if (!preg_match('^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$', $email)) {
					// Email is of an invalid format
					throw new Exception("Email invalid");
				}
			}
			// Email address is a-ok
			return true;
		}
		
		public static function isScoreValid($score) {
			if (trim($score) == "") {
				// Score empty
				throw new Exception("No score provided");
			} else {
				if (!is_numeric($score)) {
					// Score isn't numeric
					throw new Exception("Score must be numeric");
				}
			}
			// Score is ok
			return true;
		}
	}
	
?>