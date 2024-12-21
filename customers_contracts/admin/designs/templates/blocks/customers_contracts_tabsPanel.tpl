 {foreach $tabs as $name=>$tab}   
     {if $user->hasCredential($tab->get('credentials'))}
    <div id="tab-customer-contracts-{$name}-{$key}">                   
       {component name=$tab.component customer=$contract->getCustomer() contract=$contract key=$key}      
    </div>   
       {/if}
{/foreach} 