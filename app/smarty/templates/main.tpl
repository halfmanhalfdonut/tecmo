{assign var='thisPage' value='main.php'}
<html>
	<body>
		<p style="clear: both;"></p>
		Hello, <b>{$userName}</b>!<br />
		<br />
		<div id="pickable">
			Nothing to do yet. :(
		</div>
		{if $allGames}
			<fieldset id="gamesList">
				<legend>
					Game Stats
				</legend>
				<table border="1">
					<tr>
						<th colspan="12">
							Home
						</th>
						<th colspan="12">
							Away
						</th>
					</tr>
					<tr>
						<td>
							Player/Team
						</td>
						<td>
							Scores:
						</td>
						<td>
							Q1
						</td>
						<td>
							Q2
						</td>
						<td>
							Q3
						</td>
						<td>
							Q4
						</td>
						<td>
							Total
						</td>
						<td>
							Rushes:
						</td>
						<td>
							Attempted
						</td>
						<td>
							Yrds
						</td>
						<td>
							Passing Yrds
						</td>
						<td>
							1st Downs
						</td>
						<td>
							Player/Team
						</td>
						<td>
							Scores:
						</td>
						<td>
							Q1
						</td>
						<td>
							Q2
						</td>
						<td>
							Q3
						</td>
						<td>
							Q4
						</td>
						<td>
							Total
						</td>
						<td>
							Rushes:
						</td>
						<td>
							Attempted
						</td>
						<td>
							Yrds
						</td>
						<td>
							Passing Yrds
						</td>
						<td>
							1st Downs
						</td>
					</tr>
					
				</table>
			</fieldset>
		{/if}
	</body>
</html>