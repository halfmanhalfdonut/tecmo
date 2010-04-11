<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:10:"F473278327";a:2:{i:0;s:78:"C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\head.tpl";i:1;i:1271010324;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-04-11 19:25:28
         compiled from "C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\head.tpl" */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>
			<?php if ($_smarty_tpl->getVariable('pageTitle')->value){?>
				<?php echo $_smarty_tpl->getVariable('pageTitle')->value;?>

			<?php }else{ ?>
				Wambo Football League
			<?php }?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/reset.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/fonts.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/base.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/index.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/header.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<script type="text/javascript">
		
			var user = {};
		
		<?php if ($_SESSION['loggedIn']){?>
			user.loggedIn = true;
			user.name = "<?php echo $_SESSION['userName'];?>
";
		<?php }else{ ?>
			user.loggedIn = false;
			user.name = "";
		<?php }?>
		</script>
		<script type="text/javascript" src="<?php echo @JS_DIR;?>
/index.js"></script>
		<script type="text/javascript" src="<?php echo @JS_DIR;?>
/header.js"></script>
		<script type="text/javascript" src="<?php echo @JS_DIR;?>
/user.js"></script>
		<script type="text/javascript" src="<?php echo @JS_DIR;?>
/form.js"></script>
	</head>
	<body>