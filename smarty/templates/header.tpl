<html>
	<head>
		<title>
			{if $pageTitle}
				{$pageTitle}
			{else}
				Football Bowl Pickem
			{/if}
		</title>
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/main.css" />
	</head>
	<body>
		
		<ul>
			{if $smarty.session.loggedIn}
				<li>
					<a href="main.php">Home</a>
				</li>
				{if $smarty.session.userType == 1}
					<li>
						<a href="admin.php">Admin panel</a>
					</li>
				{/if}
				<li>
					<a href="logout.php">Logout</a>
				</li>
			{/if}
		</ul>
	</body>
</html>