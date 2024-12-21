{messages class="ProductItem-errors"}
<h3>{__("Item positions for product [%s]",$product->get('meta_title'))}</h3>
<div>
    <a href="#" id="Product-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="Product-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $product->isLoaded()}
    <table id="ProductItem" cellpadding="0" cellspacing="0" >
         <thead>
                <tr>                  
                    <th>{__('Position')}</th>
                    <th>{__('Item')}</th>
                </tr>
            </thead>
            <tbody>
    {foreach $product->getProductItems('position') as $product_item}
       <tr id="{$product_item->get('id')}" class="ui-function-default ProductItems">
            <td class="position">{$product_item@iteration}</td>
            <td>
               {$product_item->get('reference')}  
            </td>
        </tr>       
    {/foreach} 
                            </tbody>
    </table>
<script type="text/javascript">
    
    $("#ProductItem tbody").sortable({
        cursor: 'move',     
        stop: function (event, ui) {
            $(".position").each(function (id) { $(this).html(id + 1); }); 
            $("#Product-Save").show();
        }
    });
    
    
    $('#Product-Cancel').click(function(){                           
             return $.ajax2({ data : {  Product: '{$product->get('id')}' },
                              url : "{url_to('products_items_ajax',['action'=>'ListPartialItemForProduct'])}",
                              errorTarget: ".ProductItem-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
   

  $('#Product-Save').click(function(){                             
            var  params= {      Product : '{$product->get('id')}',  
                                ProductItemPosition: {    
                                   positions : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };                            
          $(".ProductItems").each(function() {  params.ProductItemPosition.positions.push($(this).attr('id'));  });                    
          return $.ajax2({ data : params,                            
                           errorTarget: ".ProductItem-errors",
                           url : "{url_to('products_items_ajax',['action'=>'PositionItemsForProduct'])}",
                           target: "#actions" }); 
    }); 
     
</script>
    
{else}
{__('Product is invalid')}
{/if}  

