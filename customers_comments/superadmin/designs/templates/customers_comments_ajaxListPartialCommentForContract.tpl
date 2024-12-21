{if $contract->isLoaded()}
    {include file="./blocks/customers_comments_listForContract.tpl"}
{else}
    <span>{__('Contract is invalid.')}</span>
{/if}    