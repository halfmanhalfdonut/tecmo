{assign var='thisPage' value='index.php'}
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/index.css" />
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
		<script type="text/javascript">
			var getData = function(whatData){
				http=new XMLHttpRequest();
				if (http==null)//Check if HTTP Request are supported
				{
					alert("You need to upgrade your browser to continue");
					return;
				}
				http.onreadystatechange=stateChange;
				url="requestHandler.php";
				url+="?xdata="+whatData;
				url+="&sid="+Math.random();
				http.open("GET",url,false);
				http.send(null);
				function stateChange()
				{
					if(http.readyState==4)
						document.getElementById("notices").innerHTML= http.responseText;
				}
			}
			var toggleDisplay = function(show){ //show the appropriate form
				$("#loginContainer").siblings().fadeTo(500,0.5);
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
				//hide forms
				$("#createUser").hide();
				$("#login").hide();
				
				//close form window
				$("div[name^='close']").mousedown(function(){
					$(this).parent().hide();
					$("#loginContainer").siblings().fadeTo(500,1);
				});

			});
		</script>
	</head>
	<body>
		
		<div id="optionsContainer">
			<p onclick="toggleDisplay('login');"  class="fakeAnchor" >Login</p>&nbsp;&nbsp;&nbsp;
			<p onclick="toggleDisplay('create');" class="fakeAnchor">Create an account</p>
		</div>
		<div id="nav">
			<ul><li onclick="getData('home')">Home</li><li onclick="getData('league')">League Info</li>
			<li onclick="getData('standings')">Standings</li><li onclick="getData('teams')">Teams</li>
			<li onclick="getData('players')">Players</li></ul>
		</div>
		<div id="loginContainer">			
			{if $newUserName}
				<p id="welcome">Welcome, {$newUserName}! Please re-enter your password to sign in for the first time!</p><br />
			{/if}
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
				<div id="close" name="close"><a href="#">close</a></div>
			</fieldset>
			<fieldset id="login">
				<legend>Login:&nbsp;</legend>
				<form  id="loginForm" name="loginForm" method="POST" action="{$thisPage} " onsubmit="return validate(this);" >
					<ul class="labelsInputs">
						<li><input id="usernameLogin" name="usernameLogin" {if $newUserName}value="{$newUserName}"{/if} />Username:</li>
						<li><input id="password" type="password" name="password" />Password:</li>
					</ul>
					<input type="submit" value="Submit!" class="submit" />					<input type="submit" value="Reset" name="reset" />
				</form>	
				<div id="close" name="close"><a href="#">close</a></div>
				<br />
			</fieldset>			
		</div>
		<div id="notices" >
			{if $errors}Notice(s):<br />
				{foreach from=$errors item=thisError}
					{$thisError}<br />
				{/foreach}
			{/if}
		</div>
	</body>
</html>