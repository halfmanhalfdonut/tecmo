<div id="headerContainer" class="clearfix">
	<!-- default user controls, hides when user signs in-->
	<ul id="userMenu" class="horizontal-nav clearfix">
		<li>
			<a href="/tecmo/app/signin.php" id="signin" class="a1">Sign In</a>
		</li>
		<li>
			<a href="/tecmo/app/signup.php" id="signup" class="a1">Sign Up</a>
		</li>
	</ul>
	<ul id="userMenuIn" class="horizontal-nav clearfix">
		<li>
			<a href="/tecmo/app/signin.php" id="signin" class="a1">Account</a>
		</li>
		<li>
			<a href="/tecmo/app/signup.php" id="signup" class="a1">Logout</a>
		</li>
	</ul>

	<!--main nav , always shows-->
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