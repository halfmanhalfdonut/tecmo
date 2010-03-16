{assign var='thisPage' value='admin.php'}
<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/admin.css" />
<script language="JavaScript" src="{$smarty.const.JS_DIR}/admin.js"></script>
<html>
	<body>
		<p style="clear: both;" ></p>
		<div >
			<fieldset id="usersField">
				<legend>
					Edit Users
				</legend>
				<form name="editUsersForm" method="POST" action="{$thisPage}">
					Current Users:<br />
					
						<select name="editUsers[]" id="editUsers" multiple="yes" size="10" >
							{if $currentUsers}
									{foreach from=$currentUsers item=thisUser}
										<option value="{$thisUser.username}">
											{$thisUser.username} &nbsp;-&nbsp; {$thisUser.email} &nbsp;-&nbsp; {if $thisUser.role == 1}Admin{else}User{/if}
										</option>
									{/foreach}
							{else}
								<option>Users Table currently EMPTY</option>
							{/if}
						</select>
						<br />
						What would you like to do to the selected user(s):
						<select name="editUsersAction" id="editUsersAction" >
							<option value="delete">Delete</option>
							<option value="makeAdmin">Make Admin User</option>
							<option value="makeRegular">Make Regular User</option>
						</select>
						<br />
						<input type="submit" value="Edit Selected" />
				</form>
			</fieldset>
			<fieldset id="resetDbsField" name="resetDbsField" class="resetDbsField">
				<legend>
					Reset/Create Databases
				</legend>
				<form name="dbReset" method="post" action="{$thisPage}">
					Reset DB: &nbsp;
					<select id="reset" name="reset">
						<option value="users">Users</option>
						<option value="game_stats" >Game Stats</option>
						<option value="player_stats" >Player Stats</option>
					</select>
					<br />
					Are you sure? This will delete all table data! 
					<br />
					No&nbsp;<input type="radio" name="confirm" value="false" checked onclick="toggleWarning();" />
					Yes&nbsp;<input type="radio" name="confirm" value="true" onclick="toggleWarning();" />
					<br />
					<input type="submit" value="I am sure!" id="resetButton">
				</form>
			</fieldset>
		</div>
		<div>
			<fieldset id="editGamesField">
				<legend>
					Games
				</legend>
				{if $currentGames}
					<form id="editGamesForm" name="editGamesForm" method="GET" action="editGame.php">
						Flagged games are shown with ** game data ** <br />
						<select name="gameId" id="gameId">
							{foreach from=$currentGames item=thisGame}
								<option value="{$thisGame.game_id}">
									{if $thisGame.flagged}**{/if}
									
									{$thisGame.user_upload}({$thisGame.user_upload_team})&nbsp;as&nbsp;{$thisGame.user_upload_home_away}&nbsp;team
									&nbsp;vs&nbsp;{$thisGame.user_against}({$thisGame.user_against_team})
									&nbsp;&nbsp;
									{if $thisGame.user_upload_home_away == 'home'}
										{$thisGame.home_total_score}--{$thisGame.away_total_score}
									{else}
										{$thisGame.away_total_score}--{$thisGame.home_total_score}
									{/if}

									{if $thisGame.flagged}**{/if}
								</option>
							{/foreach}
						</select>
						<input type="submit" value="Edit Game" />
					</form>
				{else}
					There are currently no saved games
				{/if}
			</fieldset>
		</div>
	</body>
</html>