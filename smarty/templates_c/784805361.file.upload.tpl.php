<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:9:"F80279849";a:2:{i:0;s:65:"/home4/gearedus/public_html/tecmo/app/smarty/templates/upload.tpl";i:1;i:1268065014;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-03-08 09:49:34
         compiled from "/home4/gearedus/public_html/tecmo/app/smarty/templates/upload.tpl" */ ?>
<?php $_smarty_tpl->assign('thisPage','upload.php',null,null);?>
<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/upload.css" />
<script language="JavaScript" src="<?php echo @JS_DIR;?>
/upload.js"></script>
<div id="uploader">
	<p id="notices">
		<?php if ($_smarty_tpl->getVariable('notices')->value){?>Notice(s):<br />
			<?php  $_smarty_tpl->tpl_vars['thisNotice'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('notices')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['thisNotice']->key => $_smarty_tpl->tpl_vars['thisNotice']->value){
?>
				<?php echo $_smarty_tpl->getVariable('thisNotice')->value;?>
<br />
			<?php }} ?>
		<?php }?>
	</p>
	<form id="fileUpload" method="POST" action="<?php echo $_smarty_tpl->getVariable('thispage')->value;?>
" enctype="multipart/form-data">	
		<label for"file">Nestopia File: </label>		
		<input id="file" type="file" name="file" />	
		<input type="hidden" name="MAX_FILE_SIZE" value="20000" />
		<br />
		<input type="button" onclick="checkForm();" value="Upload">
	</form>
	<div id="gameStats">
		<input id="uploadSuccess" type="hidden" value="<?php echo $_smarty_tpl->getVariable('uploadSuccess')->value;?>
" />
		<table id="statsTable" width="100%" border="1">
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center">
					Home Team:&nbsp;<b><?php echo $_smarty_tpl->getVariable('stats')->value['home']['team'];?>
</b>
				</td>
				<td align="center">
					Away Team:&nbsp;<b><?php echo $_smarty_tpl->getVariable('stats')->value['away']['team'];?>
</b> 
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td colspan="2" align="center">
					Score
				</td>
			</tr>
			<tr>
				<td>
					Q1
				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['home']['score']['q1'];?>

				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['away']['score']['q1'];?>

				</td>
			</tr>
			<tr>
				<td>
					Q2
				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['home']['score']['q2'];?>

				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['away']['score']['q2'];?>

				</td>
			</tr>
			<tr>
				<td>
					Q3
				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['home']['score']['q3'];?>

				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['away']['score']['q3'];?>

				</td>
			</tr>
			<tr>
				<td>
					Q4
				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['home']['score']['q4'];?>

				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['away']['score']['q4'];?>

				</td>
			</tr>
			<tr>
				<td>
					Total
				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['home']['score']['total'];?>

				</td>
				<td align="center">
					&nbsp;<?php echo $_smarty_tpl->getVariable('stats')->value['away']['score']['total'];?>

				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					Runs
				</td>
			</tr>
			<tr>
				<td>
					Attempted
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamStats']['runs']['att'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamStats']['runs']['att'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Yards
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamStats']['runs']['yards'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamStats']['runs']['yards'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					Passing Yards
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamStats']['pass'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamStats']['pass'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					First Downs
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamStats']['firsts'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamStats']['firsts'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					<b>Team Leader</b>
				</td>
			</tr>
			
			
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					Runs
				</td>
			</tr>
			<tr>
				<td>
					Player
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamLeader']['runs']['player'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamLeader']['runs']['player'],"&nbsp;"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Attempted Runs
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamLeader']['runs']['att'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamLeader']['runs']['att'],"&nbsp;"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Running Yards
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['teamLeader']['runs']['yards'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['teamLeader']['runs']['yards'],"&nbsp;"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					Pass
				</td>
			</tr>
			<tr>
				<td>
					Player
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['pass']['player'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['pass']['player'],"&nbsp;"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Pass Attempts
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['pass']['att'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['pass']['att'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Passing Yards
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['pass']['yards'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['pass']['yards'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Interceptions Thrown
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['pass']['ints'],"0"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['pass']['ints'],"0"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td align="center" colspan="2">
					Receive
				</td>
			</tr>
			<tr>
				<td>
					Player
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['rec']['player'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['rec']['player'],"&nbsp;"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Catches
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['rec']['catches'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['rec']['catches'],"&nbsp;"),true);?>

				</td>
			</tr>
			<tr>
				<td>
					Yards
				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['home']['rec']['yards'],"&nbsp;"),true);?>

				</td>
				<td align="center">
					<?php echo $_smarty_tpl->smarty->plugin_handler->executeModifier('default',array($_smarty_tpl->getVariable('stats')->value['away']['rec']['yards'],"&nbsp;"),true);?>

				</td>
			</tr>
		</table>
	</div>
</div>