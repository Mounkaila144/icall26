{messages class="customers-meeting-app-domoprime-billing-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>
 {* <a href="#" class="btn" id="DomoprimeBillingForMeeting-New" title="{__('New billing')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New billing')}</a>       *}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeBillingForMeeting"}
<button id="DomoprimeBillingForMeeting-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeBillingForMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sales HT')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total Tax')}</span>               
        </th>
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sale TTC')}</span>               
        </th>   
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_in_charge_after_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge after credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_tax_credit_available']])}
             <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit available')}</span>               
        </th> 
        {/if}    
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
        <td>{* id *}        
        </td>
           <td>{* id *}</td>
       <td>{* id *}</td>
         <td>{* id *}</td>
          <td>{* id *}</td>
              {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_prime']])}
         <td>
                 
        </td>  
        {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_tax_credit']])}
         <td>
           
        </td>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_qmac']])}
         <td>
               
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_number_of_people']])}
         <td>
                
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_number_of_children']])}
         <td>               
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_tax_credit_used']])}
         <td>
           
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_in_charge']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_credit_limit']])}
             <td></td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_in_charge_after_credit']])}
             <td></td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_tax_credit_available']])}
             <td></td>
        {/if}
       <td>{* name *}</td>      
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeBillingForMeeting list" id="DomoprimeBillingForMeeting-{$item->get('id')}"> 
        <td class="DomoprimeBillingForMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
             {$item->get('month')}{$item->get('year')}
            </td>
            <td>                
              {$item->get('reference')}
            </td>
             <td>                
             {$item->getFormattedTotalSaleWithoutTax()}
            </td>
            <td>    
                   {$item->getFormattedTotalSaleTax()}
            </td>                           
            </td> 
            <td>
              {$item->getFormattedTotalSaleWithTax()}   
            </td>
                  {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_prime']])}
         <td>
              {$item->getFormattedPrime()}      
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_number_of_people']])}
         <td>
              {$item->getNumberOfPeople()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_number_of_children']])}
          <td>
              {$item->getNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_in_charge']])}
         <td>
             {$item->getFormattedRestInCharge()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_billing_rest_tax_credit_available']])}
             <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
            <td>
              {$item->get('created_at')}
            </td>
            <td>               
                 
                <a href="#" title="{__('Edit')}" class="DomoprimeBillingForMeeting-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>                        
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No billing')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeBillingForMeeting-all" /> 
          <a style="opacity:0.5" class="DomoprimeBillingForMeeting-actions_items" href="#" title="{__('Delete')}" id="DomoprimeBillingForMeeting-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeBillingForMeeting"}
<script type="text/javascript">
 
        function getSiteDomoprimeBillingForMeetingFilterParameters()
        {
            var params={    Meeting: '{$meeting->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeBillingForMeeting-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeBillingForMeeting-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeBillingForMeeting-order_active").attr("name")] =$(".DomoprimeBillingForMeeting-order_active").attr("id");   
            $(".DomoprimeBillingForMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeBillingForMeetingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeBillingForMeetingFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-billings-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeBillingForMeeting-pager .DomoprimeBillingForMeeting-active").html()?parseInt($(".DomoprimeBillingForMeeting-pager .DomoprimeBillingForMeeting-active").html()):1;
           records_by_page=$("[name=DomoprimeBillingForMeeting-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeBillingForMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeBillingForMeeting-nb_results").html())-n;
           $("#DomoprimeBillingForMeeting-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeBillingForMeeting-end_result").html($(".DomoprimeBillingForMeeting-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeBillingForMeeting-init").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-billings-{$meeting->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeBillingForMeeting-order').click(function() {
                $(".DomoprimeBillingForMeeting-order_active").attr('class','DomoprimeBillingForMeeting-order');
                $(this).attr('class','DomoprimeBillingForMeeting-order_active');
                return updateSiteDomoprimeBillingForMeetingFilter();
           });
           
            $(".DomoprimeBillingForMeeting-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeBillingForMeetingFilter();
            });
            
          $("#DomoprimeBillingForMeeting-filter").click(function() { return updateSiteDomoprimeBillingForMeetingFilter(); }); 
          
          $("[name=DomoprimeBillingForMeeting-nbitemsbypage]").change(function() { return updateSiteDomoprimeBillingForMeetingFilter(); }); 
          
         // $("[name=DomoprimeBillingForMeeting-name]").change(function() { return updateSiteDomoprimeBillingForMeetingFilter(); }); 
           
           $(".DomoprimeBillingForMeeting-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeBillingForMeetingFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-loading",
                                target: "#tab-customer-meetings-billings-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
         $("#DomoprimeBillingForMeeting-New").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'NewBillingForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-billing-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-billings-{$meeting->get('id')}" 
                         }); 
           });  
</script>    
{else}
    {__('Meeting is invalid.')}
{/if}    
 
