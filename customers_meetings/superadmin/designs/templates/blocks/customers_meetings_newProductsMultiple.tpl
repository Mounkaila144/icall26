<table cellpadding="0" cellspacing="0">
    {section name=index loop=(string)$form.products.count}
    <tr id="{$site->getSiteID()}-product-{$smarty.section.index.index}" class="{$site->getSiteID()}-product-form">
        <td>#{$smarty.section.index.index+1}                                
        </td>
        <td>
            <table id="{$site->getSiteID()}-Product-form">                
                <tr>
                    <td>{__("Product")}
                    </td>
                    
                    <td>                    
                        <div class="{$site->getSiteID()}-product-errors-form">&nbsp;{$form.products.collection[$smarty.section.index.index].product_id->getError()}</div> 
                        {html_options name="product_id" class="Products" id="id-`$smarty.section.index.index`" options=$form->products.collection[$smarty.section.index.index].product_id->getOption('choices')}
                    </td>
                </tr>            
                <tr>
                    <td>{__("Details")}
                    </td>
                    <td>
                        <div class="{$site->getSiteID()}-product-errors-form">{$form.products.collection[$smarty.section.index.index].details->getError()}</div> 
                        <input type="text" id="{$smarty.section.index.index}" class="Products" name="details" value="{$form['products']['collection'][$smarty.section.index.index]['details']|escape}" size="30"/>{if $form->products['collection'][$smarty.section.index.index]['details']->getOption('required')}*{/if}
                        {if $smarty.section.index.index!=0}<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-product-Delete" id="{$smarty.section.index.index}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>{/if}
                    </td>
                </tr>
            </table>   
        </td>        
    </tr>
    {/section}
</table> 
<div>
   <a id="{$site->getSiteID()}-product-Add" href="#"  style="{if (string)$form.products.count>=$form->products['count']->getOption('max')}display:none{/if}"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('Add product')}</a>
</div>

<script type="text/javascript">

        $("#{$site->getSiteID()}-product-Add").click(function() { 
                    id=$(".{$site->getSiteID()}-product-form").length;
                    if (id >={$form->products.count->getOption('max')})
                    {
                        alert("{__('maximum records has been reached.')}");
                        $(this).hide();
                        return ;
                    }                
                    
               // alert("htm="+$(".Products[id=1]").html());
                    
                    $("#{$site->getSiteID()}-product-"+(id-1)).after(
                           '<tr id="{$site->getSiteID()}-product-'+(id)+'" class="{$site->getSiteID()}-product-form">'+
                                '<td>'+'#'+(id+1)+'</td>'+
                                 '<td><table id="{$site->getSiteID()}-Product-form">'+              
                                     '<tr>'+
                                        '<td>{__("Product")}</td>'+
                                        '<td>'+
                                            '<div class="{$site->getSiteID()}-product-errors-form"></div>'+
                                            '<select>'+
                                            $(".Products[id=1]").html()+
                                            '</select>'+
                                        '</td>'+
                                     '</tr>'+
                                     '<tr>'+
                                         '<td>{__("Details")}</td>'+
                                         '<td>'+
                                                '<div class="{$site->getSiteID()}-product-errors-form"></div>'+
                                                '<input type="text" class="Products" name="details" value="" size="30"/>{if $form->products.collection[0]['details']->getOption('required')}*{/if}'+
                                               '<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-product-Delete" id="">'+
                                                   '<img  src="{url('/icons/delete.gif','picture')}" alt="{__("delete")}"/>'+
                                               '</a>'+ 
                                            '</td>'+
                                        '</tr>'+        
                                '</table></td>'+
                            '</tr>' 
                        );         
        });
      
        $(document).on('click',".{$site->getSiteID()}-product-Delete",function () { 
            $("#{$site->getSiteID()}-product-"+$(this).attr('id')).remove();
            $(".{$site->getSiteID()}-product-form").each(function(id) {
                  $("#"+$(this).attr('id')).attr('id',"{$site->getSiteID()}-product-"+id);
                  $("#{$site->getSiteID()}-product-"+id+" td:first").html("#"+(id+1));
                  $(".{$site->getSiteID()}-product-Delete").each(function (id) { $(this).attr("id",id+1); });
            });
            $("#{$site->getSiteID()}-product-Add").show();
        }); 
</script>        