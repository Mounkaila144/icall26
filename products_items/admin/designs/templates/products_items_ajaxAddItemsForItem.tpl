{messages class="ProductItem-errors"}
<h3>{__("View items for item [%s]",[$item->get('reference'),$item->getProduct()->get('meta_title')])}</h3>
<div>
    <a href="#" id="ProductItem-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="ProductItem-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
    
    {foreach $form->items->getChoices() as $product_item}
        <div>
            <input type="checkbox" class="ProductItem Checkbox" id="{$product_item->get('id')}" {if $form->getItems()->in($product_item->get('id'))}checked=""{/if}/>{$product_item->get('reference')} ({$product_item->getProduct()->get('meta_title')})
        </div>
    {/foreach}    
<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".ProductItem").click(function() {  $('#ProductItem-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
    $('#ProductItem-Cancel').click(function(){                           
             return $.ajax2({ data : {  Product: '{$item->getProduct()->get('id')}' },
                              url : "{url_to('products_items_ajax',['action'=>'ListPartialItemForProduct'])}",
                              errorTarget: ".ProductItem-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#ProductItem-Save').click(function(){                             
            var  params= {      ProductItem : '{$item->get('id')}',  
                                AddProductItems: {    
                                   items : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };                            
          $(".ProductItem.Checkbox:checked").each(function() {  params.AddProductItems.items.push($(this).attr('id'));  });                    
          return $.ajax2({ data : params,                            
                           errorTarget: ".ProductItem-errors",
                           url : "{url_to('products_items_ajax',['action'=>'AddItemsForItem'])}",
                           target: "#actions" }); 
        });  
     
</script>
    
{else}
{__('Item is invalid')}
{/if}  




