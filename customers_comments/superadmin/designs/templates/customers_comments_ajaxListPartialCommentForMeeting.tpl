{if $meeting->isLoaded()}
    {include file="./blocks/customers_comments_listForMeeting.tpl"}
{else}
    <span>{__('Meeting is invalid.')}</span>
{/if}    