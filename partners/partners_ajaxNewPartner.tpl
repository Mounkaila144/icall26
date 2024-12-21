{messages class="Partner-errors"}
<h3>{__("New partner")|capitalize}</h3>
<div>
    <a href="#" id="Partner-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
         {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="Partner-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>

<fieldset>
    
    <legend> <h4>{__('Company')}</h4></legend>
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("name")}</span></td>
            <td>
                <div class="error-form">{$form.company.name->getError()}</div>               
                 <input type="text" class="Partner" name="name" size="64" value="{$item->getPartner()->get('name')}"/> 
                 {if $form->company.name->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td class="label">{__("web")}</td>
             <td> 
                 <div class="error-form">{$form.company.web->getError()}</div> 
                 <input type="text" class="Partner" name="web" size="64" value="{$item->getPartner()->get('web')|escape}" size="30"/>
                 {if $form->company.web->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td class="label">{__("email")}</td>
             <td> 
                 <div class="error-form">{$form.company.email->getError()}</div> 
                 <input type="text" class="Partner" name="email" size="64" value="{$item->getPartner()->get('email')|escape}" size="30"/>
                  {if $form->company.email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("address1")}</td>
             <td> 
                 <div class="error-form">{$form.company.address1->getError()}</div> 
                 <input type="text" class="Partner" name="address1" size="64"  value="{$item->getPartner()->get('address1')|escape}" size="30" />
                 {if $form->company.address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td class="label">{__("address2")}</td>
             <td> 
                 <div class="error-form">{$form.company.address2->getError()}</div> 
                 <input type="text" class="Partner" name="address2" size="64" value="{$item->getPartner()->get('address2')|escape}" size="30" />
                 {if $form->company.address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
          <tr>
             <td class="label">{__("city")}</td>
             <td> 
                 <div class="error-form">{$form.company.city->getError()}</div> 
                 <input type="text" class="Partner" name="city" size="32" value="{$item->getPartner()->get('city')|escape}" size="30"/>
                 {if $form->company.city->getOption('required')}*{/if} 
                 <div id="Partner-cities_container"></div>
             </td>             
         </tr>  
        {* <tr>
             <td class="label">{__("country")}</td>
             <td> 
                 <div class="error-form">{$form.company.country->getError()}</div>                 
                 {select_country class="Partner" name="country" selected=$item->getPartner()->get('country')}
             </td> 
         </tr>  *}
          <tr>
             <td class="label">{__("phone")}</td>
             <td> 
                 <div class="error-form">{$form.company.phone->getError()}</div> 
                 <input type="text" class="Partner" name="phone" value="{$item->getPartner()->get('phone')|escape}" size="30"/>
                 {if $form->company.phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("mobile")}</td>
             <td> 
                 <div class="error-form">{$form.company.mobile->getError()}</div> 
                 <input type="text" class="Partner" name="mobile" value="{$item->getPartner()->get('mobile')|escape}" size="30"/>
                 {if $form->company.mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
         <tr>
             <td class="label">{__("fax")}</td>
             <td> 
                 <div class="error-form">{$form.company.fax->getError()}</div> 
                 <input type="text" class="Partner" name="fax" value="{$item->getPartner()->get('fax')|escape}" size="30" />
                 {if $form->company.fax->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("Siret")}</td>
             <td> 
                 <div  class="error-form">{$form.company.siret->getError()}</div> 
                 <input type="text" class="Partner" name="siret" value="{$item->getPartner()->get('siret')|escape}" size="30" />
                 {if $form->company.siret->getOption('required')}*{/if} 
             </td>             
         </tr>  
     {*     <tr>
             <td class="label">{__("GPS coordinates")}</td>
             <td> 
                 <div class="error-form">{$form.company.coordinates->getError()}</div> 
                 <input type="text" class="Partner" name="coordinates" value="{$item->getPartner()->get('coordinates')|escape}" size="30"/>
                 {if $form->company.coordinates->getOption('required')}*{/if} 
             </td>             
         </tr>   *}
    </table>
    <fieldset>
        <legend><h4>{__('Contact')}</h4></legend>
        <table class="tab-form">
                <tr>
             <td class="label">{__("title")}</td>
             <td> 
                 <div class="error-form">{$form.contact.sex->getError()}</div>                
                 {foreach $form->contact.sex->getOption("choices") as $name=>$gender}
                        <input type="radio" class="PartnerContact" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        <span>{format_gender($gender,1,true)|capitalize}</span>
                 {/foreach}{if $form->contact.sex->getOption('required')}*{/if}
             </td>
         </tr>
            <tr>
                <td class="label"><span>{__("firstname")}</span></td>
                <td>
                     <div class="error-form">{$form.contact.firstname->getError()}</div>               
                     <input type="text" class="PartnerContact" name="firstname" size="64" value="{$item->get('firstname')}"/> 
                     {if $form->contact.firstname->getOption('required')}*{/if} 
                </td>
            </tr> 
            <tr>
                <td class="label"><span>{__("lastname")}</span></td>
                <td>
                     <div class="error-form">{$form.contact.lastname->getError()}</div>               
                     <input type="text" class="PartnerContact" name="lastname" size="64" value="{$item->get('lastname')}"/> 
                     {if $form->contact.lastname->getOption('required')}*{/if} 
                </td>
            </tr> 
            <tr>
             <td class="label">{__("email")}</td>
             <td> 
                 <div class="error-form">{$form.contact.email->getError()}</div> 
                 <input type="text" class="PartnerContact" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                  {if $form->contact.email->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("phone")}</td>
             <td> 
                 <div class="error-form">{$form.contact.phone->getError()}</div> 
                 <input type="text" class="PartnerContact" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                 {if $form->contact.phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("mobile")}</td>
             <td> 
                 <div class="error-form">{$form.contact.mobile->getError()}</div> 
                 <input type="text" class="PartnerContact" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                 {if $form->contact.mobile->getOption('required')}*{/if} 
             </td>             
         </tr>     
          <tr>
             <td class="label">{__("fax")}</td>
             <td> 
                 <div class="error-form">{$form.contact.fax->getError()}</div> 
                 <input type="text" class="PartnerContact" name="fax" value="{$item->get('fax')|escape}" size="30"/>
                 {if $form->contact.fax->getOption('required')}*{/if} 
             </td>             
         </tr>     
        </table>
    </fieldset>
</fieldset>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".Partner,.PartnerContact").click(function() {  $('#Partner-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#Partner-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                              errorTarget: ".Partner-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#Partner-Save').click(function(){                             
            var  params= {            
                                Partner: {  
                                   company : { country : $(".Partner[name=country] option:selected").val()  },
                                   contact : { },
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $("input.Partner[type=text]").each(function() {  params.Partner.company[this.name]=$(this).val();  });  // Get foreign key        
          $("input.PartnerContact[type=text]").each(function() {  params.Partner.contact[this.name]=$(this).val();  });  // Get foreign key                  
          $("input.PartnerContact[type=radio]:checked").each(function() { params.Partner.contact[this.name]=$(this).val(); }); 
          return $.ajax2({ data : params,                            
                           errorTarget: ".Partner-errors",
                           url: "{url_to('partners_ajax',['action'=>'NewPartner'])}",
                           target: "#actions" }); 
        });  
     
</script>