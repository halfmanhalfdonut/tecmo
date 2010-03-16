<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:11:"F3724318032";a:2:{i:0;s:65:"/home4/gearedus/public_html/tecmo/app/smarty/templates/header.tpl";i:1;i:1268065013;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-03-08 09:18:14
         compiled from "/home4/gearedus/public_html/tecmo/app/smarty/templates/header.tpl" */ ?>
<html>
	<head>
		<title>
			<?php if ($_smarty_tpl->getVariable('pageTitle')->value){?>
				<?php echo $_smarty_tpl->getVariable('pageTitle')->value;?>

			<?php }else{ ?>
				TSB 2010 League
			<?php }?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/index.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
/header.css" />
		<script language="JavaScript" src="js/prototype.js"></script>
	</head>
		<ul id="headerUl">
			<li>
				<a href="main.php">Main Page</a>
			</li>
			<li>
				<a href="upload.php">Upload Page</a>
			</li>
			<?php if ($_SESSION['userType']=="admin"){?>
				<li>
					<a href="admin.php">Admin Page</a>
				</li>
			<?php }?>
			<li>
				<a href="logout.php">Log Out</a>
			</li>
		</ul>
	
	
	
