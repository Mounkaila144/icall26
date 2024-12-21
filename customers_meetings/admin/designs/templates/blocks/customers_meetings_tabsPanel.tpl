 {foreach $tabs as $name=>$tab}   
    <div id="tab-customer-meetings-{$name}-{$key}">
       {component name=$tab.component customer=$meeting->getCustomer() meeting=$meeting key=$key}      
    </div>   
{/foreach} 
