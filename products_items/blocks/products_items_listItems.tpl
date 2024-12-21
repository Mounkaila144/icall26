<div>
<h4>{__('List Items')}</h4>  
{include file="./_pagers/default/_default_pager_top.tpl" pager=$pager formFilter=$formFilter class="ProductItems"}
<button id="ProductItems-filter" class="btn-table">{__("Filter")}</button> 
<button id="ProductItems-init" class="btn-table">{__("Init")}</button>
<div class="containerDivResp">
 <table cellpadding="0" cellspacing="0" class="tabl-list footable table">  
     <thead> 
    <tr  class="list-header">     
        <th data-hide="phone" style="display: table-cell;" >#</th>   
        <th data-hide="phone" style="display: table-cell;" >ID</th> 
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
            <input type="text" class="ProductItems-search" name="id" value="{$formFilter.search.id}"/>
       </td>
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
         {html_options class="ProductItems-equal" name="is_active" options=$formFilter->equal.is_active->getOption('choices') selected=(string)$formFilter.equal.is_active}
        </td> 
        {/if} 
       <td>{* state *}</td>       
       <td>{* actions *}</td>
    </tr>
    {foreach $pager as $item}
    <tr class="ProductItems list" id="ProductItems-{$item->get('id')}"> 
        <td class="ProductItems-count">{(($pager->getPage()-1)*$pager->getNbItemsByPage())+$item@iteration}</td>  
        <td >{$item->get('id')}</td>  
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
             <a href="#" title="{__('change')}" class="ProductItemItems-Change" id="{$item->get('id')}" name="{$item->get('is_active')}"><img  src="{url('/icons/','picture')}{$item->get('is_active')}.gif" alt='{__($item->get("is_active"))}'/></a>             
        </td>  
        {/if}
        <td>
            {$item->getStatusI18n()}
        </td>
        <td>               
            <a href="#" title="{__('Edit')}" class="ProductItemItems-View" id="{$item->get('id')}">
                 <i class="fa fa-edit" style="margin-right:10px;"></i></a>    
            {if $user->hasCredential([['superadmin','settings_product_items_linked']])}
                 <a href="#" title="{__('Links')}" class="ProductItemItems-Links" id="{$item->get('id')}">
                 <i class="fa fa-list" style="margin-right:10px;"></i></a>   
            {/if}
            {if $user->hasCredential([['superadmin','settings_product_items_linked_products']])}
                 <a href="#" title="{__('Links with product')}" class="ProductItemItemsProduct-Links" id="{$item->get('id')}">
                 <i class="fa fa-list" style="margin-right:10px;color: green;"></i></a>   
            {/if}
            <a href="#" title="{__('Delete')}" class="ProductItemItems-Delete" id="{$item->get('id')}" name="{$item->get('reference')}">
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
        <input type="checkbox" id="ProductItems-all" /> 
          <a style="opacity:0.5" class="ProductItems-actions_items" href="#" title="{__('delete')}" id="ProductItems-Delete">
              <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
          </a>         
    {/if}
{/if}    
{include file="./_pagers/default/_default_pager_bottom.tpl" pager=$pager class="ProductItems"} 
</div>
<script type="text/javascript">
   
	 function changeItemState(resp) 
        {
            $.each(resp.selection?resp.selection:[resp.id], function (id) { 
                sel="a.ProductItemItems-Change[id="+this+"]";
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
	
        function getSiteProductFilterItemsParameters()
        {
            var params={  Product: '{$product->get('id')}', 
                        filter: {  order : { }, 
                                    search : { },
                                    equal: { 
                                         is_active : $(".ProductItems-equal[name=is_active] option:selected").val()  
                                    },
                                lang: $("img.Product").attr('id'),                                                                                                               
                                nbitemsbypage: $("[name=ProductItems-nbitemsbypage]").val(),
                                token:'{$formFilter->getCSRFToken()}'
                         } };
            if ($(".ProductItems-order_active").attr("name"))
                 params.filter.order[$(".ProductItems-order_active").attr("name")] =$(".ProductItems-order_active").attr("id");   
            $(".ProductItems-search").each(function() { params.filter.search[$(this).attr('name')] =$(this).val(); });            
            return params;                  
        }
        
        function updateSiteProductFilterItems()
        {          
           return $.ajax2({ data: getSiteProductFilterItemsParameters(), 
                            url:"{url_to('products_items_ajax',['action'=>'ListItems'])}" , 
                            errorTarget: ".site-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",
                            target: "#ItemsAction"
                             });
        }
    
        function updateSitePager(n)
        {
           var page_active=$(".ProductItems-pager .ProductItems-active").html()?parseInt($(".ProductItems-pager .ProductItems-active").html()):1;
           var records_by_page=$("[name=ProductItems-nbitemsbypage]").val();
           start=(records_by_page!="*")?(page_active-1)*records_by_page+1:1;
           $(".ProductItems-count").each(function(id) { $(this).html(start+id) }); // Update index column           
           nb_results=parseInt($("#ProductItems-nb_results").html())-n;
           $("#ProductItems-nb_results").html((nb_results>1?nb_results+" {__('Results')}":"{__('One result')}"));
           $("#ProductItems-end_result").html($(".ProductItems-count:last").html());
        }
                   
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#ProductItems-init").click(function() {                 
               $.ajax2({ data : { Product: '{$product->get('id')}' },  
                         url:"{url_to('products_items_ajax',['action'=>'ListItems'])}" , 
                         errorTarget: ".site-errors",
                         loading: "#tab-site-dashboard-x-settings-loading",                         
                         target: "#ItemsAction"}); 
           }); 
    
          $('.ProductItems-order').click(function() {
                $(".ProductItems-order_active").attr('class','ProductItems-order');
                $(this).attr('class','ProductItems-order_active');
                return updateSiteProductFilterItems();
           });
           
            $(".ProductItems-search").keypress(function(event) {
                if (event.keyCode==13)
                    return updateSiteProductFilterItems();
            });
            
          $("#ProductItems-filter").click(function() { return updateSiteProductFilterItems(); }); 
          
          $(".ProductItems-equal[name=is_active],[name=ProductItems-nbitemsbypage]").change(function() { return updateSiteProductFilterItems(); }); 
          
         // $("[name=ProductItems-name]").change(function() { return updateSiteProductFilterItems(); }); 
           
           $(".ProductItems-pager").click(function () {                     
                return $.ajax2({ data: getSiteProductFilterItemsParameters(), 
                                 url:"{url_to('products_items_ajax',['action'=>'ListItems'])}?"+this.href.substring(this.href.indexOf("?")+1, this.href.length),
                                 errorTarget: ".site-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 target: "#ItemsAction"
                });
        });
          {* =====================  A C T I O N S =============================== *}  
      
         $(".ProductItemItems-View").click( function () {                    
                return $.ajax2({ data : { ProductItem : $(this).attr('id') ,
                                },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'ViewItemMasterSlaveForProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                     
         
          $(".ProductItemItems-Delete").click( function () { 
                if (!confirm('{__("Product item \"#0#\" will be deleted. Confirm ?")}'.format($(this).attr('name')))) return false; 
                return $.ajax2({ data :{ ProductItem: $(this).attr('id') },
                                 url :"{url_to('products_items_ajax',['action'=>'DeleteItem'])}",
                                 errorTarget: ".site-errors",    
                                 loading: "#tab-site-site-x-settings-loading",
                                 success : function(resp) {
                                       if (resp.action=='DeleteItem')
                                       {    
                                          $("tr#ProductItems-"+resp.id).remove();
                                          $("tr#ProductSlave-"+resp.id).remove();
                                          if ($('.Product').length==0)
                                              return $.ajax2({ data : { Product: '{$product->get('id')}' }, 
                                                               url:"{url_to('products_items_ajax',['action'=>'ListItems'])}",
                                                               errorTarget: ".site-errors",
                                                               target: "#ItemsAction"});
                                          updateSitePager(1);
                                        }       
                                 }
                     });                                        
            });                  
      
    
    $(".ProductItemItems-Change").click(function() { 
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
         
    $(".ProductItemItems-Links").click( function () {                    
                return $.ajax2({ data : { ProductItem : $(this).attr('id') ,
                                          Action: "ListPartialItemMasterSlave"
                                    },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'AddItemsForItemMasterSlave'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
    $(".ProductItemItemsProduct-Links").click( function () {                    
                return $.ajax2({ data : { ProductItem : $(this).attr('id'),
                        Action: "ListPartialItemMasterSlave"
                    },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'AddItemsForItemProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
                              
                              
 </script>    
