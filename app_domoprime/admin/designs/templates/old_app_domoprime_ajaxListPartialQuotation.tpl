{messages class="customers-meeting-app-domoprime-quotation-errors"}
<h3>{__('Quotations')}</h3> 
<div>
    {component name="/app_domoprime_yousign/linkForQuotation"}
     {if $user->hasCredential([['superadmin','admin','app_domoprime_quotation_export']])} 
            <a target="_blank" href="{url_to('app_domoprime',['action'=>'ExportCsvQuotations'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range'])}" class="btn widthAFilter" title="{__('Export')}" >
            <i class="fa fa-caret-square-o-down" style="margin-right:5px"></i>{__('Export')}</a>   
     {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeQuotation"}
<button id="DomoprimeQuotation-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeQuotation-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
    <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
        </th>
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
           <th data-hide="phone" style="display: table-cell;">
            <span>{__('Signed')}</span>  
        </th> 
          <th data-hide="phone" style="display: table-cell;">
            <span>{__('Created at')}</span>  
        </th> 
         <th data-hide="phone" style="display: table-cell;">
            <span>{__('Status')}</span>  
        </th> 
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead> 
    {* search/equal/range *}
    <tr class="input-list">
       <td>{* id *}</td>
       <td>{* id *}
        <input class="DomoprimeQuotation-search" placeholder="{__('Customer')}" type="text" size="8" name="lastname" value="{$formFilter.search.lastname}"> 
        <input class="DomoprimeQuotation-search" placeholder="{__('Phone')}" type="text" size="8" name="phone" value="{$formFilter.search.phone}"> 
       </td>      
        <td>{* id *}        
        </td>
        <td>
             <input class="DomoprimeQuotation-search" placeholder="{__('Reference')}" type="text" size="8" name="reference" value="{$formFilter.search.reference}"> 
        </td>
       <td>{* id *}</td>
         <td>{* id *}</td>
           <td>{* id *}</td>
          <td>{* id *}</td>
       <td>{* name *}</td>   
          <td>{* name *}</td> 
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeQuotation list" id="DomoprimeQuotation-{$item->get('id')}"> 
        <td class="DomoprimeQuotation-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
              {$item->getCustomer()|upper} - {$item->getCustomer()->getFormattedPhone()}
            </td>
            <td> 
                  {$item->getFormatter()->getDatedAt()->getText()}
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
            <td>
                {__($item->get('is_signed'))}
            </td> 
            <td>
                {$item->getFormatter()->getCreatedAt()->getFormatted(['d','q'])}
            </td>  
             <td class="DomoprimeQuotation Status" id="{$item->get('id')}">
              {$item->getStatusI18n()}  
            </td>
            <td>               
                 
                <a href="#" title="{__('Edit')}" class="DomoprimeQuotation-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>    
                 <a href="{url_to('app_domoprime',['action'=>'ExportQuotationPdf'])}?Quotation={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeQuotationForMeeting-ExportPdf">
                     <img  src="{url('/icons/files/pdf.gif','picture')}" alt='{__("Export PDF")}'/></a> 
                  
                       {if $item->get('status')=='ACTIVE'}
                        <a href="#" title="{__('Delete')}" class="DomoprimeQuotation-Status Delete" name="{$item->get('reference')}" id="{$item->get('id')}">
                     <i class="fa fa-trash"></i></a> 
                    {else} 
                      <a href="#" title="{__('Recycle')}" class="DomoprimeQuotation-Status Recycle" name="{$item->get('reference')}" id="{$item->get('id')}">
                        <i class="fa fa-recycle"></i></a>    
                    {/if} 
                 {if  $user->hasCredential([['superadmin','admin','domoprime_quotation_list_remove']])}
                   <a href="#" title="{__('Remove')}" class="DomoprimeQuotation-Remove" name="{$item->get('reference')}" id="{$item->get('id')}">
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
        <input type="checkbox" id="DomoprimeQuotation-all" /> 
          <a style="opacity:0.5" class="DomoprimeQuotation-actions_items" href="#" title="{__('Delete')}" id="DomoprimeQuotation-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeQuotation"}
<script type="text/javascript">
 
        function getSiteDomoprimeQuotationFilterParameters()
        {
            var params={    filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeQuotation-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeQuotation-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeQuotation-order_active").attr("name")] =$(".DomoprimeQuotation-order_active").attr("id");   
            $(".DomoprimeQuotation-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeQuotationFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeQuotationFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                               loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeQuotation-pager .DomoprimeQuotation-active").html()?parseInt($(".DomoprimeQuotation-pager .DomoprimeQuotation-active").html()):1;
           records_by_page=$("[name=DomoprimeQuotation-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeQuotation-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeQuotation-nb_results").html())-n;
           $("#DomoprimeQuotation-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeQuotation-end_result").html($(".DomoprimeQuotation-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotation-init").click(function() {                  
               return $.ajax2({                                               
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base" 
                         }); 
           });
    
          $('.DomoprimeQuotation-order').click(function() {
                $(".DomoprimeQuotation-order_active").attr('class','DomoprimeQuotation-order');
                $(this).attr('class','DomoprimeQuotation-order_active');
                return updateSiteDomoprimeQuotationFilter();
           });
           
            $(".DomoprimeQuotation-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeQuotationFilter();
            });
            
          $("#DomoprimeQuotation-filter").click(function() { return updateSiteDomoprimeQuotationFilter(); }); 
          
          $("[name=DomoprimeQuotation-nbitemsbypage]").change(function() { return updateSiteDomoprimeQuotationFilter(); }); 
          
         // $("[name=DomoprimeQuotation-name]").change(function() { return updateSiteDomoprimeQuotationFilter(); }); 
           
           $(".DomoprimeQuotation-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeQuotationFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotation'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
            $(".DomoprimeQuotation-Remove").click(function() {   
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
                                            $(".DomoprimeQuotation.list[id=DomoprimeQuotation-"+resp.id+"]").remove();
                                            if ($('.DomoprimeQuotation.list').length==0)
                                              return $.ajax2({ 
                                                    url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotation'])}" , 
                                                    errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                                                    target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-10-quotations-base"                 
                                                });
                                          updateSitePager(1);
                                        }
                                    }
                         }); 
           });
           
           
             $(".DomoprimeQuotation-Status").click(function() {   
                if (!$(this).hasClass('Delete'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'DisableQuotation'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='DisableQuotation')
                                        {                                               
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").addClass("Recycle").removeClass('Delete');                                 
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").attr('title',"{__('Recycle')}");
                                            $(".DomoprimeQuotation.Status[id="+resp.id+"]").html("{__("DELETE")}");
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"] i").attr('class','fa fa-recycle');
                                        }
                                    }
                         }); 
           });
           
           
            $(".DomoprimeQuotation-Status").click(function() {   
                if (!$(this).hasClass('Recycle'))
                    return ;  
               if (!confirm('{__("Quotation \"#0#\" will be recycled. Confirm ?")}'.format($(this).attr('name')))) return false; 
               return $.ajax2({                     
                            data : { DomoprimeQuotation: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'EnableQuotation'])}" , 
                        errorTarget: ".customers-meeting-app-domoprime-quotation-errors",    
                              loading: "#tab-site-dashboard-customers-meeting-app-domoprime-10-quotations-loading",
                            success: function (resp)
                                    {
                                        if (resp.action=='EnableQuotation')
                                        {    
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").addClass("Delete").removeClass('Recycle');                                 
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"]").attr('title',"{__('Delete')}");
                                            $(".DomoprimeQuotation.Status[id="+resp.id+"]").html("{__("ACTIVE")}");
                                            $(".DomoprimeQuotation-Status[id="+resp.id+"] i").attr('class','fa fa-trash');
                                        }
                                    }
                         }); 
           });
</script>
