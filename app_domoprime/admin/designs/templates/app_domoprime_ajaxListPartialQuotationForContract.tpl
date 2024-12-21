{messages class="customers-contract-app-domoprime-quotation-contract-errors"}
{if $contract->isLoaded()}
{$contract->getCustomer()|upper}    
<div>  
  {if !$contract->getQuotations() && !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_contract_list_quotation_new']])}      
  <a href="#" class="btn" id="DomoprimeQuotationForContract-New" title="{__('New quotation')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New quotation')}</a>      
  {/if}
    {if !$contract->getQuotations() && !$contract->isHold() || $user->hasCredential([['superadmin','app_domoprime_contract_list_quotation_new2']])}      
  <a href="#" class="btn" id="DomoprimeQuotationForContract-New2" title="{__('New quotation')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New quotation2')}</a>      
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotationForContract"}
<button id="DomoprimeQuotationForContract-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeQuotationForContract-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
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
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
        <td>{* id *}        
        </td>
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_date']])}
           <td>{* id *}</td>
         {/if}  
       <td>{* id *}</td>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_ht']])}
         <td>{* id *}</td>
         {/if}        
             {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_taxe']])}
          <td>{* id *}</td>
          {/if}
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_sales_ttc']])}         
           <td>{* id *}</td>
           {/if}
       <td>{* name *}</td>     
        <td>{* name *}</td>   
          <td>{* name *}</td>   
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_quotation_status']])}
         <td>{* name *}</td> 
         {/if}
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeQuotationForContract list" id="DomoprimeQuotationForContract-{$item->get('id')}"> 
        <td class="DomoprimeQuotationForContract-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
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
             <td>
               {__($item->get('is_signed'))} 
               {if $item->isSigned()}
               {component name="/app_domoprime_yousign/linkForSignedQuotationPagerForContract" quotation=$item}
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
            <td class="DomoprimeQuotationForContract Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            {/if}
            <td>               
               {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_quotation_edit']])}
                 <a href="#" title="{__('Edit')}" class="DomoprimeQuotationForContract-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a> 
               {/if}      
                 <a href="#" title="{__('Display')}" class="DomoprimeQuotationForContract-Display" id="{$item->get('id')}">
                     <i class="fa fa-search"></i></a> 
                  {if !$item->isSigned()} 
                     {component name="/app_domoprime_yousign/linkExternForQuotationPagerForContract" quotation=$item} 
                     {component name="/app_domoprime_yousign/linkForQuotationPagerForContract" quotation=$item} 
                     {*component name="/app_domoprime_yousign/linkSignatureForQuotationPagerForContract" quotation=$item*}    
                     {component name="/app_domoprime_yousign/linkIframeForQuotationPagerForContract" quotation=$item}    
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
                  <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForContract-ExportPdf">
                      <i class="fa fa-file-pdf-o"></i></a> 
                  {if  $user->hasCredential([['superadmin','admin','app_domoprime_contract_view_quotation_delete']])}
                      
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotationForContract-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotationForContract-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if}                  
                  {/if}
                  {if  $user->hasCredential([['superadmin']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotationForContract-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
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
        <input type="checkbox" id="DomoprimeQuotationForContract-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotationForContract-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotationForContract-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotationForContract"}
<div id="Dialog-QuotationForContrat" title="{__('Billing creation confirmation')}" style="display:none">
    <div id="Dialog-QuotationForContrat-Billing"></div>
    <br/>
    <div>
        {__('Send email to customer ?')}<input type="checkbox" id="SendBillingEmailCustomer" value="YES"/>
    </div>
</div>
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationForContractFilterParameters()
        {
            var params={    Contract: '{$contract->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeQuotationForContract-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotationForContract-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotationForContract-order_active").attr("name")] =$(".DomoprimeQuotationForContract-order_active").attr("id");   
            $(".DomoprimeQuotationForContract-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationForContractFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationForContractFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotationForContract-pager .DomoprimeQuotationForContract-active").html()?parseInt($(".DomoprimeQuotationForContract-pager .DomoprimeQuotationForContract-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotationForContract-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotationForContract-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotationForContract-nb_results").html())-n;
           $("#DomoprimeQuotationForContract-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotationForContract-end_result").html($(".DomoprimeQuotationForContract-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForContract-init").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeQuotationForContract-order').click(function() {
                $(".DomoprimeQuotationForContract-order_active").attr('class','DomoprimeQuotationForContract-order');
                $(this).attr('class','DomoprimeQuotationForContract-order_active');
                return updateSiteDomoprimeQuotationForContractFilter();
           });
           
            $(".DomoprimeQuotationForContract-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationForContractFilter();
            });
            
          $("#DomoprimeQuotationForContract-filter").click(function() { return updateSiteDomoprimeQuotationForContractFilter(); }); 
          
          $("[name=DomoprimeQuotationForContract-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationForContractFilter(); }); 
          
         // $("[name=DomoprimeQuotationForContract-name]").change(function() { return updateSiteDomoprimeQuotationForContractFilter(); }); 
           
           $(".DomoprimeQuotationForContract-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationForContractFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                                    loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#tab-customer-contracts-quotations-{$contract->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
        $("#DomoprimeQuotationForContract-New").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'NewQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
           
           
           
           $(".DomoprimeQuotationForContract-View").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ViewQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
           
           
             $(".DomoprimeQuotationForContract-Display").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}', DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisplayQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
           
           
           
             $(".DomoprimeQuotationForContract-Remove").click(function() {   
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'RemoveQuotation'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='RemoveQuotation')
                                        {    
                                            $(".DomoprimeQuotationForContract.list[id=DomoprimeQuotationForContract-"+resp.id+"]").remove();
                                            if ($('.DomoprimeQuotationForContract.list').length==0)
                                              return $.ajax2({  data : { Contract: '{$contract->get('id')}' },
                                                                url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForContract'])}",
                                                                errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                                                                loading: "#tab-site-dashboard-customers-contract-loading",
                                                                target: "#tab-customer-contracts-quotations-{$contract->get('id')}" });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
           $(".DomoprimeQuotationForContract-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotationForContract-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotationForContract-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotationForContract.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotationForContract-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotationForContract-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotationForContract-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotationForContract-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotationForContract.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotationForContract-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
           
           
            $(".CreateBillingForContract").click(function() {         
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
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
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
       
           
      $(".CreateBillingHoldForContract").click(function() {         
                alert("{__("Opc date is required to create billing.")}");            
      });
      
      
      
        $("#DomoprimeQuotationForContract-New2").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'NewQuotation2ForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
</script>   
 {component name="/app_domoprime_yousign/javascriptForQuotationPagerForContract"}     
{else}
    {__('Contract is invalid.')}
{/if}    
  

