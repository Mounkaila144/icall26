{messages class="ProductItem-errors"}
<h3>{__("Item positions for master [%s]",[$item->get('reference'),$item->getProduct()->get('meta_title')])}</h3>
<div>
    <a href="#" id="ProductItem-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="ProductItem-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
    <table id="ProductItemItems" cellpadding="0" cellspacing="0" >
         <thead>
                <tr>                  
                    <th>{__('Position')}</th>
                    <th>{__('Item')}</th>
                </tr>
            </thead>
            <tbody>
    {foreach $item->getItems() as $product_item_item}
       <tr id="{$product_item_item->get('id')}" class="ui-function-default ProductItemItems">
            <td class="position">{$product_item_item@iteration}</td>
            <td>
               {$product_item_item->getSlave()->get('reference')}  
            </td>
        </tr>       
    {/foreach} 
                            </tbody>
    </table>
<script type="text/javascript">
    
    $("#ProductItemItems tbody").sortable({
        cursor: 'move',     
        stop: function (event, ui) {
            $(".position").each(function (id) { $(this).html(id + 1); }); 
            $("#ProductItem-Save").show();
        }
    });
    
    
    $('#ProductItem-Cancel').click(function(){                           
             return $.ajax2({ data : {  Product: '{$item->getProduct()->get('id')}' },
                              url : "{url_to('products_items_ajax',['action'=>'ListPartialItemForProduct'])}",
                              errorTarget: ".ProductItem-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
   

    $('#ProductItem-Save').click(function(){                             
            var  params= {      ProductItem : '{$item->get('id')}',  
                                ProductItemItemPosition: {    
                                   positions : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };                            
          $(".ProductItemItems").each(function() {  params.ProductItemItemPosition.positions.push($(this).attr('id'));  });                    
          return $.ajax2({ data : params,                            
                           errorTarget: ".ProductItem-errors",
                           url : "{url_to('products_items_ajax',['action'=>'PositionItemsForItem'])}",
                           target: "#actions" }); 
    });   
     
</script>
    
{else}
{__('Item is invalid')}
{/if}  

