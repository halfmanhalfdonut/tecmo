<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:11:"F2039728125";a:2:{i:0;s:79:"C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\index.tpl";i:1;i:1271006247;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-04-11 18:18:15
         compiled from "C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\index.tpl" */ ?>
<?php $_template = new Smarty_Template ("head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id,  $_smarty_tpl->compile_id);$_template->caching = 0; echo $_template->getRenderedTemplate();  unset($_template);  $_template = new Smarty_Template ("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id,  $_smarty_tpl->compile_id);$_template->caching = 0; echo $_template->getRenderedTemplate();  unset($_template); ?>

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

<?php $_template = new Smarty_Template ($_smarty_tpl->getVariable('smartyBody')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id,  $_smarty_tpl->compile_id);$_template->caching = 0; echo $_template->getRenderedTemplate();  unset($_template);  $_template = new Smarty_Template ("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id,  $_smarty_tpl->compile_id);$_template->caching = 0; echo $_template->getRenderedTemplate();  unset($_template); ?>