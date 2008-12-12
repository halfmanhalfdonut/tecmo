<?php

	class Valid {
		public function __construct() {}
		
		public static function nameValid($tag = '',$name) {
			if (trim($name) == "") {
				throw new Exception("No ".$tag." provided.");
				return false;
			} else {
				if (!preg_match('/\w+/',$name)) {
					throw new Exception($tag." not alphanumeric.");
					return false;
				}
			}
			return true;
		}
		
		public static function passValid($password) {
			if (trim($password) == "") {
				throw new Exception("No password entered.");
				return false;
			}
			return true;
		}
		
		public static function dateValid($date) {
			return true;
		}
		
		public static function emailValid($email) {
			return true;
		}
		
		public static function scoreValid($score) {
			return true;
		}
	}
	
?>