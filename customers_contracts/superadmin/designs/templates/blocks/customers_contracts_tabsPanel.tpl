 {foreach $tabs as $name=>$tab}     
    <div id="tab-customer-contracts-{$name}-{$key}">      
       {component name=$tab.component customer=$contract->getCustomer() contract=$contract key=$key}      
    </div>  
{/foreach} 