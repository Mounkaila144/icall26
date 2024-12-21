{if $user->hasCredential([['superadmin','admin','app_domoprime_iso_meeting_view_simulation']])} 
    <li class="tabs-sites External" data-id="{$meeting->get('id')}" name="simulation-{$meeting->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'SimulationForMeeting'])}" aria-controls="tab-customer-meetings-simulation-{$meeting->get('id')}">               
       <a href="{url_to('app_domoprime_iso_ajax',['action'=>'SimulationForMeeting'])}" >                
          <span>{__('Simulation')}</span>                       
       </a>                            
   </li>
{/if}
