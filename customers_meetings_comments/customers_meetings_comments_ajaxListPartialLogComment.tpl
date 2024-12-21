{if $meeting->isLoaded()}
    {include file="./blocks/customers_meetings_comments_listLog.tpl"}
{else}
    <span>{__('Meeting is invalid.')}</span>
{/if}   