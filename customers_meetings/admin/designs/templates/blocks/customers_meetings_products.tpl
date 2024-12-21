{if $meeting->hasActiveProducts()}       
    {foreach $meeting->getActiveProducts() as $product}        
       {$product->get('meta_title')}{if !$product@last},{/if}
    {/foreach}
{else}
    {__('No product')}
{/if}     
