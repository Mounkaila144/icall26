{if $item->hasCalculation()}
        <a href="#" title="{__('Documents class')}" class="CustomerContracts-DocumentsFormClass" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
         <img height="16px" src="{url('/icons/doc-green-32x32.png','picture')}" alt='{__("Documents")}'/></a>   
{/if}
