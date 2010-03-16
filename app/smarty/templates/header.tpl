<html>
	<head>
		<title>
			{if $pageTitle}
				{$pageTitle}
			{else}
				TSB 2010 League
			{/if}
		</title>
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/index.css" />
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/header.css" />
		<script language="JavaScript" src="js/prototype.js"></script>
	</head>
		<div id="headerContainer">
			You are currently logged in as <b>{$smarty.session.userName}</b>
			<ul id="headerUl">
				<li>
					<a href="main.php">Main Page</a>
				</li>
				<li>
					<a href="upload.php">Upload Page</a>
				</li>
				{if $smarty.session.userType == "admin"}
					<li>
						<a href="admin.php">Admin Page</a>
					</li>
				{/if}
				<li>
					<a href="logout.php">Log Out</a>
				</li>
			</ul>
			
		</div>