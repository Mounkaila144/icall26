{messages class="PartnerLayer-errors"}
<h3>{__("New partner layer")}</h3>
<div>
    <a href="#" id="PartnerLayer-Save" class="btn" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('Save')}"/>{__('Save')}</a>
    <a href="#" id="PartnerLayer-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a>
</div>
<fieldset>
  
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("name")}</span></td>
            <td class="label">
                 <div>{$form.name->getError()}</div>               
                 <input type="text" class="PartnerLayer" name="name" size="34" value="{$item->get('name')}"/> 
                 {if $form->name->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td class="label">{__("web")}</td>
             <td class="label"> 
                 <div>{$form.web->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="web" size="34" value="{$item->get('web')|escape}" size="34"/>
                 {if $form->web->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td class="label">{__("email")}</td>
             <td class="label"> 
                 <div>{$form.email->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="email" size="34" value="{$item->get('email')|escape}" size="34"/>
                  {if $form->email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("address1")}</td>
             <td class="label"> 
                 <div>{$form.address1->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="address1" size="34"  value="{$item->get('address1')|escape}" size="34" />
                 {if $form->address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td class="label">{__("address2")}</td>
             <td class="label"> 
                 <div>{$form.address2->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="address2" size="34" value="{$item->get('address2')|escape}" size="34" />
                 {if $form->address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
          <tr>
             <td class="label">{__("city")}</td>
             <td class="label"> 
                 <div>{$form.city->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="city" size="34" value="{$item->get('city')|escape}" size="34"/>
                 {if $form->city->getOption('required')}*{/if} 
                 <div id="PartnerLayer-cities_container"></div>
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("country")}</td>
             <td class="label"> 
                 <div>{$form.country->getError()}</div>                 
                 {select_country class="PartnerLayer" name="country"  selected=$item->get('country')}
             </td> 
         </tr>  
          <tr>
             <td class="label">{__("phone")}</td>
             <td class="label"> 
                 <div>{$form.phone->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="phone" value="{$item->get('phone')|escape}" size="34"/>
                 {if $form->phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("mobile")}</td>
             <td class="label"> 
                 <div>{$form.mobile->getError()}</div> 
                 <input type="text" class="PartnerLayer" name="mobile" value="{$item->get('mobile')|escape}" size="34"/>
                 {if $form->mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
        <tr>
            <td class="label">{__("fax")}</td>
            <td class="label"> 
                <div>{$form.fax->getError()}</div> 
                <input type="text" class="PartnerLayer" name="fax" value="{$item->get('fax')|escape}" size="34" />
                {if $form->fax->getOption('required')}*{/if} 
            </td>             
        </tr> 
         <tr>
            <td class="label">{__("GPS coordinates")}</td>
            <td class="label"> 
                <div>{$form.coordinates->getError()}</div> 
                <input type="text" class="PartnerLayer" name="coordinates" value="{$item->get('coordinates')|escape}" size="34"/>
                {if $form->coordinates->getOption('required')}*{/if} 
            </td>             
        </tr> 
         <tr>
            <td class="label">{__("Siret")}</td>
            <td class="label"> 
                <div>{$form.siret->getError()}</div> 
                <input type="text" class="PartnerLayer" name="coordinates" value="{$item->get('siret')|escape}" size="40"/>
                {if $form->siret->getOption('required')}*{/if} 
            </td>             
        </tr>   
   </table>   
</fieldset>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".PartnerLayer,.PartnerLayerContact").click(function() {  $('#PartnerLayer-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#PartnerLayer-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}",
                              errorTarget: ".PartnerLayer-errors",
                              loading: "#tab-site-dashboard-site-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#PartnerLayer-Save').click(function(){                             
            var  params= {            
                                PartnerLayer: {  
                                   country : $(".PartnerLayer[name=country] option:selected").val(),                                  
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $("input.PartnerLayer[type=text]").each(function() {  params.PartnerLayer[this.name]=$(this).val();  });  // Get foreign key                
          return $.ajax2({ data : params,                            
                           errorTarget: ".PartnerLayer-errors",
                           url: "{url_to('partners_layer_ajax',['action'=>'NewLayerCompany'])}",
                           target: "#actions" }); 
        });  
     
</script>
