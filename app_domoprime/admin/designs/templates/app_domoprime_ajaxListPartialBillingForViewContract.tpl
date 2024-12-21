{messages class="customers-contract-app-domoprime-billing-contract-errors"}
{if $contract->isLoaded()}
<div>
  {if $last_billing && $last_billing->isLoaded()}    
      <span id="DomoprimeBillingForViewContract-Ctn">
       <a href="{url_to('app_domoprime',['action'=>'ExportBillingPdf'])}?{__('Billing')}={$last_billing->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeBillingForViewContract-ExportPdf">
        <i class="fa fa-file-pdf-o" style="font-size: 16px;"></i>
        <span>{__('Billing')} {$last_billing->get('reference')} {$last_billing->getFormatter()->getDatedAt()->getFormatted()}</span>
       </a>   
      </span>
       {if $user->hasCredential([['superadmin','admin','app_domoprime_contrat_billing_list_send_email']])}
        <a href="javascript:void(0);"  title="{__('Send by email to customer')}" id="{$last_billing->get('id')}" class="DomoprimeBillingForViewContract-SendEmail">
               <i class="fa fa-envelope"></i></a> 
       {/if} 
        <a href="javascript:void(0);" title="{__('Details')}" class="Hide" id="DomoprimeBillingForViewContract-Details">
            <i class="fa fa-search" style="font-size: 16px;"></i></a>  
  {else}      
      <span id="DomoprimeBillingForViewContract-Ctn">
          {__('No billing')}
      </span> 
      <a href="javascript:void(0);" title="{__('Details')}" class="Hide" id="DomoprimeBillingForViewContract-Details">
                     <i class="fa fa-search" style="font-size: 16px;"></i></a>  
  {/if}                    
</div>

<div id="contract-view-billings-details">
    <h3>{__('Billings')}</h3>  
    {include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeBillingForViewContract"}
    <button id="DomoprimeBillingForViewContract-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeBillingForViewContract-init" class="btn-table">{__("Init")}</button>
    <table class="tabl-list  footable table table-form" cellpadding="0" cellspacing="0"> 
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
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_prime']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Prime')}</span>               
            </th>  
            {/if}
                {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_tax_credit']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Tax credit')}</span>               
            </th>  
            {/if}
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_qmac']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Qmac')}</span>               
            </th>  
            {/if}
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_number_of_people']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Number of people')}</span>               
            </th>  
            {/if}
               {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_number_of_children']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Number of children')}</span>               
            </th>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_tax_credit_used']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Tax credit used')}</span>               
            </th>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_in_charge']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Rest in charge')}</span>               
            </th>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_credit_limit']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Credit limit')}</span>               
            </th>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_in_charge_after_credit']])}
             <th  class="footable-first-column" data-toggle="true">
                <span>{__('Rest in charge after credit')}</span>               
            </th>  
            {/if}
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_tax_credit_available']])}
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
           <td>{* name *}</td>                                     
                 {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_prime']])}
             <td>

            </td>  
            {/if}
                 {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_tax_credit']])}
             <td>

            </td>  
            {/if}
                {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_qmac']])}
             <td>

            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_number_of_people']])}
             <td>

            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_number_of_children']])}
             <td>               
            </td>  
            {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_tax_credit_used']])}
             <td>

            </td>  
            {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_in_charge']])}
             <td>

            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_credit_limit']])}
                 <td></td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_in_charge_after_credit']])}
                 <td></td>
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_tax_credit_available']])}
                 <td></td>
            {/if}
              <td>{* name *}</td>     
           <td>{* actions *}</td>
        </tr>   
        {foreach $pager as $item}
        <tr class="DomoprimeBillingForViewContract list" id="DomoprimeBillingForViewContract-{$item->get('id')}"> 
            <td class="DomoprimeBillingForViewContract-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
                <td>                
                 {$item->getFormatter()->getDatedAt()->getFormatted()}
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
                <td>
                  {$item->getFormattedTotalSaleWithTax()}   
                </td>
                       {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_prime']])}
             <td>
                  {$item->getFormattedPrime()}      
            </td>  
            {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_tax_credit']])}
             <td>
                 {$item->getFormattedTaxCredit()}                  
            </td>  
            {/if}
               {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_qmac']])}
             <td>
                 {$item->getFormattedQmac()}              
            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_number_of_people']])}
             <td>
                  {$item->getNumberOfPeople()}                  
            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_number_of_children']])}
              <td>
                  {$item->getNumberOfChildren()}                  
            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_tax_credit_used']])}
             <td>
                 {$item->getFormattedTaxCreditUsed()}                  
            </td>  
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_in_charge']])}
             <td>
                 {$item->getFormattedRestInCharge()}                  
            </td>  
            {/if}
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_credit_limit']])}
                  <td>{$item->getFormattedTaxCreditLimit()}</td>
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_in_charge_after_credit']])}
                 <td>{$item->getFormattedRestInChargeAfterCredit()}</td>
            {/if}
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_billing_rest_tax_credit_available']])}
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
                <td>                              
                    {if $user->hasCredential([['superadmin','admin','app_domoprime_contrat_billing_list_send_email']])}
                   <a href="javascript:void(0);"  title="{__('Send by email to customer')}" id="{$item->get('id')}" class="DomoprimeBillingForViewContract-SendEmail">
                          <i class="fa fa-envelope"></i></a> 
                   {/if}                     
                        <a href="{url_to('app_domoprime',['action'=>'ExportBillingPdf'])}?{__('Billing')}={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeBillingForViewContract-ExportPdf">
                          <i class="fa fa-file-pdf-o"></i></a>    
                          {if $user->hasCredential([['debug']])}
                       <a href="{url_to('app_domoprime',['action'=>'ExportBillingExtendedPdf'])}?{__('Billing')}={$item->get('id')}" target="_blank" title="{__('Export PDF')}">
                          <i class="fa fa-file-pdf-o"></i></a>  
                          {/if}                 
                </td>
        </tr>    
        {/foreach}    
    </table>    
    {if !$pager->getNbItems()}
         <span>{__('No billing')}</span>
    {else}
        {if $pager->getNbItems()>5}
            <input type="checkbox" id="DomoprimeBillingForViewContract-all" /> 
              <a style="opacity:0.5" class="DomoprimeBillingForViewContract-actions_items" href="#" title="{__('Delete')}" id="DomoprimeBillingForViewContract-Delete">
                  <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
              </a>         
        {/if}
    {/if}    
    {include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeBillingForViewContract"}
   
</div>
     <script type="text/javascript">

            function getSiteDomoprimeBillingForViewContractFilterParameters()
            {
                var params={    Contract: '{$contract->get('id')}',
                                filter: {  order : { }, 
                                        search : { },
                                        equal: { },                                                                                                                                   
                                    nbitemsbypage: $("[name=DomoprimeBillingForViewContract-nbitemsbypage]").val(),
                                    token:'{$formFilter->getCSRFToken()}'
                             } };
                if ($(".DomoprimeBillingForViewContract-order_active").attr("name"))
                     params.filter.order[$(".DomoprimeBillingForViewContract-order_active").attr("name")] =$(".DomoprimeBillingForViewContract-order_active").attr("id");   
                $(".DomoprimeBillingForViewContract-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
                return params;                  
            }

            function updateSiteDomoprimeBillingForViewContractFilter()
            {           
               return $.ajax2({ data: getSiteDomoprimeBillingForViewContractFilterParameters(), 
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}"
                                 });
            }

            function updateSitePager(n)
            {
               page_active=$(".DomoprimeBillingForViewContract-pager .DomoprimeBillingForViewContract-active").html()?parseInt($(".DomoprimeBillingForViewContract-pager .DomoprimeBillingForViewContract-active").html()):1;
               records_by_page=$("[name=DomoprimeBillingForViewContract-nbitemsbypage]").val();
               start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
               $(".DomoprimeBillingForViewContract-count").each(function(id) { $(this).html(start+id) }); // Update index column           
               nb_results=parseInt($("#DomoprimeBillingForViewContract-nb_results").html())-n;
               $("#DomoprimeBillingForViewContract-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
               $("#DomoprimeBillingForViewContract-end_result").html($(".DomoprimeBillingForViewContract-count:last").html());
            }



              {* =====================  P A G E R  A C T I O N S =============================== *}  

               $("#DomoprimeBillingForViewContract-init").click(function() {                  
                   return $.ajax2({                     
                                data : { Contract: '{$contract->get('id')}' },
                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}" 
                             }); 
               });

              $('.DomoprimeBillingForViewContract-order').click(function() {
                    $(".DomoprimeBillingForViewContract-order_active").attr('class','DomoprimeBillingForViewContract-order');
                    $(this).attr('class','DomoprimeBillingForViewContract-order_active');
                    return updateSiteDomoprimeBillingForViewContractFilter();
               });

                $(".DomoprimeBillingForViewContract-search").keypress(function(event) {
                    if (event.keyCode==13)
                        return updateSiteDomoprimeBillingForViewContractFilter();
                });

              $("#DomoprimeBillingForViewContract-filter").click(function() { return updateSiteDomoprimeBillingForViewContractFilter(); }); 

              $("[name=DomoprimeBillingForViewContract-nbitemsbypage]").change(function() { return updateSiteDomoprimeBillingForViewContractFilter(); }); 

             // $("[name=DomoprimeBillingForViewContract-name]").change(function() { return updateSiteDomoprimeBillingForViewContractFilter(); }); 

               $(".DomoprimeBillingForViewContract-pager").click(function () {                    
                    return $.ajax2({ data: getSiteDomoprimeBillingForViewContractFilterParameters(), 
                                     url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialBillingForViewContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                    errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                        loading: "#tab-site-dashboard-customers-contract-loading",
                                    target: "#billings-target-{$contract->get('id')}"
                    });
            });
              {* =====================  A C T I O N S =============================== *}  



                $(".DomoprimeBillingForViewContract-View").click(function() {                  
                   return $.ajax2({                     
                                data : { Contract: '{$contract->get('id')}', DomoprimeBilling: $(this).attr('id') },
                                url:"{url_to('app_domoprime_ajax',['action'=>'ViewBillingForViewContract'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#billings-target-{$contract->get('id')}" 
                             }); 
               });


                $(".DomoprimeBillingForViewContract-SendEmail").click(function () { 
               return $.ajax2({ data : { Billing: $(this).attr('id') },                                              
                                url:"{url_to('app_domoprime_ajax',['action'=>'SendEmailBilling'])}" , 
                                errorTarget: ".customers-contract-app-domoprime-billing-contract-errors",    
                                loading: "#tab-site-dashboard-customers-contract-loading",
                                success : function (resp)
                                        {
                                        }
                             }); 
           });
           
           
      $("#DomoprimeBillingForViewContract-Details").click(function () { 
          $(this).toggleClass('Hide');
          if ($(this).hasClass('Hide'))
             $("#contract-view-billings-details").show();
          else
             $("#contract-view-billings-details").hide();
      });
    </script>  
    
{else}
    {__('Contract is invalid.')}
{/if}    
 

