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
				//header('location: main.php'); No one likes going to main.php so dont send them there
			}
			else{
				$errors[]= 'LOGIN FAILED!'; //this would be strange, but hey...
			}
		}
		else{
				$errors[]= 'LOGIN FAILED! - Supplied Username and Password did not match any registered user!';
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
	$smarty->assign('pageTitle','Wambo Tecmo League');
	$smarty->display('index.tpl');
?>