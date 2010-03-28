<div id="signUpWrapper">
	<a href="#" id="close"><span class="seo">close</span></a>
	<fieldset id="createUser">
		<legend>Sign up:&nbsp;</legend>
		<form id="createForm" name="createForm" method="POST" action="/sign-up/" onsubmit="return wambo.validate(this);" >
			<ul class="labelsInputs">
				<li><input id="email1" name="email1" />Email:</li>
				<li><input id="email2" name="email2" />Confirm Email:</li>
				<li><input id="usernameCreate" name="usernameCreate" maxlength="15" />Username: (15 chars max)</li>
				<li><input id="password1" type="password" name="password1" />Password:</li>
				<li><input id="password2" type="password" name="password2" />Confirm Password:</li>
			</ul>
			<input type="submit" value="Submit" />
		</form>
	</fieldset>
</div>