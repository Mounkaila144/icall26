{messages class="customers-meeting-view-app-domoprime-iso-quotation-meeting-errors"}
{if $meeting->isLoaded()}
<div>
  {if $last_quotation && $last_quotation->isLoaded()}    
    <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$last_quotation->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForMeeting-ExportPdf">
        <i class="fa fa-file-pdf-o" style="font-size: 16px;"></i>
        <span>{__('Quotation')} {$last_quotation->get('reference')} {if $last_quotation->hasDatedAt()}{$last_quotation->getFormatter()->getDatedAt()->getText()}{/if}</span>
    </a> 
    {if !$meeting->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_edit']])}
                   <a href="javascript:void(0);" title="{__('Edit')}" class="DomoprimeQuotationForViewMeeting-View" id="{$last_quotation->get('id')}">
                       <i class="fa fa-edit" style="font-size: 16px;"></i></a> 
    {/if} 
    {if !$last_quotation->isSigned()} 
                     {*component name="/app_domoprime_yousign/linkForQuotationPagerForMeeting" quotation=$last_quotation*}                      
                     {component name="/app_domoprime_yousign/linkIframeForQuotationPagerForMeeting" quotation=$last_quotation}    
     {/if}
  {/if}
   {*if !$meeting->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_create_billing']])} 
                  {if $meeting->hasOpcAt() && $last_quotation && $last_quotation->isLoaded()}
                   <a href="javascript:void(0);" title="{__('Billing')}" class="CreateBillingForViewMeeting" name="{$last_quotation->get('reference')}" id="{$last_quotation->get('id')}">
                      <i class="fa fa-euro"></i></a> 
                  {else}
                     <a style="display:none;" href="javascript:void(0);" title="{__('Billing')}" class="CreateBillingHoldForMeeting" name="{$last_quotation->get('reference')}" id="{$last_quotation->get('id')}">
                      <i class="fa fa-euro"></i></a>   
                  {/if}    
                 {/if*} 
{if $meeting->hasOpcAt()  && $last_quotation && $last_quotation->isLoaded()}                 
  <a href="javascript:void(0);" title="{__('Details')}" class="Hide" id="DomoprimeQuotationForViewMeeting-Details">
                     <i class="fa fa-search" style="font-size: 16px;"></i></a>  
                     {/if}
  {if !$meeting->getQuotations() && !$meeting->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_meeting_list_quotation_new']])}      
      {if !$last_quotation || $last_quotation->isNotLoaded()}<span>{__('Quotation')}</span>{/if}
  <a href="javascript:void(0);" class="" id="DomoprimeQuotationForViewMeeting-New"><i class="fa fa-plus" style="font-size: 16px;margin-right:10px;"></i></a>      
  {/if} 
</div>

<div id="meeting-view-quotations-details" {if $display}style="display:none"{/if}>


    <h3>{__('Quotations')}</h3>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotationForViewMeeting"}
<button id="DomoprimeQuotationForViewMeeting-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeQuotationForViewMeeting-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table table-form" cellpadding="0" cellspacing="0" >     
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
         {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_tax_credit_available']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit available')}</span>               
        </th>  
        {/if}
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Signed')}</span>  
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Signed at')}</span>          
        </th>
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
    {foreach $pager as $item}
    <tr class="DomoprimeQuotationForViewMeeting" id="DomoprimeQuotationForViewMeeting-{$item->get('id')}"> 
        <td class="DomoprimeQuotationForViewMeeting-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
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
         {if $user->hasCredential([['superadmin','admin','app_domoprime_meeting_quotation_tax_credit_available']])}
               <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
             <td>
               {__($item->get('is_signed'))} 
               {if $item->isSigned()}
               {component name="/app_domoprime_yousign/linkForSignedQuotationPagerForMeeting" quotation=$item}
               {/if}
            </td>
            <td>
                 {if $item->isSigned()}
                        {if $item->hasSignedAt()}
                            {format_date($item->get('signed_at'),['d','q'])}       
                        {else}
                            {__('---')}
                        {/if}    
                {/if}
            </td>
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
            <td class="DomoprimeQuotationForViewMeeting Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            {/if}
            <td>               
               {if !$meeting->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_edit']])}
                 <a href="#" title="{__('Edit')}" class="DomoprimeQuotationForViewMeeting-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a> 
               {/if}      
               {*  <a href="#" title="{__('Display')}" class="DomoprimeQuotationForViewMeeting-Display" id="{$item->get('id')}">
                     <i class="fa fa-search"></i></a>  *}
                  {if !$item->isSigned()} 
                     {*component name="/app_domoprime_yousign/linkForQuotationPagerForMeeting" quotation=$item*} 
                     {*component name="/app_domoprime_yousign/linkSignatureForQuotationPagerForMeeting" quotation=$item*}    
                     {component name="/app_domoprime_yousign/linkIframeForQuotationPagerForMeeting" quotation=$item}    
                  {/if}
                 {if !$meeting->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_create_billing']])} 
                  {if $meeting->hasOpcAt()}
                   <a href="#" title="{__('Billing')}" class="CreateBillingForMeeting" name="{$item->get('reference')}" id="{$item->get('id')}">
                      <i class="fa fa-euro"></i></a> 
                  {else}
                     <a style="opacity:0.6;" href="#" title="{__('Billing')}" class="CreateBillingHoldForMeeting" name="{$item->get('reference')}" id="{$item->get('id')}">
                      <i class="fa fa-euro"></i></a>   
                  {/if}    
                 {/if}  
                  <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForViewMeeting-ExportPdf">
                      <i class="fa fa-file-pdf-o"></i></a> 
                  {if  $user->hasCredential([['superadmin','admin','app_domoprime_meeting_view_quotation_delete']])}
                      
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotationForViewMeeting-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotationForViewMeeting-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if}                  
                  {/if}
                  {if  $user->hasCredential([['superadmin']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotationForViewMeeting-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
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
        <input type="checkbox" id="DomoprimeQuotationForViewMeeting-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotationForViewMeeting-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotationForViewMeeting-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotationForViewMeeting"}
<div id="Dialog-QuotationForContrat" title="{__('Billing creation confirmation')}" style="display:none">
    <div id="Dialog-QuotationForContrat-Billing"></div>
    <br/>
    <div>
        {__('Send email to customer ?')}<input type="checkbox" id="SendBillingEmailCustomer" value="YES"/>
    </div>
</div>
    
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationForViewMeetingFilterParameters()
        {
            var params={    Meeting: '{$meeting->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeQuotationForViewMeeting-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotationForViewMeeting-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotationForViewMeeting-order_active").attr("name")] =$(".DomoprimeQuotationForViewMeeting-order_active").attr("id");   
            $(".DomoprimeQuotationForViewMeeting-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationForViewMeetingFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationForViewMeetingFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#quotations-target-{$meeting->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotationForViewMeeting-pager .DomoprimeQuotationForViewMeeting-active").html()?parseInt($(".DomoprimeQuotationForViewMeeting-pager .DomoprimeQuotationForViewMeeting-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotationForViewMeeting-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotationForViewMeeting-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotationForViewMeeting-nb_results").html())-n;
           $("#DomoprimeQuotationForViewMeeting-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotationForViewMeeting-end_result").html($(".DomoprimeQuotationForViewMeeting-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForViewMeeting-init").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#quotations-target-{$meeting->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeQuotationForViewMeeting-order').click(function() {
                $(".DomoprimeQuotationForViewMeeting-order_active").attr('class','DomoprimeQuotationForViewMeeting-order');
                $(this).attr('class','DomoprimeQuotationForViewMeeting-order_active');
                return updateSiteDomoprimeQuotationForViewMeetingFilter();
           });
           
            $(".DomoprimeQuotationForViewMeeting-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationForViewMeetingFilter();
            });
            
          $("#DomoprimeQuotationForViewMeeting-filter").click(function() { return updateSiteDomoprimeQuotationForViewMeetingFilter(); }); 
          
          $("[name=DomoprimeQuotationForViewMeeting-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationForViewMeetingFilter(); }); 
          
         // $("[name=DomoprimeQuotationForViewMeeting-name]").change(function() { return updateSiteDomoprimeQuotationForViewMeetingFilter(); }); 
           
           $(".DomoprimeQuotationForViewMeeting-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationForViewMeetingFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewMeeting'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-loading",
                                target: "#quotations-target-{$meeting->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
        $("#DomoprimeQuotationForViewMeeting-New").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'NewQuotationFromRequestForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#quotations-target-{$meeting->get('id')}" 
                         }); 
           });
           
           
           
           $(".DomoprimeQuotationForViewMeeting-View").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewQuotationFromRequestForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#quotations-target-{$meeting->get('id')}" 
                         }); 
           });
           
           
             $(".DomoprimeQuotationForViewMeeting-Display").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'DisplayQuotationForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#quotations-target-{$meeting->get('id')}" 
                         }); 
           });
           
           
           
             $(".DomoprimeQuotationForViewMeeting-Remove").click(function() {   
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'RemoveQuotation'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='RemoveQuotation')
                                        {    
                                            $(".DomoprimeQuotationForViewMeeting.list[id=DomoprimeQuotationForViewMeeting-"+resp.id+"]").remove();
                                            if ($('.DomoprimeQuotationForViewMeeting.list').length==0)
                                              return $.ajax2({  data : { Meeting: '{$meeting->get('id')}' },
                                                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForViewMeeting'])}",
                                                                errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                                                                loading: "#tab-site-dashboard-customers-meeting-loading",
                                                                target: "#quotations-target-{$meeting->get('id')}" });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
           $(".DomoprimeQuotationForViewMeeting-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotationForViewMeeting-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotationForViewMeeting-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotationForViewMeeting.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotationForViewMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotationForViewMeeting-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotationForViewMeeting-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotationForViewMeeting-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotationForViewMeeting.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotationForViewMeeting-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
           
           
            $(".CreateBillingForViewMeeting").click(function() {         
               var quotation=$(this).attr('id');
               if ($("[aria-describedby=Dialog-QuotationForContrat]").length)
                   $("[aria-describedby=Dialog-QuotationForContrat]").remove();
               $("#Dialog-QuotationForContrat-Billing").html('{__("Billing for quotation \"#0#\" will be created. Confirm ?")}'.format($(this).attr('name')));
               $("#Dialog-QuotationForContrat").dialog({  
                   autoOpen: true,  
                   height: 'auto', 
                   width:'30%',  
                   modal: true ,
                   buttons: {
                        "{__("YES")}": function() {
                          $( this ).dialog( "close" );                          
                          return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}', DomoprimeQuotation: quotation, 
                                     Billing : { to_send: $("#SendBillingEmailCustomer:checked").val(), token: '{mfForm::getToken('CreateBillingForMeeting')}' },
                                   },
                            url:"{url_to('app_domoprime_ajax',['action'=>'CreateBillingForMeeting'])}" , 
                            errorTarget: ".customers-meeting-view-app-domoprime-iso-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            success : function (resp)
                                    {
                                        
                                    }
                         });
                          
                          
                        },
                        "{__("NO")}": function() {
                          $( this ).dialog( "close" );
                        }
                      }
                });                           
           });
       
           
      $(".CreateBillingHoldForViewMeeting").click(function() {         
                alert("{__("Opc date is required to create billing.")}");            
      });
      
      $("#DomoprimeQuotationForViewMeeting-Details").click(function () { 
          $(this).toggleClass('Hide');
          if ($(this).hasClass('Hide'))
             $("#meeting-view-quotations-details").show();
          else
             $("#meeting-view-quotations-details").hide();
      });
</script>       

 {*component name="/app_domoprime_yousign/javascriptForQuotationPagerForMeeting"*}     
{else}
    {__('Meeting is invalid.')}
{/if}    
  



</div>
