{messages class="customers-contract-view-app-domoprime-iso-quotation-contract-errors"}
{if $contract->isLoaded()}
  {if $last_quotation && $last_quotation->isLoaded()}    
    <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$last_quotation->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForContract-ExportPdf">
        <i class="fa fa-file-pdf-o" style="font-size: 16px;"></i>
        <span>{__('Quotation')} {$last_quotation->get('reference')} {if $last_quotation->hasDatedAt()}{$last_quotation->getFormatter()->getDatedAt()->getText()}{/if}</span>
    </a> 
    {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_edit']])}
                   <a href="javascript:void(0);" title="{__('Edit')}" class="DomoprimeQuotationForViewContract-View" id="{$last_quotation->get('id')}">
                       <i class="fa fa-edit" style="font-size: 16px;"></i></a> 
    {/if} 
    {if $last_quotation->isSigned()} 
        {component name="/app_domoprime_yousign/linkForLastQuotation" quotation=$last_quotation}
    {else}    
                     {*component name="/app_domoprime_yousign/linkForQuotationPagerForContract" quotation=$last_quotation*}                      
                     {component name="/app_domoprime_yousign/linkIframeForQuotationPagerForContract" quotation=$last_quotation}    
     {/if}

   {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_create_billing']])} 
                  {if $contract->hasOpcAt()  && $last_quotation && $last_quotation->isLoaded()}
                   <a href="javascript:void(0);" title="{__('Billing')}" class="CreateBillingForViewContract" name="{$last_quotation->get('reference')}" id="{$last_quotation->get('id')}">
                      <i class="fa fa-euro"></i></a> 
                  {else}
                     <a style="opacity:0.6;" href="javascript:void(0);" title="{__('Billing')}" class="CreateBillingHoldForContract" name="{$last_quotation->get('reference')}" id="{$last_quotation->get('id')}">
                      <i class="fa fa-euro"></i></a>   
                  {/if}    
                 {/if} 
    <a href="javascript:void(0);" title="{__('Details')}" class="Hide" id="DomoprimeQuotationForViewContract-Details">
                     <i class="fa fa-search" style="font-size: 16px;"></i></a>                       
  {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_contract_list_quotation_new']])}      
  <a href="javascript:void(0);" class="" id="DomoprimeQuotationForViewContract-New"><i class="fa fa-plus" style="font-size: 16px;margin-right:10px;"></i></a>      
  {/if}    
 {if !$contract->isHold() || $user->hasCredential([['superadmin','app_domoprime_contract_list_quotation_product_item_new']])}      
  <a href="javascript:void(0);" class="" id="DomoprimeQuotationForViewContract-New2"><i class="fa fa-plus" style="font-size: 16px;margin-right:10px;color:red"></i></a>      
  {/if} 
 {else}
 {__('No quotation')}
 {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_contract_list_quotation_new']])}      
  <a href="javascript:void(0);" class="" id="DomoprimeQuotationForViewContract-New"><i class="fa fa-plus" style="font-size: 16px;margin-right:10px;"></i></a>      
  {/if}    
 {if !$contract->isHold() || $user->hasCredential([['superadmin','app_domoprime_contract_list_quotation_product_item_new']])}      
  <a href="javascript:void(0);" class="" id="DomoprimeQuotationForViewContract-New2"><i class="fa fa-plus" style="font-size: 16px;margin-right:10px;color:red"></i></a>      
  {/if} 
 {/if} 
 

<div id="contract-view-quotations-details" style="display:none">


    <h3>{__('Quotations')}</h3>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotationForViewContract"}
<button id="DomoprimeQuotationForViewContract-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeQuotationForViewContract-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table table-form" cellpadding="0" cellspacing="0" >     
    <tr class="list-header">    
        <th>#</th>  
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_date']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        {/if}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_ht']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sales HT')}</span>               
        </th>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_taxe']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total Tax')}</span>               
        </th>
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_ttc']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total sale TTC')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_prime']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Prime')}</span>               
        </th>  
        {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_tax_credit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_qmac']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Qmac')}</span>               
        </th>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_number_of_people']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of people')}</span>               
        </th>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_number_of_children']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Number of children')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_tax_credit_used']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Tax credit used')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_rest_in_charge']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Rest in charge')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_credit_limit']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Credit limit')}</span>               
        </th>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_rest_in_charge_after_credit']])}
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
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_status']])}
            <th data-hide="phone" style="display: table-cell;">
            <span>{__('Status')}</span>  
        </th> 
        {/if}
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
    {foreach $pager as $item}
    <tr class="DomoprimeQuotationForViewContract" id="DomoprimeQuotationForViewContract-{$item->get('id')}"> 
        <td class="DomoprimeQuotationForViewContract-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_date']])}
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
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_ht']])}
             <td>                
               {$item->getFormattedTotalSaleWithoutTax()}
            </td>
            {/if}
                {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_taxe']])}
            <td>                
               {$item->getFormattedTotalSaleTax()}
            </td>            
            {/if}    
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_ttc']])}     
            <td>
               {$item->getFormattedTotalSaleWithTax()}  
            </td>
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_prime']])}
         <td>
              {$item->getFormattedPrime()}      
        </td>  
        {/if}
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_tax_credit']])}
         <td>
             {$item->getFormattedTaxCredit()}                  
        </td>  
        {/if}
           {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_qmac']])}
         <td>
             {$item->getFormattedQmac()}              
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_number_of_people']])}
         <td>
              {$item->getNumberOfPeople()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_number_of_children']])}
          <td>
              {$item->getNumberOfChildren()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_tax_credit_used']])}
         <td>
             {$item->getFormattedTaxCreditUsed()}                  
        </td>  
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_rest_in_charge']])}
         <td>
             {$item->getFormattedRestInCharge()}                  
        </td>  
        {/if}
          {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_credit_limit']])}
              <td>{$item->getFormattedTaxCreditLimit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_rest_in_charge_after_credit']])}
             <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
        {/if}
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_tax_credit_available']])}
               <td>{$item->getFormattedTaxCreditAvailable()}</td>
        {/if}
             <td>
               {__($item->get('is_signed'))} 
               {if $item->isSigned()}
               {component name="/app_domoprime_yousign/linkForSignedQuotationPagerForContract" quotation=$item}
               {component name="/app_domoprime_yousign_evidence/linkForSignedQuotationPagerForContract" quotation=$item}
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
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_status']])} 
            <td class="DomoprimeQuotationForViewContract Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            {/if}
            <td>               
               {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_edit']])}
                 <a href="#" title="{__('Edit')}" class="DomoprimeQuotationForViewContract-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a> 
               {/if}      
               {*  <a href="#" title="{__('Display')}" class="DomoprimeQuotationForViewContract-Display" id="{$item->get('id')}">
                     <i class="fa fa-search"></i></a>  *}
                  {if !$item->isSigned()} 
                     {*component name="/app_domoprime_yousign/linkForQuotationPagerForContract" quotation=$item*} 
                     {*component name="/app_domoprime_yousign/linkSignatureForQuotationPagerForContract" quotation=$item*}    
                     {component name="/app_domoprime_yousign/linkIframeUrlForQuotationPagerForContract" quotation=$item} 
                     {component name="/app_domoprime_yousign/linkIframeForQuotationPagerForContract" quotation=$item}    
                     {component name="/app_domoprime_yousign_evidence/linkIframeForQuotationPagerForContract" quotation=$item}    
                     {component name="/app_domoprime_yousign_evidence/linkIframeInitiatorForQuotationPagerForContract" quotation=$item}    
                  {/if}
                 {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_create_billing']])} 
                  {if $contract->hasOpcAt()}
                   <a href="#" title="{__('Billing')}" class="CreateBillingForContract" name="{$item->get('reference')}" id="{$item->get('id')}">
                      <i class="fa fa-euro"></i></a> 
                  {else}
                     <a style="opacity:0.6;" href="#" title="{__('Billing')}" class="CreateBillingHoldForContract" name="{$item->get('reference')}" id="{$item->get('id')}">
                      <i class="fa fa-euro"></i></a>   
                  {/if}    
                 {/if}  
                  <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForViewContract-ExportPdf">
                      <i class="fa fa-file-pdf-o"></i></a> 
                  {if  $user->hasCredential([['superadmin','admin','app_domoprime_contract_view_quotation_delete']])}
                      
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotationForViewContract-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotationForViewContract-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if}                  
                  {/if}
                  {if  $user->hasCredential([['superadmin']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotationForViewContract-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
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
        <input type="checkbox" id="DomoprimeQuotationForViewContract-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotationForViewContract-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotationForViewContract-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotationForViewContract"}
<div id="Dialog-QuotationForContrat" title="{__('Billing creation confirmation')}" style="display:none">
    <div id="Dialog-QuotationForContrat-Billing"></div>
    <br/>
    <div>
        {__('Send email to customer ?')}<input type="checkbox" id="SendBillingEmailCustomer" value="YES"/>
    </div>
</div>
    
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationForViewContractFilterParameters()
        {
            var params={    Contract: '{$contract->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeQuotationForViewContract-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotationForViewContract-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotationForViewContract-order_active").attr("name")] =$(".DomoprimeQuotationForViewContract-order_active").attr("id");   
            $(".DomoprimeQuotationForViewContract-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationForViewContractFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationForViewContractFilterParameters(), 
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewContract'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#quotations-target-{$contract->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotationForViewContract-pager .DomoprimeQuotationForViewContract-active").html()?parseInt($(".DomoprimeQuotationForViewContract-pager .DomoprimeQuotationForViewContract-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotationForViewContract-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotationForViewContract-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotationForViewContract-nb_results").html())-n;
           $("#DomoprimeQuotationForViewContract-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotationForViewContract-end_result").html($(".DomoprimeQuotationForViewContract-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForViewContract-init").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewContract'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#quotations-target-{$contract->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeQuotationForViewContract-order').click(function() {
                $(".DomoprimeQuotationForViewContract-order_active").attr('class','DomoprimeQuotationForViewContract-order');
                $(this).attr('class','DomoprimeQuotationForViewContract-order_active');
                return updateSiteDomoprimeQuotationForViewContractFilter();
           });
           
            $(".DomoprimeQuotationForViewContract-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationForViewContractFilter();
            });
            
          $("#DomoprimeQuotationForViewContract-filter").click(function() { return updateSiteDomoprimeQuotationForViewContractFilter(); }); 
          
          $("[name=DomoprimeQuotationForViewContract-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationForViewContractFilter(); }); 
          
         // $("[name=DomoprimeQuotationForViewContract-name]").change(function() { return updateSiteDomoprimeQuotationForViewContractFilter(); }); 
           
           $(".DomoprimeQuotationForViewContract-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationForViewContractFilterParameters(), 
                                 url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                                    loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#quotations-target-{$contract->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
        $("#DomoprimeQuotationForViewContract-New").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'NewQuotationFromRequestForViewContract'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#quotations-target-{$contract->get('id')}" 
                         }); 
           });
           
           $("#DomoprimeQuotationForViewContract-New2").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'NewQuotationFromRequestForViewContract2'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#quotations-target-{$contract->get('id')}" 
                               
                         }); 
           });  
           
           $(".DomoprimeQuotationForViewContract-View").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ViewQuotationFromRequestForViewContract'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#quotations-target-{$contract->get('id')}" 
                         }); 
           });
           
           
             $(".DomoprimeQuotationForViewContract-Display").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'DisplayQuotationForViewContract'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#quotations-target-{$contract->get('id')}" 
                         }); 
           });
           
           
           
             $(".DomoprimeQuotationForViewContract-Remove").click(function() {   
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'RemoveQuotation'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='RemoveQuotation')
                                        {    
                                            $(".DomoprimeQuotationForViewContract.list[id=DomoprimeQuotationForViewContract-"+resp.id+"]").remove();
                                            if ($('.DomoprimeQuotationForViewContract.list').length==0)
                                              return $.ajax2({  data : { Contract: '{$contract->get('id')}' },
                                                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForViewContract'])}",
                                                                errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                                                                loading: "#tab-site-dashboard-customers-contract-loading",
                                                                target: "#quotations-target-{$contract->get('id')}" });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
           $(".DomoprimeQuotationForViewContract-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotationForViewContract-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotationForViewContract-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotationForViewContract.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotationForViewContract-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotationForViewContract-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotationForViewContract-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotationForViewContract-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotationForViewContract.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotationForViewContract-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
           
           
            $(".CreateBillingForViewContract").click(function() {         
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
                            data : { Contract: '{$contract->get('id')}', DomoprimeQuotation: quotation, 
                                     Billing : { to_send: $("#SendBillingEmailCustomer:checked").val(), token: '{mfForm::getToken('CreateBillingForContract')}' },
                                   },
                            url:"{url_to('app_domoprime_ajax',['action'=>'CreateBillingForContract'])}" , 
                            errorTarget: ".customers-contract-view-app-domoprime-iso-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success : function (resp)
                                    {
                                        if (resp.action !='CreateBillingForContract') return ;
                                        $("#DomoprimeBillingForViewContract-Details").show();
                                        $("[name=DomoprimeBillingForViewContract-SendEmail]").show().attr('id',resp.id);
                                        $("#DomoprimeBillingForViewContract-Ctn").html('<a href="'+resp.url+'" target="_blank" title="{__('Export PDF')}" class="DomoprimeBillingForViewContract-ExportPdf">'+
                                                                                       '<i class="fa fa-file-pdf-o" style="font-size: 16px;"></i>'+
                                                                                       ' <span>'+resp.reference+'</span>'+                                                                                     
                                                                                       '</a>');
                                    }
                         });
                          
                          
                        },
                        "{__("NO")}": function() {
                          $( this ).dialog( "close" );
                        }
                      }
                });                           
           });
       
           
      $(".CreateBillingHoldForViewContract").click(function() {         
                alert("{__("Opc date is required to create billing.")}");            
      });
      
      $("#DomoprimeQuotationForViewContract-Details").click(function () { 
          $(this).toggleClass('Hide');
          if ($(this).hasClass('Hide'))
             $("#contract-view-quotations-details").show();
          else
             $("#contract-view-quotations-details").hide();
      });
</script>       

 {*component name="/app_domoprime_yousign/javascriptForQuotationPagerForContract"*}     
{else}
    {__('Contract is invalid.')}
{/if}    
  



</div>

