{if $user->hasCredential([['superadmin','admin','contract_view_iso_results']])} 
             <li class="tabs-sites External" data-id="{$contract->get('id')}" name="results-{$contract->get('id')}" data-url="{url_to('app_domoprime_iso_ajax',['action'=>'ResultsForContract'])}" aria-controls="tab-customer-contracts-results-{$contract->get('id')}">               
                <a href="{url_to('app_domoprime_iso_ajax',['action'=>'ResultsForContract'])}" >                
                   <span>{__('[Results]')}</span>                       
                </a>                            
            </li>
            {/if}
