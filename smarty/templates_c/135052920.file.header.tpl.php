<?php if(!defined('SMARTY_DIR')) exit('no direct access allowed'); ?>
<?php $_smarty_tpl->decodeProperties('a:1:{s:15:"file_dependency";a:1:{s:10:"F787085725";a:2:{i:0;s:80:"C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\header.tpl";i:1;i:1271010451;}}}'); ?>
<?php /* Smarty version Smarty3-b5, created on 2010-04-11 19:29:19
         compiled from "C:\Users\Nick\Documents\prog\UniServer\www\tecmo\app\smarty\templates\header.tpl" */ ?>
<div id="headerContainer" class="clearfix">
	<!-- default user controls, hides when user signs in-->
	<?php if ($_SESSION['loggedIn']){?>
	<ul id="userMenuIn" class="horizontal-nav clearfix">
		<li>
			Welcome, <span class="displayUsername"><?php echo $_SESSION['userName'];?>
</span>.
		</li>
		<li>
			<a href="/tecmo/app/account.php" id="signin" class="a1">Account</a>
		</li>
		<li>
			<a href="/tecmo/app/signout.php" id="signup" class="a1">Logout</a>
		</li>
	</ul>
	<ul id="userMenu" class="horizontal-nav clearfix" style="display: none">
		<li>
			<a href="/tecmo/app/signin.php" id="signin" class="a1">Sign In</a>
		</li>
		<li>
			<a href="/tecmo/app/signup.php" id="signup" class="a1">Sign Up</a>
		</li>
	</ul>
	<?php }else{ ?>
	<ul id="userMenuIn" class="horizontal-nav clearfix" style="display: none">
		<li>
			Welcome, <span class="displayUsername"><?php echo $_SESSION['userName'];?>
</span>.
		</li>
		<li>
			<a href="/tecmo/app/account.php" id="signin" class="a1">Account</a>
		</li>
		<li>
			<a href="/tecmo/app/signout.php" id="signup" class="a1">Logout</a>
		</li>
	</ul>
	<ul id="userMenu" class="horizontal-nav clearfix">
		<li>
			<a href="/tecmo/app/signin.php" id="signin" class="a1">Sign In</a>
		</li>
		<li>
			<a href="/tecmo/app/signup.php" id="signup" class="a1">Sign Up</a>
		</li>
	</ul>
	<?php }?>

	<!--main nav , always shows-->
	<ul id="menu" class="horizontal-nav clearfix">
		<li>
			<a href="/tecmo/app/" id="home"><img src="<?php echo @IMG_DIR;?>
/logo.png" alt="Home" /></a>
		</li>
		<li>
			<a href="/tecmo/app/league.php" id="league" class="a2">League Info</a>
		</li>
		<li>
			<a href="/tecmo/app/standings.php" id="standings" class="a2">Standings</a>
		</li>
		<li>
			<a href="/tecmo/app/teams.php" id="teams" class="a2">Teams</a>
		</li>
		<li>
			<a href="/tecmo/app/players.php" id="players" class="a2">Players</a>
		</li>
	</ul>
</div>