{messages class="customers-meeting-app-domoprime-simulation-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>   
  <a href="#" class="btn" id="DomoprimeSimulationForMeeting-New" title="{__('New simulation')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New simulation')}</a>       
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeSimulationForMeeting"}
<button id="DomoprimeSimulationForMeeting-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeSimulationForMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
       {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_date']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        {/if}        
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_ht']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sales HT')}</span>               
        </th>
         {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_taxe']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total Tax')}</span>               
        </th>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_ttc']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sale TTC')}</span>               
        </th>   
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_rest_in_charge_after_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge after credit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit_available']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit available')}</span>               
        </th>  
        {/if}
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created by')}</span>  
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_status']])}
            <th data-hide="phone" style="display: table-cell;">
            <span>{__('Status')}</span>  
        </th> 
        {/if}
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
        <td>{* id *}        
        </td>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_date']])}
           <td>{* id *}</td>
           {/if}
       <td>{* id *}</td>
       {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_ht']])}
         <td>{* id *}</td>
        {/if}        
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_taxe']])}  
          <td>{* id *}</td>
           {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_ttc']])}  
       <td>{* name *}</td>     
       {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_prime']])}
         <td>
                 
        </td>  
        {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit']])}
         <td>
           
        </td>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_qmac']])}
         <td>
               
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_number_of_people']])}
         <td>
                
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_number_of_children']])}
         <td>               
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit_used']])}
         <td>
           
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_rest_in_charge']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_credit_limit']])}
             <td></td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_rest_in_charge_after_credit']])}
             <td></td>
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit_available']])}
             <td></td>
        {/if}
        <td>{* name *}</td>   
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_status']])}
         <td>{* name *}</td> 
         {/if}
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeSimulationForMeeting list" id="DomoprimeSimulationForMeeting-{$item->get('id')}"> 
        <td class="DomoprimeSimulationForMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>        
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_date']])}
            <td>           
                {if $item->hasDatedAt()}
                    {$item->getFormatter()->getDatedAt()->getText()}
                {else}
                    {__('---')}
                {/if}
            </td>
            {/if}
            <td>                
              {$item->get('reference')}
            </td>
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_ht']])}
             <td>                
               {$item->getFormattedTotalSaleWithoutTax()}
            </td>
             {/if}
                {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_taxe']])}
            <td>                
               {$item->getFormattedTotalSaleTax()}
            </td>            
            {/if}   
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_sales_ttc']])}   
            <td>
               {$item->getFormattedTotalSaleWithTax()}  
            </td>
            {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_prime']])}
         <td>
              {$item->getFormattedPrime()}      
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_number_of_people']])}
         <td>
              {$item->getNumberOfPeople()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_number_of_children']])}
          <td>
              {$item->getNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_rest_in_charge']])}
         <td>
             {$item->getFormattedRestInCharge()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_tax_credit_available']])}
               <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
            <td>
                 {if $item->hasCreator()}
                    {$item->getCreator()|upper}
                 {else}
                     {__('---')}
                 {/if}    
            </td>
            <td>
               {$item->getFormatter()->getCreatedAt()->getFormatted(['d','q'])}
            </td>
              {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_simulation_status']])} 
            <td class="DomoprimeSimulationForMeeting Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            {/if}
            <td>                            
                <a href="#" title="{__('Edit')}" class="DomoprimeSimulationForMeeting-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a>                 
                 <a href="#" title="{__('Display')}" class="DomoprimeSimulationForMeeting-Display" id="{$item->get('id')}">
                     <i class="fa fa-search"></i></a>                     
                {*<a href="{url_to('app_domoprime',['action'=>'ExportSimulationPdf'])}?Simulation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeSimulationForMeeting-ExportPdf">
                     <i class="fa fa-file-pdf-o"></i></a> 
                     *}
                 {if  $user->hasCredential([['superadmin','admin','app_domoprime_meeting_view_simulation_delete']])}
                      
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeSimulationForMeeting-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeSimulationForMeeting-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if}                  
                  {/if}
                  {if  $user->hasCredential([['superadmin']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeSimulationForMeeting-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-remove"></i></a> 
                  {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No simulation')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeSimulationForMeeting-all" /> 
          <a style="opacity:0.5" class="DomoprimeSimulationForMeeting-actions_items" href="#" title="{__('Delete')}" id="DomoprimeSimulationForMeeting-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeSimulationForMeeting"}
<script type="text/javascript">
 
        function getSiteDomoprimeSimulationForMeetingFilterParameters()
        {
            var params={    Meeting: '{$meeting->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeSimulationForMeeting-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeSimulationForMeeting-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeSimulationForMeeting-order_active").attr("name")] =$(".DomoprimeSimulationForMeeting-order_active").attr("id");   
            $(".DomoprimeSimulationForMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeSimulationForMeetingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeSimulationForMeetingFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeSimulationForMeeting-pager .DomoprimeSimulationForMeeting-active").html()?parseInt($(".DomoprimeSimulationForMeeting-pager .DomoprimeSimulationForMeeting-active").html()):1;
           records_by_page=$("[name=DomoprimeSimulationForMeeting-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeSimulationForMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeSimulationForMeeting-nb_results").html())-n;
           $("#DomoprimeSimulationForMeeting-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeSimulationForMeeting-end_result").html($(".DomoprimeSimulationForMeeting-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeSimulationForMeeting-init").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$meeting->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeSimulationForMeeting-order').click(function() {
                $(".DomoprimeSimulationForMeeting-order_active").attr('class','DomoprimeSimulationForMeeting-order');
                $(this).attr('class','DomoprimeSimulationForMeeting-order_active');
                return updateSiteDomoprimeSimulationForMeetingFilter();
           });
           
            $(".DomoprimeSimulationForMeeting-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeSimulationForMeetingFilter();
            });
            
          $("#DomoprimeSimulationForMeeting-filter").click(function() { return updateSiteDomoprimeSimulationForMeetingFilter(); }); 
          
          $("[name=DomoprimeSimulationForMeeting-nbitemsbypage]").change(function() { return updateSiteDomoprimeSimulationForMeetingFilter(); }); 
          
         // $("[name=DomoprimeSimulationForMeeting-name]").change(function() { return updateSiteDomoprimeSimulationForMeetingFilter(); }); 
           
           $(".DomoprimeSimulationForMeeting-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeSimulationForMeetingFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-loading",
                                target: "#tab-customer-meetings-simulations-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeSimulationForMeeting-New").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'NewSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$meeting->get('id')}" 
                         }); 
           });
           
           
           $(".DomoprimeSimulationForMeeting-View").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}', DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$meeting->get('id')}" 
                         }); 
           });
           
           
            $(".DomoprimeSimulationForMeeting-Display").click(function() {                  
               return $.ajax2({                     
                            data : { DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'DisplaySimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$meeting->get('id')}" 
                         }); 
           });
           
           
           
             $(".DomoprimeSimulationForMeeting-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Simulation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'DisableSimulation'])}" , 
                              errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableSimulation')
                                        {                                               
                                            $(".DomoprimeSimulationForMeeting-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeSimulationForMeeting-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeSimulationForMeeting.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeSimulationForMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeSimulationForMeeting-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Simulation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeSimulation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'EnableSimulation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableSimulation')
                                        {    
                                            $(".DomoprimeSimulationForMeeting-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeSimulationForMeeting-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeSimulationForMeeting.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeSimulationForMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
</script>    
{else}
    {__('Meeting is invalid.')}
{/if}    
  

