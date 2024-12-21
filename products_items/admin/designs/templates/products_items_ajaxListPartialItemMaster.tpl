{messages class="site-errors"}
<h3>{__('Items for product [%s]',(string)$product->get('meta_title'))}</h3>    
<div>
    {if $user->hasCredential([['superadmin','settings_product_master_slave_posititons']])}
        <a href="#" class="btn" id="ProductItemsProduct-Positions" title="{__('Positions')}" ><i class="fa fa-list" style="margin-right:10px;"></i>{__('Positions')}</a> 
    {/if}
    <a href="#" class="btn" id="ProductItem-New" title="{__('New item')}" ><i class="fa fa-plus" style="margin-right:10px;"></i>{__('New item')}</a>     
      <a href="#" id="ProductItem-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $product->isLoaded()}
    <div id="MasterAction">
        {component name="/products_items/listMasterItems2" product=$product} 
    </div>

  
        <script type="text/javascript">        

                $("#ProductItem-New").click( function () {             
                    return $.ajax2({ 
                        data : { 
                            Product: '{$product->get('id')}' ,
                        }, 
                        url: "{url_to('products_items_ajax',['action'=>'NewItemMasterSlaveForProduct'])}",
                        errorTarget: ".site-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        target: "#actions"
                   });
                 });

                  $('#ProductItem-Cancel').click(function(){                           
                     return $.ajax2({ url : "{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                                      errorTarget: ".ProductItemSlave-errors",
                                      loading: "#tab-site-dashboard-x-settings-loading",                         
                                      target: "#actions" }); 
                });
        $("#ProductItemsProduct-Positions").click( function () {                    
                return $.ajax2({  data : { Product: '{$product->get('id')}' }, 
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'PositionItemsForItemProduct'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"});
         });
         
        $(".ProductItemsProduct-copy").click( function () { 
                  
                return $.ajax2({
                                data:{ ProductItem:$(this).attr('id') },
                                loading: "#tab-site-dashboard-x-settings-loading",
                                url:"{url_to('products_items_ajax',['action'=>'CopyProductItemWithItems'])}",
                                errorTarget: ".site-errors",
                                target: "#actions"
                    });
         });

        </script>
{else}
    {__('Product is invalid.')}
{/if}    
