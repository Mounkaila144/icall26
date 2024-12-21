{messages class="Product-errors"}
<h3>{__("Edit tax")|capitalize}</h3>
<div>
    <a href="#" id="Tax-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>
{if $item && $item->isLoaded()}
<table cellpadding="0" cellspacing="0">               
    <tr>
        <td><span>{__("description")}</span></td>
        <td>                 
            <div>{$form.description->getError()}</div>                 
            <input type="text" id="description" class="Taxes" name="description" value="{$item->get('description')|escape}"/> 
            {if $form->description->getOption('required')}*{/if} 
        </td>
    </tr>
    <tr>
        <td><span>{__("rate")}</span></td>
        <td>                 
            <div>{$form.rate->getError()}</div>       
            {if $form.rate->getError()}
                <input type="text" id="rate" class="Taxes" name="rate" value="{$item->get('rate')}"/>
                {else}
                <input type="text" id="rate" class="Taxes" name="rate" value="{format_pourcentage($item->get('rate'))}"/>
            {/if}  
            {if $form->rate->getOption('required')}*{/if} 
        </td>
    </tr>
</table> 
{else}
    <span>{__("Taxe is invalid.")}</span>
{/if}

<script type="text/javascript">        
    

         $(".Taxes").click(function() {  $('#Tax-Save').show(); });
         
         $(".Taxes").change(function() {  $('#Tax-Save').show(); });
         
         $('#Cancel').click(function(){      
             
              return $.ajax2({                       
                           errorTarget: ".Product-errors",
                           loading: "#tab-site-dashboard-site-x-settings-loading",
                           url: "{url_to('products_ajax',['action'=>'ListPartialTaxes'])}",
                           target: "#actions" }); 
             
         });
                                          
           $('#Tax-Save').click(function(){                             
            var  params= {            
                                Taxes: { 
                                   id: "{$item->get('id')}",
                                   token :'{$form->getCSRFToken()}'
                                } };      
           $(".Taxes").each(function() {  params.Taxes[$(this).attr('id')]=$(this).val(); });                                 
        //  alert("Params="+params.toSource());    return ;      
          return $.ajax2({ data : params,                            
                           errorTarget: ".Product-errors",
                           loading: "#tab-site-dashboard-site-x-settings-loading",
                           url: "{url_to('products_ajax',['action'=>'SaveTaxes'])}",
                           target: "#actions" }); 
        });        
       
</script>