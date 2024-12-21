{messages class="{$site->getSiteID()}-Partner-errors"}
<h3>{__("New partner")|capitalize}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Partner-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-Partner-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<fieldset>
     <h4>{__('Company')}</h4>
    <table>
        <tr>
            <td><span>{__("name")}</span></td>
            <td>
                 <div>{$form.company.name->getError()}</div>               
                 <input type="text" class="{$site->getSiteID()}-Partner" name="name" size="64" value="{$item->getPartner()->get('name')}"/> 
                 {if $form->company.name->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td>{__("web")}</td>
             <td> 
                 <div>{$form.company.web->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="web" size="64" value="{$item->getPartner()->get('web')|escape}" size="30"/>
                 {if $form->company.web->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td>{__("email")}</td>
             <td> 
                 <div>{$form.company.email->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="email" size="64" value="{$item->getPartner()->get('email')|escape}" size="30"/>
                  {if $form->company.email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td>{__("address1")}</td>
             <td> 
                 <div>{$form.company.address1->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="address1" size="64"  value="{$item->getPartner()->get('address1')|escape}" size="30" />
                 {if $form->company.address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td>{__("address2")}</td>
             <td> 
                 <div>{$form.company.address2->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="address2" size="64" value="{$item->getPartner()->get('address2')|escape}" size="30" />
                 {if $form->company.address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
          <tr>
             <td>{__("city")}</td>
             <td> 
                 <div>{$form.company.city->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="city" size="32" value="{$item->getPartner()->get('city')|escape}" size="30"/>
                 {if $form->company.city->getOption('required')}*{/if} 
                 <div id="{$site->getSiteID()}-Partner-cities_container"></div>
             </td>             
         </tr>  
         <tr>
             <td>{__("country")}</td>
             <td> 
                 <div>{$form.company.country->getError()}</div>                 
                 {select_country class="{$site->getSiteID()}-Partner" name="country" selected=$item->getPartner()->get('country')}
             </td> 
         </tr>  
          <tr>
             <td>{__("phone")}</td>
             <td> 
                 <div>{$form.company.phone->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="phone" value="{$item->getPartner()->get('phone')|escape}" size="30"/>
                 {if $form->company.phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td>{__("mobile")}</td>
             <td> 
                 <div>{$form.company.mobile->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="mobile" value="{$item->getPartner()->get('mobile')|escape}" size="30"/>
                 {if $form->company.mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
         <tr>
             <td>{__("fax")}</td>
             <td> 
                 <div>{$form.company.fax->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="fax" value="{$item->getPartner()->get('fax')|escape}" size="30" />
                 {if $form->company.fax->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td>{__("GPS coordinates")}</td>
             <td> 
                 <div>{$form.company.coordinates->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Partner" name="coordinates" value="{$item->getPartner()->get('coordinates')|escape}" size="30"/>
                 {if $form->company.coordinates->getOption('required')}*{/if} 
             </td>             
         </tr>   
    </table>
    <fieldset>
        <h4>{__('Contact')}</h4>
        <table>
                <tr>
             <td>{__("title")}</td>
             <td> 
                 <div>{$form.contact.sex->getError()}</div>                
                 {foreach $form->contact.sex->getOption("choices") as $name=>$gender}
                        <input type="radio" class="{$site->getSiteID()}-PartnerContact" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        <span>{format_gender($gender,1,true)|capitalize}</span>
                 {/foreach}{if $form->contact.sex->getOption('required')}*{/if}
             </td>
         </tr>
            <tr>
                <td><span>{__("firstname")}</span></td>
                <td>
                     <div>{$form.contact.firstname->getError()}</div>               
                     <input type="text" class="{$site->getSiteID()}-PartnerContact" name="firstname" size="64" value="{$item->get('firstname')}"/> 
                     {if $form->contact.firstname->getOption('required')}*{/if} 
                </td>
            </tr> 
            <tr>
                <td><span>{__("lastname")}</span></td>
                <td>
                     <div>{$form.contact.lastname->getError()}</div>               
                     <input type="text" class="{$site->getSiteID()}-PartnerContact" name="lastname" size="64" value="{$item->get('lastname')}"/> 
                     {if $form->contact.lastname->getOption('required')}*{/if} 
                </td>
            </tr> 
            <tr>
             <td>{__("email")}</td>
             <td> 
                 <div>{$form.contact.email->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-PartnerContact" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                  {if $form->contact.email->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td>{__("phone")}</td>
             <td> 
                 <div>{$form.contact.phone->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-PartnerContact" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                 {if $form->contact.phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td>{__("mobile")}</td>
             <td> 
                 <div>{$form.contact.mobile->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-PartnerContact" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                 {if $form->contact.mobile->getOption('required')}*{/if} 
             </td>             
         </tr>     
          <tr>
             <td>{__("fax")}</td>
             <td> 
                 <div>{$form.contact.fax->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-PartnerContact" name="fax" value="{$item->get('fax')|escape}" size="30"/>
                 {if $form->contact.fax->getOption('required')}*{/if} 
             </td>             
         </tr>     
        </table>
    </fieldset>
</fieldset>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-Partner,.{$site->getSiteID()}-PartnerContact").click(function() {  $('#{$site->getSiteID()}-Partner-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-Partner-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_ajax',['action'=>'ListPartialPartner'])}",
                              errorTarget: ".{$site->getSiteID()}-Partner-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#{$site->getSiteID()}-Partner-Save').click(function(){                             
            var  params= {            
                                Partner: {  
                                   company : { country : $(".{$site->getSiteID()}-Partner[name=country] option:selected").val()  },
                                   contact : { },
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $("input.{$site->getSiteID()}-Partner[type=text]").each(function() {  params.Partner.company[this.name]=$(this).val();  });  // Get foreign key        
          $("input.{$site->getSiteID()}-PartnerContact[type=text]").each(function() {  params.Partner.contact[this.name]=$(this).val();  });  // Get foreign key                  
          $("input.{$site->getSiteID()}-PartnerContact[type=radio]:checked").each(function() { params.Partner.contact[this.name]=$(this).val(); }); 
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-Partner-errors",
                           url: "{url_to('partners_ajax',['action'=>'NewPartner'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>