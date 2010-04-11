<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:11:"F1594713711";a:2:{i:0;s:80:"C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\signIn.tpl";i:1;i:1271007472;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-04-11 18:40:05
         compiled from "C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\signIn.tpl" */ ?>
<div id="signUpWrapper">
	<a href="#" id="close"><span class="seo">close</span></a>
	<fieldset id="login">
		<legend>Login:&nbsp;</legend>
		<form  id="loginForm" name="loginForm" method="POST" action="signin.php" onSubmit="return wambo.validate(this);" >
			<ul class="labelsInputs">
				<li><input id="usernameLogin" name="usernameLogin" <?php if ($_smarty_tpl->getVariable('newUserName')->value){?>value="<?php echo $_smarty_tpl->getVariable('newUserName')->value;?>
"<?php }?> />Username:</li>
				<li><input id="password" type="password" name="password" />Password:</li>
			</ul>
			<input type="submit" value="Submit!" class="submit" />
		</form>	
	</fieldset>
</div>