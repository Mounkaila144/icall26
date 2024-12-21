 {foreach $tabs as $name=>$tab}   
    <div id="tab-customer-meetings-{$name}-{$key}">
       <div>{$meeting->getCustomer()}</div>
       {component name=$tab.component customer=$meeting->getCustomer() meeting=$meeting key=$key}      
    </div>   
{/foreach} 

{*
 <div id="tab-customer-meeting-test">
     TEST    
    </div> *}