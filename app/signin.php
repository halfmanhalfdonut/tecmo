<?php
	require_once('classes/Main.php');
	require_once('classes/Users.php');
	$user = new Users($db);
	
	$login = isset($_POST['usernameLogin']) ? true : false;
	$ajax = isset($_GET['fetch']) ? true : false;
	$ajaxPost = isset($_POST['fromAjax']) ? $_POST['fromAjax'] : false;
	$errors = array();
	
	if ($login) {
		if(!empty($_POST['usernameLogin']) && !empty($_POST['password'])){
			if($user->checkLoginInfo($_POST['usernameLogin'],$_POST['password'])){
				
				//login user
				if ($user->login($_POST['usernameLogin'],$_POST['password'])){
					// nothing?
					if ($ajaxPost) echo "({ loggedIn : true, name : \"".$_SESSION['userName']."\" })";
				}
				else{
					$errors[]= 'LOGIN FAILED!'; //this would be strange, but hey...
				}
			}
			else{
					$errors[]= 'LOGIN FAILED! - Supplied Username and Password did not match any registered user!';
			}
		}
		
		//send error messages to template
		if(!empty($errors)){
			if ($ajaxPost) {
				$count = 1;
				echo "({ errors: '";
				foreach($errors as $error) {
					if ($count == 1) echo "$error";
					else echo "<br /> $error";
					$count++;
				}
				echo "'})";
			}
			$smarty->assign('errors',$errors);
		}
		
		if ($ajaxPost) exit;
	}
	
	if ($ajax) {
		$smarty->assign('fromAjax', true);
		$smarty->display('signin.tpl');
	} else {
		$smarty->assign('fromAjax', false);
		$smarty->assign('smartyBody', 'signin.tpl');
		$smarty->assign('pageTitle','Wambo Tecmo League - Sign in');
		$smarty->display('index.tpl');
	}