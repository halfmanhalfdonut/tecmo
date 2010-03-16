<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:10:"F622578742";a:2:{i:0;s:64:"/home4/gearedus/public_html/tecmo/app/smarty/templates/index.tpl";i:1;i:1268065013;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-03-08 09:17:01
         compiled from "/home4/gearedus/public_html/tecmo/app/smarty/templates/index.tpl" */ ?>
<?php $_smarty_tpl->assign('thisPage','index.php',null,null);?>
<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/index.css" />
<script language="JavaScript" src="<?php echo @JS_DIR;?>
/prototype.js"></script>
<script language="JavaScript" src="<?php echo @JS_DIR;?>
/index.js"></script>
<html>
	<body>
		<input type="hidden" id="showForm" value="<?php echo $_smarty_tpl->getVariable('showForm')->value;?>
" />
		<div id="loginContainer">			
			<?php if ($_smarty_tpl->getVariable('newUserName')->value){?>
				<p id="welcome">Welcome, <?php echo $_smarty_tpl->getVariable('newUserName')->value;?>
! Please re-enter your password to sign in for the first time!</p><br />
			<?php }?>
			<div id="optionsContainer">
				Existing user?&nbsp;<p onclick="toggleDisplay('login');"  class="fakeAnchor" >Login</p>&nbsp;&nbsp;&nbsp;
				New user?&nbsp;<p onclick="toggleDisplay('create');" class="fakeAnchor">Create an account</p>
			</div>
			<fieldset id="createUser">
				<legend>Create User:&nbsp;</legend>
				<form id="createForm" name="createForm" method="POST" action="<?php echo $_smarty_tpl->getVariable('thisPage')->value;?>
" onsubmit="return validate(this);" >
					<ul class="labelsInputs">
						<li><input id="email1" name="email1" />Email:</li>
						<li><input id="email2" name="email2" />Confirm Email:</li>
						<li><input id="usernameCreate" name="usernameCreate" maxlength="15" />Username: (15 chars max)</li>
						<li><input id="password1" type="password" name="password1" />Password:</li>
						<li><input id="password2" type="password" name="password2" />Confirm Password:</li>
					</ul>					<input type="submit" value="Submit!" class="Submit" />
				</form>
			</fieldset>
			<fieldset id="login">
				<legend>Login:&nbsp;</legend>
				<form  id="loginForm" name="loginForm" method="POST" action="<?php echo $_smarty_tpl->getVariable('thisPage')->value;?>
 " onsubmit="return validate(this);" >
					<ul class="labelsInputs">
						<li><input id="usernameLogin" name="usernameLogin" <?php if ($_smarty_tpl->getVariable('newUserName')->value){?>value="<?php echo $_smarty_tpl->getVariable('newUserName')->value;?>
"<?php }?> />Username:</li>
						<li><input id="password" type="password" name="password" />Password:</li>
					</ul>
					<input type="submit" value="Submit!" class="submit" />					<input type="submit" value="Reset" name="reset" />
				</form>				<br />
			</fieldset>			
			<div id="notices" >
				<?php if ($_smarty_tpl->getVariable('errors')->value){?>Notice(s):<br />
					<?php  $_smarty_tpl->tpl_vars['thisError'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['thisError']->key => $_smarty_tpl->tpl_vars['thisError']->value){
?>
						<?php echo $_smarty_tpl->getVariable('thisError')->value;?>
<br />
					<?php }} ?>
				<?php }?>
			</div>
		</div>
	</body>
</html>