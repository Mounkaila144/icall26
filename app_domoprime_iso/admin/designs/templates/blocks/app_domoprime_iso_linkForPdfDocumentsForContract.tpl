 {if $user->hasCredential([['superadmin','admin','app_domoprime_iso_contract_view_pdf_documents']])} 
    <a target="_blank" href="{url_to('app_domoprime_iso',['action'=>'ExportDocumentsPdf'])}?{__('Contract')}={$contract->get('id')}" title="{__('Generate AH/Quotation/Billing')}" id="{$contract->get('id')}" name="{$contract->getCustomer()|upper}">
        <i style="font-size: 18px;color:blue" class="fa fa-cog"/>
    </a>    
{/if}
