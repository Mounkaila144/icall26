 {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_generate_all_documents']])} 
    <a target="_blank" href="{url_to('app_domoprime_iso',['action'=>'ExportAllDocumentsPdf'])}?contract={$item->get('id')}" title="{__('Generate Pre Meeting/AH/Quotation/Billing/Fiscal')}" id="{$item->get('id')}" name="{$item->getCustomer()|upper}">
        <i style="font-size: 18px;color:red" class="fa fa-cog"/>
    </a>    
{/if}
