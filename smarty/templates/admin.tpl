{assign var='thisPage' value='admin.php'}
<html>
	<body>
		<div>
			<form name="editUsers" method="POST" action="{$thisPage}">
				Current Users:<br />
				
					<select name="editUsers[]" id="editUsers" multiple="yes" size="10" >
						{if $currentUsers}
								{foreach from=$currentUsers item=thisUser}
									<option value="{$thisUser.username}">
										{$thisUser.username} &nbsp;-&nbsp; {if $thisUser.role == 1}Admin{else}User{/if}
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
		</div>
	</body>
</html>