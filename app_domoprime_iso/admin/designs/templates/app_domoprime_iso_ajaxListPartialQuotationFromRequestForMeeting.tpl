{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>
     {if !$meeting->getQuotations() && $meeting->isUnhold() || $user->hasCredential([['superadmin','admin','app_domoprime_meeting_list_quotation_new']])}         
  <a href="#" class="btn" id="DomoprimeQuotationFromRequestForMeeting-New" title="{__('New quotation')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New quotation')}</a>     
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotationFromRequestForMeeting"}
<button id="DomoprimeQuotationFromRequestForMeeting-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeQuotationFromRequestForMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
       {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_date']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        {/if}        
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ht']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sales HT')}</span>               
        </th>
         {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_taxe']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total Tax')}</span>               
        </th>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ttc']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sale TTC')}</span>               
        </th>   
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_rest_in_charge_after_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge after credit')}</span>               
        </th>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit_available']])}
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
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_status']])}
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
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_date']])}
           <td>{* id *}</td>
           {/if}
       <td>{* id *}</td>
       {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ht']])}
         <td>{* id *}</td>
        {/if}        
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_taxe']])}  
          <td>{* id *}</td>
           {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ttc']])}  
       <td>{* name *}</td>     
       {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_prime']])}
         <th>
                 
        </th>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit']])}
         <td>
           
        </td>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_qmac']])}
         <td>
               
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_number_of_people']])}
         <td>
                
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_number_of_children']])}
          <td>                          
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit_used']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_rest_in_charge']])}
         <td>
           
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_credit_limit']])}
             <td>
           
        </td> 
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_rest_in_charge_after_credit']])}
           <td>
           
        </td> 
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit_available']])}
             <td></td>
        {/if}
        <td>{* name *}</td>   
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_status']])}
         <td>{* name *}</td> 
         {/if}
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeQuotationFromRequestForMeeting list" id="DomoprimeQuotationFromRequestForMeeting-{$item->get('id')}"> 
        <td class="DomoprimeQuotationFromRequestForMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>        
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_date']])}
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
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ht']])}
             <td>                
               {$item->getFormattedTotalSaleWithoutTax()}
            </td>
             {/if}
                {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_taxe']])}
            <td>                
               {$item->getFormattedTotalSaleTax()}
            </td>            
            {/if}   
            {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_sales_ttc']])}   
            <td>
               {$item->getFormattedTotalSaleWithTax()}  
            </td>
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_prime']])}
         <td>
              {$item->getFormattedPrime()}      
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_number_of_people']])}
         <td>
              {$item->getNumberOfPeople()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_number_of_children']])}
          <td>
              {$item->getNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_rest_in_charge']])}
         <td>
             {$item->getFormattedRestInCharge()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_tax_credit_available']])}
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
              {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_status']])} 
            <td class="DomoprimeQuotationFromRequestForMeeting Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            {/if}
            <td>               
                {if $meeting->isUnhold()} 
                <a href="#" title="{__('Edit')}" class="DomoprimeQuotationFromRequestForMeeting-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a> 
                {/if}  
                {*
                 <a href="#" title="{__('Display')}" class="DomoprimeQuotationFromRequestForMeeting-Display" id="{$item->get('id')}">
                     <i class="fa fa-search"></i></a>                       *}
                <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationFromRequestForMeeting-ExportPdf">
                     <i class="fa fa-file-pdf-o"></i></a> 
                 {if  $user->hasCredential([['superadmin','admin','app_domoprime_meeting_view_quotation_delete']])}
                      
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotationFromRequestForMeeting-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotationFromRequestForMeeting-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if}                  
                  {/if}
                  {if  $user->hasCredential([['superadmin']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotationFromRequestForMeeting-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-remove"></i></a> 
                  {/if}
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No quotation')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeQuotationFromRequestForMeeting-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotationFromRequestForMeeting-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotationFromRequestForMeeting-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotationFromRequestForMeeting"}
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationFromRequestForMeetingFilterParameters()
        {
            var params={    Meeting: '{$meeting->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeQuotationFromRequestForMeeting-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotationFromRequestForMeeting-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotationFromRequestForMeeting-order_active").attr("name")] =$(".DomoprimeQuotationFromRequestForMeeting-order_active").attr("id");   
            $(".DomoprimeQuotationFromRequestForMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationFromRequestForMeetingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationFromRequestForMeetingFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotationFromRequestForMeeting-pager .DomoprimeQuotationFromRequestForMeeting-active").html()?parseInt($(".DomoprimeQuotationFromRequestForMeeting-pager .DomoprimeQuotationFromRequestForMeeting-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotationFromRequestForMeeting-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotationFromRequestForMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotationFromRequestForMeeting-nb_results").html())-n;
           $("#DomoprimeQuotationFromRequestForMeeting-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotationFromRequestForMeeting-end_result").html($(".DomoprimeQuotationFromRequestForMeeting-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationFromRequestForMeeting-init").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeQuotationFromRequestForMeeting-order').click(function() {
                $(".DomoprimeQuotationFromRequestForMeeting-order_active").attr('class','DomoprimeQuotationFromRequestForMeeting-order');
                $(this).attr('class','DomoprimeQuotationFromRequestForMeeting-order_active');
                return updateSiteDomoprimeQuotationFromRequestForMeetingFilter();
           });
           
            $(".DomoprimeQuotationFromRequestForMeeting-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationFromRequestForMeetingFilter();
            });
            
          $("#DomoprimeQuotationFromRequestForMeeting-filter").click(function() { return updateSiteDomoprimeQuotationFromRequestForMeetingFilter(); }); 
          
          $("[name=DomoprimeQuotationFromRequestForMeeting-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationFromRequestForMeetingFilter(); }); 
          
         // $("[name=DomoprimeQuotationFromRequestForMeeting-name]").change(function() { return updateSiteDomoprimeQuotationFromRequestForMeetingFilter(); }); 
           
           $(".DomoprimeQuotationFromRequestForMeeting-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationFromRequestForMeetingFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-loading",
                                target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
          $("#DomoprimeQuotationFromRequestForMeeting-New").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'NewQuotationFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}" 
                         }); 
           });
           
           
           $(".DomoprimeQuotationFromRequestForMeeting-View").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewQuotationFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}" 
                         }); 
           });
           
           
            $(".DomoprimeQuotationFromRequestForMeeting-Display").click(function() {                  
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisplayQuotationFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}" 
                         }); 
           });
           
           
           
             $(".DomoprimeQuotationFromRequestForMeeting-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                              errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotationFromRequestForMeeting-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotationFromRequestForMeeting-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotationFromRequestForMeeting.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotationFromRequestForMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotationFromRequestForMeeting-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotationFromRequestForMeeting-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotationFromRequestForMeeting-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotationFromRequestForMeeting.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotationFromRequestForMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
</script>    
{else}
    {__('Meeting is invalid.')}
{/if}    
  

