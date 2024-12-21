{messages class="{$site->getSiteID()}-Product-errors"}
<h3>{__("Product")|capitalize}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Product-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-Product-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

{if $item->isLoaded()}
     <table>
        <tr>
            <td><span>{__("Reference")}</span></td>
            <td>
                 <div>{$form.reference->getError()}</div>               
                 <input type="text" class="{$site->getSiteID()}-Product" name="reference" size="48" value="{$item->get('reference')}"/> 
                 {if $form->reference->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td>{__("Title")}</td>
             <td> 
                 <div>{$form.meta_title->getError()}</div> 
                 <textarea class="{$site->getSiteID()}-Product" name="meta_title" cols="48" rows="3">{$item->get('meta_title')|escape}</textarea>
                 {if $form->meta_title->getOption('required')}*{/if} 
             </td>
         </tr>
        <tr>
             <td>{__("Short description")}</td>
             <td> 
                 <div>{$form.meta_description->getError()}</div> 
                 <textarea class="{$site->getSiteID()}-Product" name="meta_description" cols="48" rows="3">{$item->get('meta_description')|escape}</textarea>
                 {if $form->meta_description->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td>{__("Description")}</td>
             <td> 
                 <div>{$form.content->getError()}</div> 
                 <textarea class="{$site->getSiteID()}-Product" name="content" cols="48" rows="3">{$item->get('content')|escape}</textarea>
                 {if $form->content->getOption('required')}*{/if} 
             </td>
         </tr>
</table>   
{else}
    <span>{__('Product is invalid.')}</span>
{/if}    
<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-Product").click(function() {  $('#{$site->getSiteID()}-Product-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-Product-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('products_ajax',['action'=>'ListPartialProduct'])}",
                              errorTarget: ".{$site->getSiteID()}-Product-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#{$site->getSiteID()}-Product-Save').click(function(){                             
            var  params= {            
                                Product: {   
                                   id: "{$item->get('id')}",
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $("input.{$site->getSiteID()}-Product[type=text]").each(function() {  params.Product[this.name]=$(this).val();  }); 
          $("textarea.{$site->getSiteID()}-Product").each(function() {  params.Product[this.name]=$(this).val();  }); // Get foreign key                            
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-Product-errors",
                           url: "{url_to('products_ajax',['action'=>'SaveProduct'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>