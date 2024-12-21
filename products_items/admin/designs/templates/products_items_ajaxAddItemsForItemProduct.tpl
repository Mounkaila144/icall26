{messages class="ProductItem-errors"}
<h3>{__("View items for item [%s]",[$item->get('reference'),$item->getProduct()->get('meta_title')])}</h3>
<div>
    <a href="#" id="ProductItem-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="ProductItem-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>        
{if $item->isLoaded()}
    <div class="containerDivResp">
        <table id="ProductItemTable" cellpadding="0" cellspacing="0"  class="ProductItemRow tabl-list footable table gray-list">
            <tr class="list-header">
                <th>{__("Title product")}</th>
                <th>{__("Reference for display")}</th>
                <th>{__("Reference for document")}</th>
                <th>{__("Mark")}</th>
                <th>{__("Link")}</th>
            </tr>
            <tr class="Input">
                <td>
                    {html_options onChange="searchProduct();" id="ProductSearch" class="ProductEqual Select" name="unit" options=$form->getDefault('product_id')}
                </td>
                <td>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            {foreach $form->getProducts() as $product}                                   
                <tr class="ProductCols list">
                    <td class="blue-border-bottom"  rowspan="{count($product->getItemsExcepted())+1}">{$product->get('meta_title')}</td>
                </tr>
                {foreach $product->getItemsExcepted() as $product_item}   
                    <tr class="ProductItemCols list">
                            <td class="blue-border-bottom">
                                {$product_item->get('reference')}
                            </td>
                            <td class="blue-border-bottom">
                                {$product_item->get('input1')}
                            </td>
                            <td class="blue-border-bottom">
                                {$product_item->get('mark')}
                            </td>
                            <td class="blue-border-bottom">
                                <input type="checkbox" class="ProductItem Checkbox" id="{$product_item->get('id')}" {if $form->getItems()->in($product_item->get('id'))}checked=""{/if}/>
                            </td>                    
                        </tr>

                {/foreach} 
            {/foreach} 
    </table>
    

    </div>
<script type="text/javascript">
        
     {* =================== F I E L D S ================================ *}
     $(".ProductItem").click(function() {  $('#ProductItem-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
    $('#ProductItem-Cancel').click(function(){                           
             return $.ajax2({ data : {  Product: '{$item->getProduct()->get('id')}' },
                              url : "{url_to('products_items_ajax',['action'=>$callback])}",
                              errorTarget: ".ProductItem-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#ProductItem-Save').click(function(){                             
            var  params= {      ProductItem : '{$item->get('id')}',  
                                AddProductItems: {    
                                   items : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } ,
                                Action: "{$callback}"                                
                            };                            
          $(".ProductItem.Checkbox:checked").each(function() {  params.AddProductItems.items.push($(this).attr('id'));  });                    
          return $.ajax2({ data : params,                            
                           errorTarget: ".ProductItem-errors",
                           url : "{url_to('products_items_ajax',['action'=>'AddItemsForItemProduct'])}",
                           target: "#actions" }); 
        });  
                           
        function searchProduct() {
            var input, filter, table, tr, td, i;
            var select = document.getElementById("ProductSearch");
            var value = select.options[select.selectedIndex].textContent;
            filter = value.toUpperCase();
            table = document.getElementById("ProductItemTable");
            tr = table.getElementsByClassName("list");
            var show = true;
            var spannedRows = 0;
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if(spannedRows > 0) {
                    if(show)
                        tr[i].style.display = "";
                    else
                        tr[i].style.display = "none";
                    spannedRows--;
                } else if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    let rs = td.getAttribute("rowspan");
                    if(rs && rs > 1) {
                        show = td.innerHTML.toUpperCase().indexOf(filter) > -1;
                        spannedRows = rs - 1;
                    }
                }
            }
        }
            
            
        

     
</script>
    
{else}
{__('Item is invalid')}
{/if}  




