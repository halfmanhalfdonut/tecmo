<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:9:"F49911148";a:2:{i:0;s:64:"/home4/gearedus/public_html/tecmo/app/smarty/templates/admin.tpl";i:1;i:1268065013;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-03-08 09:49:06
         compiled from "/home4/gearedus/public_html/tecmo/app/smarty/templates/admin.tpl" */ ?>
<?php $_smarty_tpl->assign('thisPage','admin.php',null,null);?>
<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/admin.css" />
<script language="JavaScript" src="<?php echo @JS_DIR;?>
/admin.js"></script>
<html>
	<body>
		<p style="clear: both;" ></p>
		<div >
			<fieldset id="usersField">
				<legend>
					Edit Users
				</legend>
				<form name="editUsers" method="POST" action="<?php echo $_smarty_tpl->getVariable('thisPage')->value;?>
">
					Current Users:<br />
					
						<select name="editUsers[]" id="editUsers" multiple="yes" size="10" >
							<?php if ($_smarty_tpl->getVariable('currentUsers')->value){?>
									<?php  $_smarty_tpl->tpl_vars['thisUser'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('currentUsers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['thisUser']->key => $_smarty_tpl->tpl_vars['thisUser']->value){
?>
										<option value="<?php echo $_smarty_tpl->getVariable('thisUser')->value['username'];?>
">
											<?php echo $_smarty_tpl->getVariable('thisUser')->value['username'];?>
 &nbsp;-&nbsp; <?php echo $_smarty_tpl->getVariable('thisUser')->value['email'];?>
 &nbsp;-&nbsp; <?php if ($_smarty_tpl->getVariable('thisUser')->value['role']==1){?>Admin<?php }else{ ?>User<?php }?>
										</option>
									<?php }} ?>
							<?php }else{ ?>
								<option>Users Table currently EMPTY</option>
							<?php }?>
						</select>
						<br />
						What would you like to do to the selected user(s):
						<select name="editUsersAction" id="editUsersAction" >
							<option value="delete">Delete</option>
							<option value="makeAdmin">Make Admin User</option>
							<option value="makeRegular">Make Regular User</option>
						</select>
						<br />
						<input type="submit" value="Edit Selected" />
				</form>
			</fieldset>
			<fieldset id="resetDbsField" class="resetDbsField">
				<legend>
					Reset/Create Databases
				</legend>
				<form name="dbReset" method="post" action="<?php echo $_smarty_tpl->getVariable('thisPage')->value;?>
">
					Reset DB: &nbsp;
					<select id="reset" name="reset">
						<option value="users">Users</option>
						<option value="games" >Games</option>
					</select>
					<br />
					Are you sure? This will delete all table data! 
					<br />
					No&nbsp;<input type="radio" name="confirm" value="false" checked onclick="toggleWarning();" />
					Yes&nbsp;<input type="radio" name="confirm" value="true" onclick="toggleWarning();" />
					<br />
					<input type="submit" value="I am sure!" id="resetButton">
				</form>
			</fieldset>
		</div>
	</body>
</html>