<?php
	session_start();
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', dirname(dirname(__FILE__)));
	//smarty 
	
		// load Smarty library
		require_once(ROOT . DS . '..' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php');
		
		//create smarty object and make global
		global $smarty;
		$smarty = new Smarty;
		
		//set smarty dirs
		$smarty->template_dir = ROOT . DS . 'smarty' . DS . 'templates';
		$smarty->config_dir   = ROOT . DS . 'smarty' . DS . 'config';
		$smarty->cache_dir    = ROOT . DS . '..' . DS . 'smarty' . DS . 'smarty_cache';
		$smarty->compile_dir  = ROOT . DS . '..' . DS . 'smarty' . DS . 'templates_c';
	
	//END smarty
	
	//is this running local or on a web server? (global var)
	global $isRunningLocal;
	$isRunningLocal = ($_SERVER['SERVER_NAME']=='local.geared.us'?true:false);
	
	//css, javascript Dirs - this check might not be needed anymore...
	if ($isRunningLocal) {
		define('CSS_DIR', 'css');
		define('JS_DIR', 'js');
		define('IMG_DIR', 'images');
	} 
	else {
		define('CSS_DIR', 'css');
		define('JS_DIR', 'js');
		define('IMG_DIR', 'images');
	}

	//adodb
		
		//load adodb library
		require_once(ROOT.DS.'..'.DS.'adodb5'.DS.'adodb.inc.php');
		
		//DB connection information
		/*
		**
		**  CHANGE THIS SERVER TO YOUR REMOTE SERVER, I DON'T HAVE THAT INFO
		**
		*/
		$server = ($isRunningLocal?'127.0.0.1':'127.0.0.1');;
		$user = 'gearedus_tecmo';
		$password = 'tecmo2010';
		$database = 'gearedus_tecmo';
		
		//create DB connection object and make global
		global $db;
		$db = ADONewConnection('mysqli'); 
		//$db->debug = true;
		$db->Connect($server, $user, $password, $database); 
		
		
		
	//END adodb
?>