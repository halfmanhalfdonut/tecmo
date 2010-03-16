{assign var='thisPage' value='editGame.php'}
<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/editGame.css" />
<script language="JavaScript" src="{$smarty.const.JS_DIR}/editGame.js"></script>
<html>
	<body>
		<div id="gameStatsContainer">
		
		{if $notice}
			<p id="notices">
			Notices:<br />
			{foreach from=$notice item=thisNotice}			
				{$thisNotice}<br />
			{/foreach}
			</p>
		{else}
			{if $thisGame}
				<table border="1">
					<tr>
						{foreach from=$gameHeaders item=thisHeader}
							<th>
								{$thisHeader}
							</th>
						{/foreach}
						</tr>
					<tr>
					{foreach from=$thisGame key=index item=value}
						<td>
							{$value}&nbsp;
						</td>
					{/foreach}
					</tr>
				</table>
			{/if}
			{if $gamePlayers}
				<table border="1">
					<tr>
					{foreach from=$playerHeaders item=thisHeader}
								<th>
									{$thisHeader}
								</th>

					{/foreach}
					</tr>
					{foreach from=$gamePlayers item=thisPlayer}
						<tr>
							{foreach from=$thisPlayer key=index item=value}
								<td>
									{$value}&nbsp;
								</td>
							{/foreach}
						</tr>
					{/foreach}
				</table>
			{/if}
			<form action="{$thisPage}" method="GET">
				<input type="hidden" name="gameId" value="{$smarty.get.gameId}">
				<input type="hidden" name="delete" value="true">
				<input type="submit" value="deleteGame" />
			</form>
		{/if}
		<a href="admin.php">Return to admin page</a>
		</div>
	</body>
</html>