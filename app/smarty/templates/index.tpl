{assign var='thisPage' value='index.php'}
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/index.css" />
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
		<script type="text/javascript">
			var toggleDisplay = function(show){
					if(show=="login")
					{
						$("#login").show();
						$("#createUser").hide();
					}
					else
					{
						$("#login").hide();
						$("#createUser").show();
					}
						
				}
			$(document).ready(function(){
				$("#createUser").hide();
				$("#login").hide();

			});
		</script>
	</head>
	<body>
		<input type="hidden" id="showForm" value="{$showForm}" />
		<div id="loginContainer">			
			{if $newUserName}
				<p id="welcome">Welcome, {$newUserName}! Please re-enter your password to sign in for the first time!</p><br />
			{/if}
			<div id="optionsContainer">
				<p onclick="toggleDisplay('login');"  class="fakeAnchor" >Login</p>&nbsp;&nbsp;&nbsp;
				<p onclick="toggleDisplay('create');" class="fakeAnchor">Create an account</p>
			</div>
			<fieldset id="createUser">
				<legend>Create User:&nbsp;</legend>
				<form id="createForm" name="createForm" method="POST" action="{$thisPage}" onsubmit="return validate(this);" >
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
				<form  id="loginForm" name="loginForm" method="POST" action="{$thisPage} " onsubmit="return validate(this);" >
					<ul class="labelsInputs">
						<li><input id="usernameLogin" name="usernameLogin" {if $newUserName}value="{$newUserName}"{/if} />Username:</li>
						<li><input id="password" type="password" name="password" />Password:</li>
					</ul>
					<input type="submit" value="Submit!" class="submit" />					<input type="submit" value="Reset" name="reset" />
				</form>				<br />
			</fieldset>			
			<div id="notices" >
				{if $errors}Notice(s):<br />
					{foreach from=$errors item=thisError}
						{$thisError}<br />
					{/foreach}
				{/if}
			</div>
		</div>
	</body>
</html>