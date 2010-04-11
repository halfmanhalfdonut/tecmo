<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>
			{if $pageTitle}
				{$pageTitle}
			{else}
				Wambo Football League
			{/if}
		</title>
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/reset.css" />
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/fonts.css" />
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/base.css" />
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/index.css" />
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/header.css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<script type="text/javascript">
		{literal}
			var user = {};
		{/literal}
		{if $smarty.session.loggedIn}
			user.loggedIn = true;
			user.name = "{$smarty.session.userName}";
		{else}
			user.loggedIn = false;
			user.name = "";
		{/if}
		</script>
		<script type="text/javascript" src="{$smarty.const.JS_DIR}/index.js"></script>
		<script type="text/javascript" src="{$smarty.const.JS_DIR}/header.js"></script>
		<script type="text/javascript" src="{$smarty.const.JS_DIR}/user.js"></script>
		<script type="text/javascript" src="{$smarty.const.JS_DIR}/form.js"></script>
	</head>
	<body>