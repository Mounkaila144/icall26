{messages class="customers-meeting-app-domoprime-asset-errors"}
<h3>{__('Assets')}</h3> 
<div>
       {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_export']])} 
            <a target="_blank" href="{url_to('app_domoprime',['action'=>'ExportCsvAssets'])}?{$formFilter->getParametersForUrl(['equal','in','begin','search','range'])}" class="btn widthAFilter" title="{__('Export')}" >
            <i class="fa fa-caret-square-o-down" style="margin-right:5px"></i>{__('Export')}</a>   
     {/if}
</div>
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formfilter=$formFilter class="DomoprimeAsset"}
<button id="DomoprimeAsset-filter" class="btn-table" >{__("Filter")}</button>   <button id="DomoprimeAsset-init" class="btn-table">{__("Init")}</button>
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead>
    <tr class="list-header">    
    <th>#</th>   
    <th  class="footable-first-column" data-toggle="true">
            <span>{__('Customer')}</span>               
        </th>
        {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_date']])}
        <th  class="footable-first-column" data-toggle="true">
            <span>{__('Date')}</span>               
        </th>
        {/if}
          <th  class="footable-first-column" data-toggle="true">
            <span>{__('Reference')}</span>               
        </th>       
        {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_sales_ttc']])}
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
        {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_date']])}
       <td>{* id *}</td>
       {/if}
        <td>{* id *}        
        </td>
         {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_sales_ttc']])}
           <td>{* id *}</td>
           {/if}
       <td>{* id *}</td>
         <td>{* id *}</td>
          <td>{* id *}</td>      
    </tr>   
    {foreach $pager as $item}
    <tr class="DomoprimeAsset list" id="DomoprimeAsset-{$item->get('id')}"> 
        <td class="DomoprimeAsset-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>                                              
            <td>                
             {$item->getCustomer()|upper}
            </td>
            {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_date']])}
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
             {if $user->hasCredential([['superadmin','admin','app_domoprime_asset_sales_ttc']])}
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
                 
               {* <a href="#" title="{__('Edit')}" class="DomoprimeAsset-View" id="{$item->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a>  *}                      
            </td>
    </tr>    
    {/foreach}    
</table>    
{if !$pager->getNbItems()}
     <span>{__('No asset')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="DomoprimeAsset-all" /> 
          <a style="opacity:0.5" class="DomoprimeAsset-actions_items" href="#" title="{__('Delete')}" id="DomoprimeAsset-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="DomoprimeAsset"}
<script type="text/javascript">
 
        function getSiteDomoprimeAssetFilterParameters()
        {
            var params={    filter: {  order : { }, 
                                    search : { },
                                    equal: { },                                                                                                                                   
                                nbitemsbypage: $("[name=DomoprimeAsset-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".DomoprimeAsset-order_active").attr("name"))
                 params.filter.order[$(".DomoprimeAsset-order_active").attr("name")] =$(".DomoprimeAsset-order_active").attr("id");   
            $(".DomoprimeAsset-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteDomoprimeAssetFilter()
        {           
           return $.ajax2({ data: getSiteDomoprimeAssetFilterParameters(), 
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAsset'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-asset-errors",    
                             loading: "#tab-site-dashboard-customers-meeting-app-domoprime-22-assets-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-22-assets-base"
                             });
        }
    
        function updateSitePager(n)
        {
           page_active=$(".DomoprimeAsset-pager .DomoprimeAsset-active").html()?parseInt($(".DomoprimeAsset-pager .DomoprimeAsset-active").html()):1;
           records_by_page=$("[name=DomoprimeAsset-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".DomoprimeAsset-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#DomoprimeAsset-nb_results").html())-n;
           $("#DomoprimeAsset-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#DomoprimeAsset-end_result").html($(".DomoprimeAsset-count:last").html());
        }
        
           
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeAsset-init").click(function() {                  
               return $.ajax2({                                               
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAsset'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-asset-errors",    
                             loading: "#tab-site-dashboard-customers-meeting-app-domoprime-22-assets-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-22-assets-base"
                         }); 
           });
    
          $('.DomoprimeAsset-order').click(function() {
                $(".DomoprimeAsset-order_active").attr('class','DomoprimeAsset-order');
                $(this).attr('class','DomoprimeAsset-order_active');
                return updateSiteDomoprimeAssetFilter();
           });
           
            $(".DomoprimeAsset-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteDomoprimeAssetFilter();
            });
            
          $("#DomoprimeAsset-filter").click(function() { return updateSiteDomoprimeAssetFilter(); }); 
          
          $("[name=DomoprimeAsset-nbitemsbypage]").change(function() { return updateSiteDomoprimeAssetFilter(); }); 
          
         // $("[name=DomoprimeAsset-name]").change(function() { return updateSiteDomoprimeAssetFilter(); }); 
           
           $(".DomoprimeAsset-pager").click(function () {                    
                return $.ajax2({ data: getSiteDomoprimeAssetFilterParameters(), 
                                 url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialAsset'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                errorTarget: ".customers-meeting-app-domoprime-asset-errors",    
                                    loading: "#tab-site-dashboard-customers-meeting-app-domoprime-22-assets-loading",
                                target: "#tab-site-panel-dashboard-customers-meeting-app-domoprime-22-assets-base"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
         
</script>


