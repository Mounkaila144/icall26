{if $user->hasCredential([['superadmin','admin','meeting_view_iso_results']])} 
             <li class="tabs-sites External" data-id="{$meeting->get('id')}" name="results-{$meeting->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'ResultsForMeeting'])}" aria-controls="tab-customer-meetings-results-{$meeting->get('id')}">               
                <a href="{url_to('app_domoprime_iso_ajax',['action'=>'ResultsForMeeting'])}" >                
                   <span>{__('[Results]')}</span>                       
                </a>                            
            </li>
            {/if}
