<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:11:"F1486971737";a:2:{i:0;s:80:"C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\signin.tpl";i:1;i:1271008373;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-04-11 18:52:59
         compiled from "C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\signin.tpl" */ ?>
<div id="signUpWrapper">
	<?php if ($_SESSION['loggedIn']){?>
		Welcome, <?php echo $_SESSION['userName'];?>
!
	<?php }else{ ?>
		<fieldset id="login">
			<legend>Login:&nbsp;</legend>
			<form  id="loginForm" name="loginForm" method="POST" action="signin.php" onSubmit="return wambo.validate(this);" >
				<ul class="labelsInputs">
					<li><input id="usernameLogin" name="usernameLogin" <?php if ($_smarty_tpl->getVariable('newUserName')->value){?>value="<?php echo $_smarty_tpl->getVariable('newUserName')->value;?>
"<?php }?> />Username:</li>
					<li><input id="password" type="password" name="password" />Password:</li>
				</ul>
				<?php if ($_smarty_tpl->getVariable('fromAjax')->value){?>
					<input type="hidden" id="fromAjax" name="fromAjax" value="true" />
				<?php }?>
				<input type="submit" value="Submit!" class="submit" />
			</form>	
		</fieldset>
	<?php }?>
</div>