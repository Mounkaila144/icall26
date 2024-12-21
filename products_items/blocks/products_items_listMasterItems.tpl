<div>
<h4>{__('List For Master')}</h4>  
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formFilter=$formFilter class="ProductMaster"}
<button id="ProductMaster-filter" class="btn-table">{__("Filter")}</button> 
<button id="ProductMaster-init" class="btn-table">{__("Init")}</button>
<div class="containerDivResp">
 <table cellpadding="0" cellspacing="0" class="tabl-list footable table">  
     <thead> 
    <tr  class="list-header">     
        <th data-hide="phone" style="display: table-cell;" >#</th>   
        <th data-hide="phone" style="display: table-cell;" >ID</th> 
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('IDs slaves')}</span>          
        </th>
         {if $user->hasCredential([['superadmin','settings_product_item_mark_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Mark')}</span>               
        </th>
        {/if} 
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Title')}</span>               
        </th>   
         {if $user->hasCredential([['superadmin','settings_product_item_coefficient_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Coefficient')}</span>               
        </th>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_tva_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('TVA')}</span>               
        </th>
        {/if}          
          {if $user->hasCredential([['superadmin','settings_product_item_purchasing_price_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Purchasing price')}</span>               
        </th>
        {/if}
         {if $user->hasCredential([['superadmin','settings_product_item_sale_price_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Sale price HT')} </span>               
        </th>
        {/if}       
         {if $user->hasCredential([['superadmin','settings_product_item_sale_price_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Sale price TTC')}</span>               
        </th>
        {/if} 
          {if $user->hasCredential([['superadmin','settings_product_item_sale_discount_price_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Discount price TTC')}</span>               
        </th>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_unit_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Unit')}</span>               
        </th>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_is_mandatory_list']])}
         <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Mandatory ?')}</span>               
        </th>
        {/if} 
          {if $user->hasCredential([['superadmin','settings_product_item_input3_list']])}
         <th> 
            <span>{__('Thermal resistance')}</span>   
        </th>
        {/if}
         {if $user->hasCredential([['superadmin','settings_product_item_thickness_list']])}
         <th> 
            <span>{__('Thickness')}</span>   
        </th>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_description_list']])}
         <th> 
            <span>{__('Description')}</span>  
        </th>
        {/if}
        {if $user->hasCredential([['superadmin','settings_product_item_details_list']])}
            <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Acermi')}</span>               
            </th>
        {/if} 
        {if $user->hasCredential([['superadmin','settings_product_item_is_active_list']])}
            <th data-hide="phone" style="display: table-cell;" >
            <span>{__('Active ?')}</span>               
            </th>
        {/if}
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('State')}</span>          
        </th>
        <th data-hide="phone" style="display: table-cell;">{__('Actions')}</th>
    </tr>
</thead>
    {* search/equal/range *}
     <tr class="input-list">
       <td>{* # *}</td>   
       <td>{* id *}
            <input type="text" class="ProductMaster-search" name="id" value="{$formFilter.search.id}"/>
       </td>
       <td>{* linked id *}</td>
       {if $user->hasCredential([['superadmin','settings_product_item_mark_list']])}
          <td></td>
      {/if} 
       <td>{* title *}</td>       
      {if $user->hasCredential([['superadmin','settings_product_item_tva_list']])}
          <td></td>
      {/if}     
      {if $user->hasCredential([['superadmin','settings_product_item_coefficient_list']])}
         <td>
         </td>
        {/if} 
       {if $user->hasCredential([['superadmin','settings_product_item_purchasing_price_list']])}
          <td></td>
      {/if}  
        {if $user->hasCredential([['superadmin','settings_product_item_sale_price_list']])}
          <td></td>
      {/if}  
        {if $user->hasCredential([['superadmin','settings_product_item_sale_price_list']])}
          <td></td>
      {/if}   
        {if $user->hasCredential([['superadmin','settings_product_item_sale_discount_price_list']])}
          <td></td>
      {/if} 
       {if $user->hasCredential([['superadmin','settings_product_item_unit_list']])}
         <td>
         </td>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_is_mandatory_list']])}
         <td>
         </td>
        {/if}   
         {if $user->hasCredential([['superadmin','settings_product_item_input3_list']])}
             <td>
                 
             </td>
        {/if}
        {if $user->hasCredential([['superadmin','settings_product_item_thickness_list']])}
         <td> 
            
        </td>
        {/if} 
        {if $user->hasCredential([['superadmin','settings_product_item_description_list']])}
         <td> 
            
        </td>
        {/if} 
          {if $user->hasCredential([['superadmin','settings_product_item_details_list']])}
         <td>               
        </td>
        {/if}
           {if $user->hasCredential([['superadmin','settings_product_item_is_active_list']])}
         <td>{* is_active *}
         {html_options class="ProductMaster-equal" name="is_active" options=$formFilter->equal.is_active->getOption('choices') selected=(string)$formFilter.equal.is_active}
        </td> 
        {/if} 
       <td>{* state *}</td>       
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="ProductMaster list" id="ProductMaster-{$item->get('id')}"> 
        <td class="ProductMaster-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>  
        <td >{$item->get('id')}</td>  
        <td>
            {$item->get('linked_id')}
            {foreach $item->getProductItemSlaves()->getSlaves() as $slave}
                {if !$slave@last}
                    {$slave.id},
                    {else}
                       {$slave.id} 
                {/if}
            {/foreach}
        </td>
            {if $user->hasCredential([['superadmin','settings_product_item_mark_list']])}
         <td>
              {$item->get('mark')} 
         </td>
        {/if} 
            <td> 
                {$item->get('reference')}
            </td>  
             {if $user->hasCredential([['superadmin','settings_product_item_coefficient_list']])}
                <td>
                     {$item->getFormatter()->getCoefficient()->getPourcentage()} 
                </td>
           {/if} 
              {if $user->hasCredential([['superadmin','settings_product_item_tva_list']])}
                 <td>{if $item->hasTax()}{$item->getTax()->getFormattedTax()}{else}{__('No tax')}{/if}</td>
            {/if}       
                {if $user->hasCredential([['superadmin','settings_product_purchasing_item_price_list']])}
                 <td>{$item->getFormatter()->getPurchasingPrice()->getAmount($settings->get('format_price','#.00'))}</td>
            {/if}
                {if $user->hasCredential([['superadmin','settings_product_sale_item_price_list']])}
                 <td>{$item->getFormatter()->getSalePriceWithoutTax()->getAmount($settings->get('format_price','#.00'))}</td>
            {/if}   
            {if $user->hasCredential([['superadmin','settings_product_sale_item_price_list']])}
                 <td>{$item->getFormatter()->getSalePriceWithTax()->getAmount($settings->get('format_price','#.00'))}</td>
            {/if}   
             {if $user->hasCredential([['superadmin','settings_product_sale_item_discount_price_list']])}
                 <td>{$item->getFormatter()->getDiscountPriceWithTax()->getAmount($settings->get('format_price','#.00'))}</td>
            {/if} 
             {if $user->hasCredential([['superadmin','settings_product_item_unit_list']])}
         <td>
            {$item->getUnitI18n()} 
         </td>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_is_mandatory_list']])}
         <td>
             {__($item->get('is_mandatory'))}
         </td>
        {/if}   
         {if $user->hasCredential([['superadmin','settings_product_item_input3_list']])}
             <td>
                   <span>{$item->get('input3')}</span>
             </td>
        {/if}
         {if $user->hasCredential([['superadmin','settings_product_item_thickness_list']])}
         <td> 
             <span>{format_number($item->get('thickness'),"#.0")}</span>
        </td>
        {/if} 
         {if $user->hasCredential([['superadmin','settings_product_item_description_list']])}
         <td> 
             <span title="{$item->get('description')}">{$item->get('description')|truncate:80}</span>
        </td>
        {/if} 
        {if $user->hasCredential([['superadmin','settings_product_item_details_list']])}
        <td> 
            {$item->get('details')}
        </td>
        {/if} 
        {if $user->hasCredential([['superadmin','settings_product_item_is_active_list']])}
        <td>                
             <a href="#" title="{__('change')}" class="ProductItemMaster-Change" id="{$item->get('id')}" name="{$item->get('is_active')}"><img  src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}'/></a>             
        </td>  
        {/if}
        <td>
            {$item->getStatusI18n()}
        </td>
        <td>               
            <a href="#" title="{__('Edit')}" class="ProductItemMaster-View" id="{$item->get('id')}">
                 <i class="fa fa-edit" style="margin-right:10px;"></i></a>    
            {if $user->hasCredential([['superadmin','settings_product_items_linked']])}
                 <a href="#" title="{__('Links')}" class="ProductItemMaster-Links" id="{$item->get('id')}">
                 <i class="fa fa-list" style="margin-right:10px;"></i></a>   
            {/if}
            {if $user->hasCredential([['superadmin','settings_product_items_linked_products']])}
                 <a href="#" title="{__('Links with product')}" class="ProductItemMasterProduct-Links" id="{$item->get('id')}">
                 <i class="fa fa-list" style="margin-right:10px;color: green;"></i></a>   
            {/if}
            <a href="#" title="{__('Delete')}" class="ProductItemMaster-Delete" id="{$item->get('id')}" name="{$item->get('reference')}">
                 <i class="fa fa-trash" style="margin-right:10px;"></i>
            </a>    
            <a href="#" title="{__('Copy')}" class="ProductItemsProduct-copy" id="{$item->get('id')}" name="{$item->get('reference')|upper}">
                <i class="fa fa-copy" style="font-size: 15px;"/>
            </a> 
        </td>
    </tr>    
    {/foreach}  
</table>  
</div>
 {if !$pager->getNbItems()}
     <span>{__('No item')}</span>
{else}
    {if $pager->getNbItems()>5}
        <input type="checkbox" id="ProductMaster-all" /> 
          <a style="opacity:0.5" class="ProductMaster-actions_items" href="#" title="{__('delete')}" id="ProductMaster-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ProductMaster"} 
</div>
<script type="text/javascript">
   
	 function changeItemState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.ProductItemMaster-Change[id="+this+"]";
                if (resp.state=='YES'||resp.state=='NO') 
                {    
                    $(sel+" img").attr({
                        src :"{url('/icons/','picture')}"+resp.state+".gif",
                        alt : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}'),
                        title : (resp.state=='YES'?'{__("user_YES")}':'{__("user_NO")}')
                    });
                    $(sel).attr("name",resp.state);
                }
            });  
        }
	
        function getSiteProductFilterMasterParameters()
        {
            var params={  Product: '{$product->get('id')}', 
                        filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         is_active : $(".ProductMaster-equal[name=is_active] option:selected").val()  
                                    },
                                lang: $("img.Product").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=ProductMaster-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".ProductMaster-order_active").attr("name"))
                 params.filter.order[$(".ProductMaster-order_active").attr("name")] =$(".ProductMaster-order_active").attr("id");   
            $(".ProductMaster-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteProductFilterMaster()
        {          
           return $.ajax2({ data: getSiteProductFilterMasterParameters(), 
                            url:"{url_to('products_items_ajax',['action'=>'ListMasterItems'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#MasterAction"
                             });
        }
    
        function updateSitePager(n)
        {
           var page_active=$(".ProductMaster-pager .ProductMaster-active").html()?parseInt($(".ProductMaster-pager .ProductMaster-active").html()):1;
           var records_by_page=$("[name=ProductMaster-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".ProductMaster-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#ProductMaster-nb_results").html())-n;
           $("#ProductMaster-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#ProductMaster-end_result").html($(".ProductMaster-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#ProductMaster-init").click(function() {                 
               $.ajax2({ data : { Product: '{$product->get('id')}' },  
                         url:"{url_to('products_items_ajax',['action'=>'ListMasterItems'])}" , 
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#MasterAction"}); 
           }); 
    
          $('.ProductMaster-order').click(function() {
                $(".ProductMaster-order_active").attr('class','ProductMaster-order');
                $(this).attr('class','ProductMaster-order_active');
                return updateSiteProductFilterMaster();
           });
           
            $(".ProductMaster-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteProductFilterMaster();
            });
            
          $("#ProductMaster-filter").click(function() { return updateSiteProductFilterMaster(); }); 
          
          $(".ProductMaster-equal[name=is_active],[name=ProductMaster-nbitemsbypage]").change(function() { return updateSiteProductFilterMaster(); }); 
          
         // $("[name=ProductMaster-name]").change(function() { return updateSiteProductFilterMaster(); }); 
           
           $(".ProductMaster-pager").click(function () {                     
                return $.ajax2({ data: getSiteProductFilterMasterParameters(), 
                                 url:"{url_to('products_items_ajax',['action'=>'ListMasterItems'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#MasterAction"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
         $(".ProductItemMaster-View").click( function () {                    
                return $.ajax2({ data : { ProductItem : $(this).attr('id') ,
                                },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'ViewItemMasterSlaveForProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                     
         
          $(".ProductItemMaster-Delete").click( function () { 
                if (!confirm('{__("Product item \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ ProductItem: $(this).attr('id') },
                                 url :"{url_to('products_items_ajax',['action'=>'DeleteItem'])}",
                                 errorTarget: ".site-errors",    
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteItem')
                                       {    
                                          $("tr#ProductMaster-"+resp.id).remove();
                                          $("tr#ProductSlave-"+resp.id).remove();
                                          if ($('.Product').length==0)
                                              return $.ajax2({ data : { Product: '{$product->get('id')}' }, 
                                                               url:"{url_to('products_items_ajax',['action'=>'ListMasterItems'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#MasterAction"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });                  
      
    
    $(".ProductItemMaster-Change").click(function() { 
                        return $.ajax2({ 
                            data : { id: this.id , value:this.name },
                            url : "{url_to('products_items_ajax',['action'=>'Change'])}",
                               errorTarget: ".site-errors",    
                              loading: "#tab-site-dashboard-x-settings-loading",     
                            success: function(resp) { 
                                        if (resp.action=='ChangeItem')
                                            changeItemState(resp);
                                     }
                    });
         });
         
    $(".ProductItemMaster-Links").click( function () {                    
                return $.ajax2({ data : { ProductItem : $(this).attr('id') ,
                                          Action: "ListPartialItemMasterSlave"
                                    },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'AddItemsForItemMasterSlave'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
    $(".ProductItemMasterProduct-Links").click( function () {                    
                return $.ajax2({ data : { ProductItem : $(this).attr('id'),
                        Action: "ListPartialItemMasterSlave"
                    },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'AddItemsForItemProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                              
                              
 </script>    
