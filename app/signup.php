<?php
	require_once('classes/Main.php');
	require_once('classes/Users.php');
	
	$user = new Users($db);
	
	$create = isset($_POST['email1']) ? true : false;
	$ajax = isset($_GET['fetch']) ? true : false;
	$ajaxPost = isset($_POST['fromAjax']) ? $_POST['fromAjax'] : false;
	$errors = array();
	
	if ($create) {
		//make sure all fields have data
		if(empty($_POST['email1'])) $errors[]= 'Email field is empty';
		if(empty($_POST['email2'])) $errors[]= 'Confirm Email field is empty';
		if(empty($_POST['usernameCreate'])) $errors[]= 'User Name field is empty';
		if(empty($_POST['password1'])) $errors[]= 'Password field is empty';
		if(empty($_POST['password2'])) $errors[]= 'Confirm Password field is empty';
		
		//all fields set, time to check
		if(empty($errors)){
		
			//check that email and passwords match
			if($_POST['email1'] != $_POST['email2']) $errors[]= 'Email fields do not match';
			if($_POST['password1'] != $_POST['password2']) $errors[]= 'Password fields do not match';
			
			//fields match - check that email is valid and available
			if(empty($errors)){
				if(!$user->emailValid($_POST['email1'])){
					//invalid email
					$errors[]= $_POST['email1'].' is not a valid email address';
					
				}//valid email, check if it is being used
				elseif(!$user->emailAvailable($_POST['email1'])){
					//email in use
					$errors[]= 'Email address already in use';
					
				}
				elseif(!$user->userNameAvailable($_POST['usernameCreate'])){
					//user name in use
					$errors[]= 'User Name already in use';
					
				}//email is valid and not in use, user name is not in use, password is not empty. MAKE THAT USER!
				else{
					//make user
					$createStatus = $user->createUser($_POST['email1'],$_POST['password1'],$_POST['usernameCreate']);
					if ($createStatus == true) {
						if ($user->login($_POST['usernameCreate'],$_POST['password1'])){
							// nothing?
							if ($ajaxPost) echo "({ loggedIn : true, name : \"".$_SESSION['userName']."\" })";
						} else{
							$errors[]= 'LOGIN FAILED!'; //this would be strange, but hey...
						}
						//send success messages to template
						$smarty->assign('newUserName',$_POST['usernameCreate']);
						$smarty->assign('newUserEmail',$_POST['email1']);
					} else {
						$errors[]= $createStatus;
					}
				}
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
		$smarty->display('signup.tpl');
	} else {
		$smarty->assign('fromAjax', false);
		$smarty->assign('smartyBody', 'signup.tpl');
		$smarty->assign('pageTitle','Wambo Tecmo League - Sign up');
		$smarty->display('index.tpl');
	}