 {if $user->hasCredential([['superadmin','app_domoprime_iso_contract_view_all_documents']])}     
    <a target="_blank" href="{url_to('app_domoprime_iso',['action'=>'ExportAllDocumentsPdf'])}?contract={$contract->get('id')}" title="{__('Pre-meeting/Verifs/AH/Quotation/Billing')}" id="{$contract->get('id')}" name="{$contract->getCustomer()|upper}">
         <i class="fa fa-file-pdf-o" style="font-size: 16px"/>
         {__('Pre-meeting/Verifs/AH/Quotation/Billing document')}
    </a>    
{/if}
