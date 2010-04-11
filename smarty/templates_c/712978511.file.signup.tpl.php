<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:10:"F211449766";a:2:{i:0;s:80:"C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\signup.tpl";i:1;i:1271008357;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-04-11 18:53:02
         compiled from "C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\signup.tpl" */ ?>
<div id="signUpWrapper">
	<?php if ($_SESSION['loggedIn']){?>
		Welcome, <?php echo $_SESSION['userName'];?>
!
	<?php }else{ ?>
		<fieldset id="createUser">
			<legend>Sign up:&nbsp;</legend>
			<form id="createForm" name="createForm" method="POST" action="signup.php" onsubmit="return wambo.validate(this);" >
				<ul class="labelsInputs">
					<li><input id="email1" name="email1" />Email:</li>
					<li><input id="email2" name="email2" />Confirm Email:</li>
					<li><input id="usernameCreate" name="usernameCreate" maxlength="15" />Username: (15 char max)</li>
					<li><input id="password1" type="password" name="password1" />Password:</li>
					<li><input id="password2" type="password" name="password2" />Confirm Password:</li>
				</ul>
				<?php if ($_smarty_tpl->getVariable('fromAjax')->value){?>
					<input type="hidden" id="fromAjax" name="fromAjax" value="true" />
				<?php }?>
				<input type="submit" value="Submit" />
			</form>
		</fieldset>
	<?php }?>
</div>