<?php
	
	require_once('classes/Main.php');
	require_once('classes/Users.php');
	
	//you might need to run this if you get a smarty error about "filemtime() [function.filemtime]: stat failed" blah blah
	//$smarty->clear_compiled_tpl();
	
	//phpinfo();
	
	$user = new Users($db);
	
	//array used to store login errors
	$errors = array();
	
	//Password Reset - i dont know if this should be done here but if we going to use it here we should ask for more than just their user name.
	//maybe user name and email but i think there should be an option for this once the user logs in
	if(isset($_POST['reset'])&& ($_POST['username']!=null)){
		$errors[]=$user->resetPassword($_POST['username']);
	}
	//login existing user
	if(!empty($_POST['usernameLogin']) && !empty($_POST['password'])){
		if($user->checkLoginInfo($_POST['usernameLogin'],$_POST['password'])){
			
			//login user
			if ($user->login($_POST['usernameLogin'],$_POST['password'])){
				
				//login successful - test message displayd.
				header('location: main.php');
			}
			else{
				$errors[]= 'LOGIN FAILED!'; //this would be strange, but hey...
			}
		}
		else{
				$errors[]= 'LOGIN FAILED! - Supplied Username and Password did not match any registered user!';
		}
	}//create new user
	elseif( isset($_POST['email1']) ){
		$showForm ='create';

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
					$errors[]= $_POST['email1'].' is NOT a valid email address';
					
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
					$user->createUser($_POST['email1'],$_POST['password1'],$_POST['usernameCreate']);
					
					//send success messages to template
					$smarty->assign('newUserName',$_POST['usernameCreate']);
					$smarty->assign('newUserEmail',$_POST['email1']);
					
					//show login form
					$showForm = 'login';
					
				}
			}
		}
	}
		
	//redirect messages
	if(isset($_GET['message'])){
		
		$errors[]='You have been redirected to the login page for one of the following reasons --';
		
		if($_GET['message'] == 1){
			$errors[]='You tried to access a page without being logged in first.';
			$errors[]='You were logged out due to a period of inactiviy.';
		}
		elseif($_GET['message'] == 2){
			$errors[]='You were logged out due to a period of inactiviy.';
			$errors[]='You tried to access an admin page without admin rights.';
		}
	}
	
	//send error messages to template
	if(isset($errors)){
		$smarty->assign('errors',$errors);
	}
	
	//used to tell if the create user panel should be shown or not
	$smarty->assign('showForm',$showForm);
	
	//set page title, display header and index
	$smarty->assign('pageTitle','TECMO Super Bowl');
	$smarty->display('index.tpl');
?>