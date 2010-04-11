<div id="signUpWrapper">
	{if $smarty.session.loggedIn}
		Welcome, {$smarty.session.userName}!
	{else}
		<fieldset id="login">
			<legend>Login:&nbsp;</legend>
			<form  id="loginForm" name="loginForm" method="POST" action="signin.php" onSubmit="return wambo.validate(this);" >
				<ul class="labelsInputs">
					<li><input id="usernameLogin" name="usernameLogin" {if $newUserName}value="{$newUserName}"{/if} />Username:</li>
					<li><input id="password" type="password" name="password" />Password:</li>
				</ul>
				{if $fromAjax}
					<input type="hidden" id="fromAjax" name="fromAjax" value="true" />
				{/if}
				<input type="submit" value="Submit!" class="submit" />
			</form>	
		</fieldset>
	{/if}
</div>