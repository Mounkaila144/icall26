{if $user->hasCredential([['superadmin','admin','app_domoprime_iso_meeting_view_simulations']])} 
    <li class="tabs-sites External" data-id="{$meeting->get('id')}" name="simulations-{$meeting->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" aria-controls="tab-customer-meetings-simulations-{$meeting->get('id')}">               
       <a href="{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" >                
          <span>{__('Simulations')}</span>                       
       </a>                            
   </li>
{/if}
