{messages class="Product-errors"}
<h3>{__("Edit tax")|capitalize}</h3>
<div>
    <a href="#" id="Tax-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div>
{if $item->isLoaded()}
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
                <input type="text" id="rate" class="taxes" name="rate" value="{$item->get('rate')}"/>
                {else}
                <input type="text" id="rate" class="taxes" name="rate" value="{format_pourcentage($item->get('rate'))}"/>
            {/if}  
            {if $form->rate->getOption('required')}*{/if} 
        </td>
    </tr>
</table> 
{else}
    <span>{__("Taxe is invalid.")}</span>
{/if}

<script type="text/javascript">        
    

         $(".Taxes").click(function() {  $('#Save').show(); });
         
         $(".Taxes").change(function() {  $('#Save').show(); });
         
         $('#Cancel').click(function(){      
             
             
             
         });
         
                  
         $('#Save').click(function(){ 
                  
          
         });
         
       
</script>