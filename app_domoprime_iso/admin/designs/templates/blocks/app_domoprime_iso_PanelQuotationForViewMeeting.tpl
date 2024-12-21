{if $user->hasCredential([['superadmin','admin','app_domoprime_iso_meeting_view_quotation']])} 
    <li class="tabs-sites External" data-id="{$meeting->get('id')}" name="quotations-{$meeting->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForMeeting'])}" aria-controls="tab-customer-meetings-iso-quotations-{$meeting->get('id')}">               
       <a href="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForMeeting'])}" >                
          <span>{__('[Quotations]')}</span>                       
       </a>                            
   </li>
{/if}
