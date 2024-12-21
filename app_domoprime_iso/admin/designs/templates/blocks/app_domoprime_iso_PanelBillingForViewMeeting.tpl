{if $user->hasCredential([['superadmin','admin','app_domoprime_iso_meeting_view_billing']])} 
    <li class="tabs-sites External" data-id="{$meeting->get('id')}" name="billings-{$meeting->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialBillingFromRequestForMeeting'])}" aria-controls="tab-customer-meetings-iso-billings-{$meeting->get('id')}">               
       <a href="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialBillingFromRequestForMeeting'])}" >                
          <span>{__('[Billings]')}</span>                       
       </a>                            
   </li>
{/if}

