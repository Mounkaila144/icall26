{messages class="MutualPartner-errors"}
<h3>{__("New mutual")}</h3>
<div>
    <a href="#" id="MutualPartner-Save" style="display:none" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right: 10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualPartner-Cancel" class="btn"><i class="fa fa-times" style="color:#000; margin-right: 10px;"></i>{__('Cancel')}</a>
</div>
<fieldset>
    <legend><h4>{__('Company')}</h4></legend>
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("Name")}</span></td>
            <td>
                <div class="error-form">{$form.company.name->getError()}</div>               
                <input type="text" class="MutualPartner" name="name" size="64" value="{$item->getPartner()->get('name')}"/> 
                {if $form->company.name->getOption('required')}*{/if} 
            </td>
        </tr> 
        <tr>
            <td class="label">{__("Web")}</td>
            <td> 
                <div class="error-form">{$form.company.web->getError()}</div> 
                <input type="text" class="MutualPartner" name="web" size="64" value="{$item->getPartner()->get('web')|escape}" size="30"/>
                {if $form->company.web->getOption('required')}*{/if} 
            </td>
        </tr>
        <tr>
            <td class="label">{__("Email")}</td>
            <td> 
                <div class="error-form">{$form.company.email->getError()}</div> 
                <input type="text" class="MutualPartner" name="email" size="64" value="{$item->getPartner()->get('email')|escape}" size="30"/>
                 {if $form->company.email->getOption('required')}*{/if} 
            </td>             
        </tr>  
        <tr>
            <td class="label">{__("Address1")}</td>
            <td> 
                <div class="error-form">{$form.company.address1->getError()}</div> 
                <input type="text" class="MutualPartner" name="address1" size="64"  value="{$item->getPartner()->get('address1')|escape}" size="30" />
                {if $form->company.address1->getOption('required')}*{/if} 
            </td>             
        </tr>   
        <tr>
            <td class="label">{__("Address2")}</td>
            <td> 
                <div class="error-form">{$form.company.address2->getError()}</div> 
                <input type="text" class="MutualPartner" name="address2" size="64" value="{$item->getPartner()->get('address2')|escape}" size="30" />
                {if $form->company.address2->getOption('required')}*{/if} 
            </td>             
        </tr>   
        <tr>
            <td class="label">{__("City")}</td>
            <td> 
                <div class="error-form">{$form.company.city->getError()}</div> 
                <input type="text" class="MutualPartner" name="city" size="32" value="{$item->getPartner()->get('city')|escape}" size="30"/>
                {if $form->company.city->getOption('required')}*{/if} 
                <div id="MutualPartner-cities_container"></div>
            </td>             
        </tr>  
      {*  <tr>
            <td class="label">{__("Country")}</td>
            <td> 
                <div class="error-form">{$form.company.country->getError()}</div>                 
                {select_country class="MutualPartner" name="country" selected=$item->getPartner()->get('country')}
            </td> 
        </tr>  *}
        <tr>
            <td class="label">{__("Phone")}</td>
            <td> 
                <div class="error-form">{$form.company.phone->getError()}</div> 
                <input type="text" class="MutualPartner" name="phone" value="{$item->getPartner()->get('phone')|escape}" size="30"/>
                {if $form->company.phone->getOption('required')}*{/if} 
            </td>             
        </tr>  
        <tr>
            <td class="label">{__("Mobile")}</td>
            <td> 
                <div class="error-form">{$form.company.mobile->getError()}</div> 
                <input type="text" class="MutualPartner" name="mobile" value="{$item->getPartner()->get('mobile')|escape}" size="30"/>
                {if $form->company.mobile->getOption('required')}*{/if} 
            </td>             
        </tr>           
        <tr>
            <td class="label">{__("Fax")}</td>
            <td> 
                <div class="error-form">{$form.company.fax->getError()}</div> 
                <input type="text" class="MutualPartner" name="fax" value="{$item->getPartner()->get('fax')|escape}" size="30" />
                {if $form->company.fax->getOption('required')}*{/if} 
            </td>             
        </tr>  
       {* <tr>
            <td class="label">{__("GPS coordinates")}</td>
            <td> 
                <div class="error-form">{$form.company.coordinates->getError()}</div> 
                <input type="text" class="MutualPartner" name="coordinates" value="{$item->getPartner()->get('coordinates')|escape}" size="30"/>
                {if $form->company.coordinates->getOption('required')}*{/if} 
            </td>             
        </tr>   *}
    </table>
    <fieldset>
        <legend><h4>{__('Contact')}</h4></legend>
        <table class="tab-form">
            <tr>
                <td class="label">{__("Title")}</td>
                <td> 
                    <div class="error-form">{$form.contact.sex->getError()}</div>                
                    {foreach $form->contact.sex->getOption("choices") as $name=>$gender}
                        <input type="radio" class="MutualPartnerContact" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        <span>{format_gender($gender,1,true)|capitalize}</span>
                    {/foreach}{if $form->contact.sex->getOption('required')}*{/if}
                </td>
            </tr>
            <tr>
                <td class="label"><span>{__("Firstname")}</span></td>
                <td>
                    <div class="error-form">{$form.contact.firstname->getError()}</div>               
                    <input type="text" class="MutualPartnerContact" name="firstname" size="64" value="{$item->get('firstname')}"/> 
                    {if $form->contact.firstname->getOption('required')}*{/if} 
                </td>
            </tr> 
            <tr>
                <td class="label"><span>{__("Lastname")}</span></td>
                <td>
                    <div class="error-form">{$form.contact.lastname->getError()}</div>               
                    <input type="text" class="MutualPartnerContact" name="lastname" size="64" value="{$item->get('lastname')}"/> 
                    {if $form->contact.lastname->getOption('required')}*{/if} 
                </td>
            </tr> 
            <tr>
                <td class="label">{__("Email")}</td>
                <td> 
                    <div class="error-form">{$form.contact.email->getError()}</div> 
                    <input type="text" class="MutualPartnerContact" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                    {if $form->contact.email->getOption('required')}*{/if} 
                </td>             
            </tr>  
            <tr>
                <td class="label">{__("Phone")}</td>
                <td> 
                    <div class="error-form">{$form.contact.phone->getError()}</div> 
                    <input type="text" class="MutualPartnerContact" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                    {if $form->contact.phone->getOption('required')}*{/if} 
                </td>             
            </tr>  
            <tr>
                <td class="label">{__("Mobile")}</td>
                <td> 
                    <div class="error-form">{$form.contact.mobile->getError()}</div> 
                    <input type="text" class="MutualPartnerContact" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                    {if $form->contact.mobile->getOption('required')}*{/if} 
                </td>             
            </tr>     
            <tr>
                <td class="label">{__("Fax")}</td>
                <td> 
                    <div class="error-form">{$form.contact.fax->getError()}</div> 
                    <input type="text" class="MutualPartnerContact" name="fax" value="{$item->get('fax')|escape}" size="30"/>
                    {if $form->contact.fax->getOption('required')}*{/if} 
                </td>             
           </tr>     
        </table>
    </fieldset>
</fieldset>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
    $(".MutualPartner,.MutualPartnerContact").click(function() {  $('#MutualPartner-Save').show(); });    
    
     {* =================== A C T I O N S ================================ *}
    $('#MutualPartner-Cancel').click(function(){                           
        return $.ajax2({                               
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });
      
    $('#MutualPartner-Save').click(function() {                             
        var  params= {            
                        MutualPartner: {  
                           company : { country : $(".MutualPartner[name=country] option:selected").val()  },
                           contact : { },
                           token :'{$form->getCSRFToken()}'
                        } };   
        
        $("input.MutualPartner[type=text]").each(function() {  params.MutualPartner.company[this.name]=$(this).val();  });  // Get foreign key        
        $("input.MutualPartnerContact[type=text]").each(function() {  params.MutualPartner.contact[this.name]=$(this).val();  });  // Get foreign key                  
        $("input.MutualPartnerContact[type=radio]:checked").each(function() { params.MutualPartner.contact[this.name]=$(this).val(); }); 
        
        
        return $.ajax2({ data : params,                            
                        errorTarget: ".MutualPartner-errors",
                        url: "{url_to('app_mutual_ajax',['action'=>'NewMutualPartner'])}",
                        target: "#actions" }); 
    });
    
     
</script>