{assign var='thisPage' value='index.php'}
{include file="head.tpl"}
{include file="header.tpl"}

<div id="notices" >
	{if $errors}Notice(s):<br />
		{foreach from=$errors item=thisError}
			{$thisError}<br />
		{/foreach}
	{/if}
</div>
		
{include file="footer.tpl"}