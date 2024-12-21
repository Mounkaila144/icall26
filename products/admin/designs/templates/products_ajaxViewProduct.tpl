{messages class="Product-errors"}
<h3>{__("Product")|capitalize}</h3>
<div>
    <a href="#" id="Product-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Product-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

{if $item->isLoaded()}

     <table>
        <tr>
            <td><span>{__("Reference")}</span></td>
            <td>
                 <div>{$form.reference->getError()}</div>               
                 <input type="text" class="Product" name="reference" size="48" value="{$item->get('reference')}"/> 
                 {if $form->reference->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td>{__("Title")}</td>
             <td> 
                 <div>{$form.meta_title->getError()}</div> 
                 <textarea class="Product" name="meta_title" cols="48" rows="3">{$item->get('meta_title')|escape}</textarea>
                 {if $form->meta_title->getOption('required')}*{/if} 
             </td>
         </tr>
        <tr>
             <td>{__("Short description")}</td>
             <td> 
                 <div>{$form.meta_description->getError()}</div> 
                 <textarea class="Product" name="meta_description" cols="48" rows="3">{$item->get('meta_description')|escape}</textarea>
                 {if $form->meta_description->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td>{__("Description")}</td>
             <td> 
                 <div>{$form.content->getError()}</div> 
                 <textarea class="Product" name="content" cols="48" rows="3">{$item->get('content')|escape}</textarea>
                 {if $form->content->getOption('required')}*{/if} 
             </td>
         </tr>
</table>   
{else}
    <span>{__('Product is invalid.')}</span>
{/if}    
<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".Product").click(function() {  $('#Product-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#Product-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                              errorTarget: ".Product-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#Product-Save').click(function(){                             
            var  params= {            
                                Product: {   
                                   id: "{$item->get('id')}",
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $("input.Product[type=text]").each(function() {  params.Product[this.name]=$(this).val();  }); 
          $("textarea.Product").each(function() {  params.Product[this.name]=$(this).val();  }); // Get foreign key                            
          return $.ajax2({ data : params,                            
                           errorTarget: ".Product-errors",
                           url: "{url_to('products_ajax',['action'=>'SaveProduct'])}",
                           target: "#actions" }); 
        });  
     
</script>