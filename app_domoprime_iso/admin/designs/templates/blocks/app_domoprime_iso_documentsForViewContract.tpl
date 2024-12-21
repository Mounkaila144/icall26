 <fieldset class="tab-form" style="width: auto;">
      <legend><h3>{__('Documents')}</h3></legend>
      {if $contract->hasPolluter() && $user->hasCredential([['app_domoprime_iso_contract_view_documents_polluter_mandatory']]) || $user->hasCredential([['superadmin','app_domoprime_iso_contract_view_documents_polluter_not_mandatory']])}
        {component name="/app_domoprime/PreMeetingDocumentForViewContract" contract=$contract}
        {component name="/app_domoprime_iso/documentForViewContract" contract=$contract}     
        {component name="/app_domoprime_yousign/DocumentSignatureForViewContract" contract=$contract}    
        {component name="/app_domoprime_yousign_evidence/DocumentSignatureForViewContract" contract=$contract} 
        {component name="/app_domoprime_iso/quotationsForViewContract" contract=$contract}              
        {component name="/app_domoprime/billingsForViewContract" contract=$contract}  
        {component name="/app_domoprime_iso/linkForPdfDocumentsForContract"  contract=$contract}   
         {component name="/app_domoprime_iso/linkForAllDocumentsForContract"  contract=$contract}   
      {else}
         {__('No polluter exists.')} 
      {/if}
 </fieldset>   
 
{component name="/customers_contracts_comments/listForViewContract" contract=$contract}    
 