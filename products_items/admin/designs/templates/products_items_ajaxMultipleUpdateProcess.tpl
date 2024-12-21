{messages class="products_items-multiple-errors"}
<h3>{__("Multiple update")}</h3>
<div>    
    <a href="#" id="ProductItem-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $form}
<div>    
    {format_number_choice('[0] no selected element|[1]one selected element|(1,Inf]%s selected elements',$form->getSelectionCount(),$form->getSelectionCount())} 
</div>
<fieldset>    
<table>
    <tr>
        <td>{__('Actions')}</td>
        <td>{__('Parameters')}</td>
    </tr> 
     {if $form->hasActionInValidator('update_price_item_from_product')}
     <tr>
       <td>
            <input type="checkbox" class="ProductItemMultipleActions" name="update_price_item_from_product" value="" {if $form->hasAction('update_price_item_from_product')}checked=""{/if}/>
        </td>
        <td>{__('Update price item from product')}</td>
        <td>            
        </td>       
    </tr>
    {/if}
     {if $form->hasActionInValidator('update_discount_price_item_from_product')}
     <tr>
       <td>
            <input type="checkbox" class="ProductItemMultipleActions" name="update_discount_price_item_from_product" value="" {if $form->hasAction('update_discount_price_item_from_product')}checked=""{/if}/>
        </td>
        <td>{__('Update discount price item from product')}</td>
        <td>            
        </td>       
    </tr>
    {/if}
</table>
<a href="#" id="MutipleProductItemProcess" class="btn">{__('Process')}</a>  
</fieldset>
<script type="text/javascript">
        
       
        $("#MutipleProductItemProcess").click(function() { 
           var params={ 
                   MultipleSelection : {
                    actions: [],                                      
                    selection : {$form->getSelection()->toJson()},
                    count : '{$form->getSelection()->count()}',
                    token :'{$form->getCSRFToken()}'
                        }
           };                              
           $(".ProductItemMultipleActions:checked").each(function() { params.MultipleSelection.actions.push($(this).attr('name')); });            
      //  alert("Params="+params.toSource());
           return $.ajax2({                   
                    data : params,
                    url: "{url_to('products_items_ajax',['action'=>'MultipleProcessSelection'])}",
                    errorTarget: ".products_items-multiple-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"
               });
        });
        
        
</script>   

{/if}



<script type="text/javascript">
        
     $('#ProductItem-Cancel').click(function(){                           
             return $.ajax2({ url : "{url_to('products_items_ajax',['action'=>'ListPartialItem'])}",
                              errorTarget: ".products_items-multiple-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
          
</script>
