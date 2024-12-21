{if $meeting->isLoaded()}
    {include file="./blocks/customers_meetings_comments_list.tpl"}
{else}
    <span>{__('Meeting is invalid.')}</span>
{/if}    