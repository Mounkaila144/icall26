 {if $user->hasCredential([['superadmin','admin','app_domoprime_iso_contract_generate_documents']])} 
    <a target="_blank" href="{url_to('app_domoprime_iso',['action'=>'ExportDocumentsPdf'])}?{__('Contract')}={$item->get('id')}" title="{__('Generate AH/Quotation/Billing')}" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
        <i style="font-size: 18px;color:blue" class="fa fa-cog"/>
    </a>    
{/if}
