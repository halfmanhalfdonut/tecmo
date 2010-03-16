{assign var='thisPage' value='upload.php'}
<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}/upload.css" />
<script language="JavaScript" src="{$smarty.const.JS_DIR}/upload.js"></script>
<div id="uploader">
	<p id="notices">
		{if $notices}Notice(s):<br />
			{foreach from=$notices item=thisNotice}
				{$thisNotice}<br />
			{/foreach}
		{/if}
	</p>
	<form id="fileUpload" method="POST" action="{$thispage}" enctype="multipart/form-data">	
		<label for"file">Nestopia File: </label>		
		<input id="file" type="file" name="file" value="{$uploadFile}" />	
		<input type="hidden" name="MAX_FILE_SIZE" value="20000" />
		<p>
			Who were you playing against?&nbsp;
			<select id="against" name="against">
				<option value="none">Select a user...</option>
				{foreach from=$currentUsers item=thisUser}
					{if $smarty.session.userName != $thisUser.username}
						<option value="{$thisUser.username}">
							{$thisUser.username} 
						</option>
					{/if}
				{/foreach}
			</select>
		</p>
		<p>
			Were you the home or away team?&nbsp;
			<select id="homeAway" name="homeAway">
				<option value="none">Choose One...</option>
				<option value="home">Home</option>
				<option value="away">Away</option>
			</select>
			<input type="button" onclick="checkForm();" value="Upload File">
		</p>
	</form>
</div>
<div id="gameStats">
	<input id="uploadSuccess" type="hidden" value="{$uploadSuccess}" />
	<table id="statsTable" width="100%" border="1">
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center">
				Home Team:&nbsp;<b>{$stats['home'].team}</b>
			</td>
			<td align="center">
				Away Team:&nbsp;<b>{$stats['away'].team}</b> 
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td colspan="2" align="center">
				Score
			</td>
		</tr>
		<tr>
			<td>
				Q1
			</td>
			<td align="center">
				&nbsp;{$stats['home'].score.q1}
			</td>
			<td align="center">
				&nbsp;{$stats['away'].score.q1}
			</td>
		</tr>
		<tr>
			<td>
				Q2
			</td>
			<td align="center">
				&nbsp;{$stats['home'].score.q2}
			</td>
			<td align="center">
				&nbsp;{$stats['away'].score.q2}
			</td>
		</tr>
		<tr>
			<td>
				Q3
			</td>
			<td align="center">
				&nbsp;{$stats['home'].score.q3}
			</td>
			<td align="center">
				&nbsp;{$stats['away'].score.q3}
			</td>
		</tr>
		<tr>
			<td>
				Q4
			</td>
			<td align="center">
				&nbsp;{$stats['home'].score.q4}
			</td>
			<td align="center">
				&nbsp;{$stats['away'].score.q4}
			</td>
		</tr>
		<tr>
			<td>
				Total
			</td>
			<td align="center">
				&nbsp;{$stats['home'].score.total}
			</td>
			<td align="center">
				&nbsp;{$stats['away'].score.total}
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				Runs
			</td>
		</tr>
		<tr>
			<td>
				Attempted
			</td>
			<td align="center">
				{$stats['home'].teamStats.runs.att|default:"0"}
			</td>
			<td align="center">
				{$stats['away'].teamStats.runs.att|default:"0"}
			</td>
		</tr>
		<tr>
			<td>
				Yards
			</td>
			<td align="center">
				{$stats['home'].teamStats.runs.yards|default:"0"}
			</td>
			<td align="center">
				{$stats['away'].teamStats.runs.yards|default:"0"}
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				Passing Yards
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center">
				{$stats['home'].teamStats.pass|default:"0"}
			</td>
			<td align="center">
				{$stats['away'].teamStats.pass|default:"0"}
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				First Downs
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center">
				{$stats['home'].teamStats.firsts|default:"0"}
			</td>
			<td align="center">
				{$stats['away'].teamStats.firsts|default:"0"}
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				<b>Team Leader</b>
			</td>
		</tr>
		
		
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				Runs
			</td>
		</tr>
		<tr>
			<td>
				Player
			</td>
			<td align="center">
				{$stats['home'].RB.name|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].RB.name|default:"&nbsp;"}
			</td>
		</tr>
		<tr>
			<td>
				Attempted Runs
			</td>
			<td align="center">
				{$stats['home'].RB.rush_att|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].RB.rush_att|default:"&nbsp;"}
			</td>
		</tr>
		<tr>
			<td>
				Running Yards
			</td>
			<td align="center">
				{$stats['home'].RB.rush_yards|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].RB.rush_yards|default:"&nbsp;"}
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				Pass
			</td>
		</tr>
		<tr>
			<td>
				Player
			</td>
			<td align="center">
				{$stats['home'].QB.name|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].QB.name|default:"&nbsp;"}
			</td>
		</tr>
		<tr>
			<td>
				Completion %
			</td>
			<td align="center">
				{$stats['home'].QB.pass_percent|default:"0"}%
			</td>
			<td align="center">
				{$stats['away'].QB.pass_percent|default:"0"}%
			</td>
		</tr>
		<tr>
			<td>
				Passing Yards
			</td>
			<td align="center">
				{$stats['home'].QB.pass_yards|default:"0"}
			</td>
			<td align="center">
				{$stats['away'].QB.pass_yards|default:"0"}
			</td>
		</tr>
		<tr>
			<td>
				Interceptions Thrown
			</td>
			<td align="center">
				{$stats['home'].QB.interceptions|default:"0"}
			</td>
			<td align="center">
				{$stats['away'].QB.interceptions|default:"0"}
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td align="center" colspan="2">
				Receive
			</td>
		</tr>
		<tr>
			<td>
				Player
			</td>
			<td align="center">
				{$stats['home'].WR.name|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].WR.name|default:"&nbsp;"}
			</td>
		</tr>
		<tr>
			<td>
				Catches
			</td>
			<td align="center">
				{$stats['home'].WR.catches|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].WR.catches|default:"&nbsp;"}
			</td>
		</tr>
		<tr>
			<td>
				Yards
			</td>
			<td align="center">
				{$stats['home'].WR.rec_yards|default:"&nbsp;"}
			</td>
			<td align="center">
				{$stats['away'].WR.rec_yards|default:"&nbsp;"}
			</td>
		</tr>
	</table>
</div>