<div id="signUpWrapper">
	<a href="#" id="close"><span class="seo">close</span></a>
	<fieldset id="login">
		<legend>Login:&nbsp;</legend>
		<form  id="loginForm" name="loginForm" method="POST" action="/sign-in/" onSubmit="return wambo.validate(this);" >
			<ul class="labelsInputs">
				<li><input id="usernameLogin" name="usernameLogin" {if $newUserName}value="{$newUserName}"{/if} />Username:</li>
				<li><input id="password" type="password" name="password" />Password:</li>
			</ul>
			<input type="submit" value="Submit!" class="submit" />
		</form>	
	</fieldset>
</div>