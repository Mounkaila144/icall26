{if $user->hasCredential([['superadmin','admin','app_domoprime_iso_contract_view_quotation']])} 
    <li class="tabs-sites External" data-id="{$contract->get('id')}" name="quotations-{$contract->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForContract'])}" aria-controls="tab-customer-contracts-iso-quotations-{$contract->get('id')}">               
       <a href="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForContract'])}" >                
          <span>{__('[Quotations]')}</span>                       
       </a>                            
   </li>
{/if}
