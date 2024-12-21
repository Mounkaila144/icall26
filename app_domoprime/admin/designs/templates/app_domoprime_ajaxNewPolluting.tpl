{messages class="Polluting-errors"}
<h3>{__("New Polluting")|capitalize}</h3>
<div>
    <a href="#" id="Polluting-Save" class="btn" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Polluting-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<fieldset>
     <h4>{__('Company')}</h4>
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("name")}</span></td>
            <td class="label">
                 <div>{$form.company.name->getError()}</div>               
                 <input type="text" class="Polluting Input" name="name" size="34" value="{$item->getCompany()->get('name')}"/> 
                 {if $form->company.name->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
            <td class="label"><span>{__("commercial name")}</span></td>
            <td class="label">
                 <div>{$form.company.commercial->getError()}</div>               
                 <input type="text" class="Polluting Input" name="commercial" size="34" value="{$item->getCompany()->get('commercial')}"/> 
                 {if $form->company.commercial->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td class="label">{__("web")}</td>
             <td class="label"> 
                 <div>{$form.company.web->getError()}</div> 
                 <input type="text" class="Polluting Input" name="web" size="34" value="{$item->getCompany()->get('web')|escape}" size="34"/>
                 {if $form->company.web->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td class="label">{__("email")}</td>
             <td class="label"> 
                 <div>{$form.company.email->getError()}</div> 
                 <input type="text" class="Polluting Input" name="email" size="34" value="{$item->getCompany()->get('email')|escape}" size="34"/>
                  {if $form->company.email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("address1")}</td>
             <td class="label"> 
                 <div>{$form.company.address1->getError()}</div> 
                 <input type="text" class="Polluting Input" name="address1" size="34"  value="{$item->getCompany()->get('address1')|escape}" size="34" />
                 {if $form->company.address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td class="label">{__("address2")}</td>
             <td class="label"> 
                 <div>{$form.company.address2->getError()}</div> 
                 <input type="text" class="Polluting Input" name="address2" size="34" value="{$item->getCompany()->get('address2')|escape}" size="34" />
                 {if $form->company.address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
           <tr>
             <td class="label">{__("post code")}</td>
             <td class="label"> 
                 <div>{$form.company.postcode->getError()}</div> 
                 <input type="text" class="Polluting Input" name="postcode" size="10" value="{$item->getCompany()->get('postcode')|escape}" size="30"/>
                 {if $form->company.postcode->getOption('required')}*{/if} 
             </td>
         </tr>
          <tr>
             <td class="label">{__("city")}</td>
             <td class="label"> 
                 <div>{$form.company.city->getError()}</div> 
                 <input type="text" class="Polluting Input" name="city" size="34" value="{$item->getCompany()->get('city')|escape}" size="34"/>
                 {if $form->company.city->getOption('required')}*{/if} 
                 <div id="Polluting-cities_container"></div>
             </td>             
         </tr>  
       {*  <tr>
             <td class="label">{__("country")}</td>
             <td class="label"> 
                 <div>{$form.company.country->getError()}</div>                 
                 {select_country class="Polluting" name="country"  selected=$item->getCompany()->get('country')}
             </td> 
         </tr>  *}
          <tr>
             <td class="label">{__("phone")}</td>
             <td class="label"> 
                 <div>{$form.company.phone->getError()}</div> 
                 <input type="text" class="Polluting Input" name="phone" value="{$item->getCompany()->get('phone')|escape}" size="34"/>
                 {if $form->company.phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("mobile")}</td>
             <td class="label"> 
                 <div>{$form.company.mobile->getError()}</div> 
                 <input type="text" class="Polluting Input" name="mobile" value="{$item->getCompany()->get('mobile')|escape}" size="34"/>
                 {if $form->company.mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
        <tr>
            <td class="label">{__("fax")}</td>
            <td class="label"> 
                <div>{$form.company.fax->getError()}</div> 
                <input type="text" class="Polluting Input" name="fax" value="{$item->getCompany()->get('fax')|escape}" size="34" />
                {if $form->company.fax->getOption('required')}*{/if} 
            </td>             
        </tr>  
         <tr>
             <td class="label">{__("siret")}</td>
             <td class="label"> 
                 <div>{$form.company.siret->getError()}</div> 
                 <input type="text" class="Polluting Input" name="siret" value="{$item->getCompany()->get('siret')|escape}" size="30" />
                 {if $form->company.siret->getOption('required')}*{/if} 
             </td>             
         </tr>
         <tr>
            <td class="label">{__("GPS coordinates")}</td>
            <td class="label"> 
                <div>{$form.company.coordinates->getError()}</div> 
                <input type="text" class="Polluting Input" name="coordinates" value="{$item->getCompany()->get('coordinates')|escape}" size="34"/>
                {if $form->company.coordinates->getOption('required')}*{/if} 
            </td>             
        </tr> 
         <tr>
            <td class="label">{__("Comments")}</td>
            <td class="label"> 
                <div>{$form.company.comments->getError()}</div> 
                <textarea rows="4" cols="40" class="Polluting Input" name="comments">{$item->getCompany()->get('comments')|escape}</textarea>
                {if $form->company.comments->getOption('required')}*{/if} 
            </td>             
        </tr> 
        <tr>
        <td class="label">{__('Default')}</td>
         <td>           
            <input type="checkbox" class="Polluting Checkbox" value="YES" name="is_default" {if $item->getCompany()->isDefault()}checked=""{/if} />
        </td>
    </tr> 
   </table>
   <fieldset>
       <h4>{__('Contact')}</h4>
       <table class="tab-form">
       <tr>
            <td class="label">{__("title")}</td>
            <td class="label"> 
                <div>{$form.contact.sex->getError()}</div>                
                {foreach $form->contact.sex->getOption("choices") as $name=>$gender}
                       <input type="radio" class="PollutingContact Input" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                       <span>{format_gender($gender,1,true)|capitalize}</span>
                {/foreach}{if $form->contact.sex->getOption('required')}*{/if}
            </td>
        </tr>
       <tr>
               <td class="label"><span>{__("firstname")}</span></td>
               <td class="label">
                    <div>{$form.contact.firstname->getError()}</div>               
                    <input type="text" class="PollutingContact Input" name="firstname" size="34" value="{$item->get('firstname')}"/> 
                    {if $form->contact.firstname->getOption('required')}*{/if} 
               </td>
           </tr> 
           <tr>
               <td class="label"><span>{__("lastname")}</span></td>
               <td class="label">
                    <div>{$form.contact.lastname->getError()}</div>               
                    <input type="text" class="PollutingContact Input" name="lastname" size="34" value="{$item->get('lastname')}"/> 
                    {if $form->contact.lastname->getOption('required')}*{/if} 
               </td>
           </tr> 
           <tr>
            <td class="label">{__("email")}</td>
            <td class="label"> 
                <div>{$form.contact.email->getError()}</div> 
                <input type="text" class="PollutingContact Input" name="email" size="34" value="{$item->get('email')|escape}" size="34"/>
                 {if $form->contact.email->getOption('required')}*{/if} 
            </td>             
        </tr>  
         <tr>
             <td class="label">{__("phone")}</td>
             <td class="label"> 
                 <div>{$form.contact.phone->getError()}</div> 
                 <input type="text" class="PollutingContact Input" name="phone" value="{$item->get('phone')|escape}" size="34"/>
                 {if $form->contact.phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("mobile")}</td>
             <td class="label"> 
                 <div>{$form.contact.mobile->getError()}</div> 
                 <input type="text" class="PollutingContact Input" name="mobile" value="{$item->get('mobile')|escape}" size="34"/>
                 {if $form->contact.mobile->getOption('required')}*{/if} 
             </td>             
         </tr>     
          <tr>
             <td class="label">{__("fax")}</td>
             <td class="label"> 
                 <div>{$form.contact.fax->getError()}</div> 
                 <input type="text" class="PollutingContact Input" name="fax" value="{$item->get('fax')|escape}" size="34"/>
                 {if $form->contact.fax->getOption('required')}*{/if} 
             </td>             
         </tr>     
        </table>
    </fieldset>
</fieldset>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".Polluting,.PollutingContact").click(function() {  $('#Polluting-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#Polluting-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                              errorTarget: ".Polluting-errors",
                              loading: "#tab-site-dashboard-site-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#Polluting-Save').click(function(){                             
            var  params= {            
                                Polluting: {  
                                   company : { country : $(".Polluting[name=country] option:selected").val()  },
                                   contact : { },
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".Polluting.Input").each(function() {  params.Polluting.company[this.name]=$(this).val();  });  // Get foreign key        
          $(".Polluting.Checkbox:checked").each(function() {  params.Polluting.company[this.name]=$(this).val();  });  // Get foreign key        
          $(".PollutingContact.Input").each(function() {  params.Polluting.contact[this.name]=$(this).val();  });  // Get foreign key                  
          $(".PollutingContact.Checkbox:checked").each(function() { params.Polluting.contact[this.name]=$(this).val(); }); 
          return $.ajax2({ data : params,                            
                           errorTarget: ".Polluting-errors",
                           url: "{url_to('app_domoprime_ajax',['action'=>'NewPolluting'])}",
                           target: "#actions" }); 
        });  
     
</script>
