{* TEMPLATE FOR HTML New Save Action ajaxNew.tpl.tpl *}
{messages class="errors"}
<h3>{__("new taxes")|capitalize}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Tax-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-Tax-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>      
</div>
 
<table cellpadding="0" cellspacing="0">       
    {section name=count loop=(string)$form.count}
    <tr id="collection-{$smarty.section.count.index}" class="Collection">
            <td>#<span class="Count">{$smarty.section.count.index+1}</span></td>
            <td class="item">   
                 <table cellpadding="0" cellspacing="0">
                    <tr>
                         <td><span>{__("rate")}</span><span>:</span></td>
                         <td>
                              <div>{$form['collection'][$smarty.section.count.index].rate->getError()}</div> 
                              <input type="text" id="{$smarty.section.count.index}" class="Taxes" name="rate"  size="30"
                                  value="{if $form->hasErrors()}{$form['collection'][$smarty.section.count.index]['rate']}{else}{format_pourcentage((string)$form['collection'][$smarty.section.count.index]['rate'])}{/if}"   
                              /> 
                              <span>{if $form->collection[$smarty.section.count.index]['rate']->getOption('required')}*{/if}</span>                      
                        </td>           
                     </tr>   
                     <tr>
                         <td><span>{__("description")}</span><span>:</span></td>
                         <td>
                            <div>{$form['collection'][$smarty.section.count.index].description->getError()}</div> 
                            <input type="text" id="{$smarty.section.count.index}" class="Taxes" name="description" size="30"
                              value="{$form['collection'][$smarty.section.count.index]['description']}"/>                      
                            <span>{if $form->collection[$smarty.section.count.index]['description']->getOption('required')}*{/if}</span>                       
                         </td>           
                     </tr>                      
                 </table>
            </td>
            <td>
               {if $smarty.section.count.index!=0}<a href="#" title="{__('delete')}" class="Delete" id="{$smarty.section.count.index}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>{/if}
            </td>     
    </tr>
    {/section}
</table>
<div>
   <a id="Add" href="#"  style="{if (string)$form.count>=$form->count->getOption('max')}display:none{/if}"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('add rate')|capitalize}</a>
</div>
<script type="text/javascript">
    
      $('#{$site->getSiteID()}-Tax-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('products_ajax',['action'=>'ListPartialTaxes'])}",
                              errorTarget: ".{$site->getSiteID()}-Product-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
    
     $(document).on('click','.Taxes',function() { $("#{$site->getSiteID()}-Tax-Save").show(); });
     
     $("#Add").click(function() { 
         count=$(".Collection").length;
       //  alert("count_max={$form->count->getOption('max')}");
         if (count>={$form->count->getOption('max')})
         {
                alert("{__('maximum records has been reached.')}");
                $(this).hide();
                return ;
         }    
         // Add Item
         $("#collection-"+(count-1)).after('<tr id="collection-'+(count)+'" class="Collection"></tr>');
         // Copy HTML
         $("#collection-"+(count)).html($("#collection-0").html());
         // Update Number - Error
         $(".Count").last().html(count+1); // Update n° record
         $(".error").last().html('&nbsp;'); 
         $(".item").last().after('<td><a href="#" title="{__('delete')}" class="Delete" id="'+count+'"><img  src="{url('/icons/delete.gif','picture')}" alt="{__("delete")}"/></a></td>');
         // Update Data Id
         $(".item:last").find(".Taxes").each(function (id){
           $(this).attr('id',count);
         });
      
     });
     
     $(document).on('click','.Delete',function () { 
            $("#collection-"+$(this).attr('id')).remove();
            // Renumbering
            $(".count").each(function(id) { $(this).html(id+1); }); // Count
            $(".Collection").each(function(id) { $(this).attr('id',"collection-"+id); });  // Id of collection row
            $(".Delete").each(function(id) { $(this).attr('id',id+1); });  // Id of collection row
            $("#Add").show();
     });
                          
       $('#{$site->getSiteID()}-Tax-Save').click(function(){                             
            var  params= {            
                                Taxes: {    
                                   count : $(".Collection").length,
                                   collection : { },
                                   token :'{$form->getCSRFToken()}'
                                } };      
           $(".Taxes").each(function() {
                     data={ };
                     data[$(this).attr('name')]=$(this).val(); 
                     params.Taxes.collection[$(this).attr('id')]=$.extend(params.Taxes.collection[$(this).attr('id')],data );
                });                                 
        //  alert("Params="+params.toSource());    return ;      
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-Product-errors",
                           url: "{url_to('products_ajax',['action'=>'NewTaxes'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
</script>
