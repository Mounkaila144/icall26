{messages class="customers-contract-app-domoprime-asset-contract-errors"}
{if $contract->isLoaded()}
{$contract->getCustomer()|upper}    
<div>
   {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_asset_new']])}  
  <a href="#" class="btn" id="DomoprimeAssetForContract-New" title="{__('New asset')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New asset')}</a>      
  {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeAssetForContract"}
<button id="DomoprimeAssetForContract-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeAssetForContract-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
        <th>#</th>  
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_asset_date']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        {/if}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>       
        {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_asset_sales_ttc']])}
         <th  class="footable-first-column" data-toggle="true">
            <span>{__('Total TTC')}</span>               
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
         {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_asset_date']])}
           <td>{* id *}</td>
         {/if}  
       <td>{* id *}</td>       
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_asset_ttc']])}         
           <td>{* id *}</td>
           {/if}
       <td>{* name *}</td>         
       <td>{* actions *}</td>
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeAssetForContract list" id="DomoprimeAssetForContract-{$item->get('id')}"> 
        <td class="DomoprimeAssetForContract-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_asset_date']])}
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
              {if $user->hasCredential([['superadmin','admin','app_domoprime_contract_asset_ttc']])}     
            <td>
              {$item->getFormattedTotalWithTax()}
            </td>
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
                {if !$contract->isHold() || $user->hasCredential([['superadmin','admin','app_domoprime_list_asset_edit']])}  
                <a href="#" title="{__('Edit')}" class="DomoprimeAssetForContract-View" id="{$item->get('id')}">
                     <i class="fa fa-edit"></i></a> 
                {/if}
                <a href="{url_to('app_domoprime',['action'=>'ExportAssetPdf'])}?Asset={$item->get('id')}" target="_blank" title="{__('Export PDF')}" class="DomoprimeAssetForContract-ExportPdf">
                      <i class="fa fa-file-pdf-o"></i></a>                                        
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No asset')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeAssetForContract-all" /> 
          <a style="opacity:0.5" class="DomoprimeAssetForContract-actions_items" href="#" title="{__('Delete')}" id="DomoprimeAssetForContract-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeAssetForContract"}
<script type="text/javascript">
 
        function getSiteDomoprimeAssetForContractFilterParameters()
        {
            var params={    Contract: '{$contract->get('id')}',
                            filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeAssetForContract-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeAssetForContract-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeAssetForContract-order_active").attr("name")] =$(".DomoprimeAssetForContract-order_active").attr("id");   
            $(".DomoprimeAssetForContract-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeAssetForContractFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeAssetForContractFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-assets-{$contract->get('id')}"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeAssetForContract-pager .DomoprimeAssetForContract-active").html()?parseInt($(".DomoprimeAssetForContract-pager .DomoprimeAssetForContract-active").html()):1;
           records_by_page=$("[name=DomoprimeAssetForContract-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeAssetForContract-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeAssetForContract-nb_results").html())-n;
           $("#DomoprimeAssetForContract-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeAssetForContract-end_result").html($(".DomoprimeAssetForContract-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeAssetForContract-init").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-assets-{$contract->get('id')}" 
                         }); 
           });
    
          $('.DomoprimeAssetForContract-order').click(function() {
                $(".DomoprimeAssetForContract-order_active").attr('class','DomoprimeAssetForContract-order');
                $(this).attr('class','DomoprimeAssetForContract-order_active');
                return updateSiteDomoprimeAssetForContractFilter();
           });
           
            $(".DomoprimeAssetForContract-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeAssetForContractFilter();
            });
            
          $("#DomoprimeAssetForContract-filter").click(function() { return updateSiteDomoprimeAssetForContractFilter(); }); 
          
          $("[name=DomoprimeAssetForContract-nbitemsbypage]").change(function() { return updateSiteDomoprimeAssetForContractFilter(); }); 
          
         // $("[name=DomoprimeAssetForContract-name]").change(function() { return updateSiteDomoprimeAssetForContractFilter(); }); 
           
           $(".DomoprimeAssetForContract-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeAssetForContractFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAssetForContract'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",    
                                    loading: "#tab-site-dashboard-customers-contract-loading",
                                target: "#tab-customer-contracts-assets-{$contract->get('id')}"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
        $("#DomoprimeAssetForContract-New").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'NewAssetForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-assets-{$contract->get('id')}" 
                         }); 
           });
           
           
           
           $(".DomoprimeAssetForContract-View").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}', DomoprimeAsset: $(this).attr('id') },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ViewAssetForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-asset-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-assets-{$contract->get('id')}" 
                         }); 
           });
           
      
           
           
     
</script>   
  
{else}
    {__('Contract is invalid.')}
{/if}    
  


