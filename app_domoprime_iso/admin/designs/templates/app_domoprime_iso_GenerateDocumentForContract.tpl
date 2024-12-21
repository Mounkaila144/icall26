{messages class="customers-contract-document-iso-errors"}
{if $contract->isLoaded() && $engine->hasDocument()}
    
    {$engine->getDocument()->get('id')}
    
{else}
    {__('Contract is invalid.')}
{/if}    
