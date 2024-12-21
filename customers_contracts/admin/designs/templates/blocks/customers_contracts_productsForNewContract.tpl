{section name=index loop=(string)$form.products.count}
<div id="product-{$smarty.section.index.index}" class="product-form">
        <table class="tab-form-2" id="Product-form">  
           <tr>
            <td>#{$smarty.section.index.index+1}                                
            </td>
            <tr>
            </tr>
                <td class="label">{__("Product")}
                </td>                    
                <td>                    
                    <div class="product-errors-form form-errors">&nbsp;{$form.products.collection[$smarty.section.index.index].product_id->getError()}</div> 
                    {html_options selected=$form.products.collection[$smarty.section.index.index].product_id name="product_id" class="ProductsForNewContract" id="id-`$smarty.section.index.index`" options=$form->products.collection[$smarty.section.index.index].product_id->getOption('choices')}
                </td>
            </tr>            
            <tr>
                <td class="label">{__("Details")}
                </td>
                <td>
                    <div class="product-errors-form form-errors">{$form.products.collection[$smarty.section.index.index].details->getError()}</div> 
                    <input type="text" id="{$smarty.section.index.index}" class="ProductsForNewContract" name="details" value="{$form['products']['collection'][$smarty.section.index.index]['details']|escape}" size="30"/>{if $form->products['collection'][$smarty.section.index.index]['details']->getOption('required')}*{/if}
                    {if $smarty.section.index.index!=0}<a href="#" title="{__('delete')}" class="product-Delete" id="{$smarty.section.index.index}">
                        <i class="fa fa-trash fa-2x" style="margin-left: 10px" ></i>
                        {*<img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>*}</a>{/if}
                </td>
            </tr>
        </table>   
    </td>        
</div>
{/section}
<div>
    <center style=" clear: both;">  <a id="product-Add" class="btn" href="#"  style="{if (string)$form.products.count>=$form->products['count']->getOption('max')}display:none{/if}">{*<img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>*}<i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add product')}</a></center>
</div>

<script type="text/javascript">

        $("#product-Add").click(function() { 
                    id=$(".product-form").length;
                    if (id >={$form->products.count->getOption('max')})
                    {
                        alert("{__('maximum records has been reached.')}");
                        $(this).hide();
                        return ;
                    }                
                    
               // alert("htm="+$(".Products[id=1]").html());
                    
                    $("#product-"+(id-1)).after(
                           '<div id="product-'+(id)+'" class="product-form">'+                                
                                 '<table class="tab-form-2" id="product-form">'+ 
                                   '<tr>'+
                                 '<td>'+'#'+(id+1)+'</td>'+
                                 '</tr>'+
                                     '<tr>'+
                                        '<td class="label">{__("Product")}</td>'+
                                        '<td>'+
                                            '<div class="product-errors-form error-form"></div>'+
                                            '<select class="ProductsForNewContract" id="id-'+(id)+'">'+
                                            $(".ProductsForNewContract[id=id-0]").html()+
                                            '</select>'+
                                        '</td>'+
                                     '</tr>'+
                                     '<tr>'+
                                         '<td class="label">{__("Details")}</td>'+
                                         '<td>'+
                                                '<div class="product-errors-form error-form"></div>'+
                                                '<input type="text" class="ProductsForNewContract"  id="'+(id)+'" name="details" value="" size="30"/>{if $form->products.collection[0]['details']->getOption('required')}*{/if}'+
                                               '<a href="#" title="{__('delete')}" class="product-Delete" id="">'+
                                                  '<i class="fa fa-trash fa-2x" style="margin-left: 10px" ></i>'+
                                               '</a>'+ 
                                            '</td>'+
                                        '</div>'+        
                                '</table></td>'+
                            '</tr>' 
                        );      
        });
      
        $(document).on('click',".product-Delete",function () { 
            $("#product-"+$(this).attr('id')).remove();
            $(".product-form").each(function(id) {
                  $("#"+$(this).attr('id')).attr('id',"product-"+id);
                  $("#product-"+id+" td:first").html("#"+(id+1));
                  $(".product-Delete").each(function (id) { $(this).attr("id",id+1); });
            });
            $("#product-Add").show();
        }); 
</script>  