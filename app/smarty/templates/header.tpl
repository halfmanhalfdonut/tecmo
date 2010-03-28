<div id="headerContainer" class="clearfix">
	{* TODO: When the user is signed in, this will show "Account" and "Sign Out" instead *}
	<ul id="userMenu" class="horizontal-nav clearfix">
		<li>
			<a href="/tecmo/app/signin.php" id="signin" class="a1">Sign In</a>
		</li>
		<li>
			<a href="/tecmo/app/signup.php" id="signup" class="a1">Sign Up</a>
		</li>
	</ul>
	<ul id="menu" class="horizontal-nav clearfix">
		<li>
			<a href="/tecmo/app/" id="home"><img src="{$smarty.const.IMG_DIR}/logo.png" alt="Home" /></a>
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