{messages class="MutualPartner-errors"}
<h3>{__("View mutual")}</h3>
<div>
    <a href="#" id="MutualPartner-Save" style="display:none" class="btn"><i class="fa fa-floppy-o" style="color: #000; margin-right: 10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualPartner-Cancel" class="btn"><i class="fa fa-times" style="color: #000; margin-right: 10px;"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("Name")}</span></td>
            <td>
                <div class="error-form">{$form.name->getError()}</div>               
                <input type="text" class="MutualPartner" name="name" size="64" value="{$item->get('name')}"/> 
                {if $form->name->getOption('required')}*{/if} 
            </td>
        </tr> 
        <tr>
            <td class="label">{__("Web")}</td>
            <td> 
                <div class="error-form">{$form.web->getError()}</div> 
                <input type="text" class="MutualPartner" name="web" size="64" value="{$item->get('web')|escape}" size="30"/>
                {if $form->web->getOption('required')}*{/if} 
            </td>
        </tr>
        <tr>
            <td class="label">{__("Email")}</td>
            <td> 
                <div class="error-form">{$form.email->getError()}</div> 
                <input type="text" class="MutualPartner" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                {if $form->email->getOption('required')}*{/if} 
            </td>             
        </tr>  
        <tr>
            <td class="label">{__("Address1")}</td>
            <td> 
                <div class="error-form">{$form.address1->getError()}</div> 
                <input type="text" class="MutualPartner" name="address1" size="64"  value="{$item->get('address1')|escape}" size="30" />
                {if $form->address1->getOption('required')}*{/if} 
            </td>             
        </tr>   
        <tr>
            <td class="label">{__("Address2")}</td>
            <td> 
                <div class="error-form">{$form.address2->getError()}</div> 
                <input type="text" class="MutualPartner" name="address2" size="64" value="{$item->get('address2')|escape}" size="30" />
                {if $form->address2->getOption('required')}*{/if} 
            </td>             
        </tr> 
        <tr>
            <td class="label">{__("Postcode")}</td>
            <td> 
                <div  class="error-form">{$form.postcode->getError()}</div> 
                <input type="text" class="MutualPartner" name="postcode" size="32" value="{$item->get('postcode')|escape}" size="30"/>
                {if $form->postcode->getOption('required')}*{/if}                
            </td>             
        </tr>
        <tr>
            <td class="label">{__("City")}</td>
            <td> 
                <div class="error-form">{$form.city->getError()}</div> 
                <input type="text" class="MutualPartner" name="city" size="32" value="{$item->get('city')|escape}" size="30"/>
                {if $form->city->getOption('required')}*{/if} 
                <div id="MutualPartner-cities_container"></div>
            </td>             
        </tr>  
        <tr>
            <td class="label">{__("Phone")}</td>
            <td> 
                <div class="error-form">{$form.phone->getError()}</div> 
                <input type="text" class="MutualPartner" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                {if $form->phone->getOption('required')}*{/if} 
            </td>             
        </tr>  
        <tr>
            <td class="label">{__("Mobile")}</td>
            <td> 
                <div class="error-form">{$form.mobile->getError()}</div> 
                <input type="text" class="MutualPartner" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                {if $form->mobile->getOption('required')}*{/if} 
            </td>             
        </tr>           
        <tr>
            <td class="label">{__("Fax")}</td>
            <td> 
                <div class="error-form">{$form.fax->getError()}</div> 
                <input type="text" class="MutualPartner" name="fax" value="{$item->get('fax')|escape}" size="30" />
                {if $form->fax->getOption('required')}*{/if} 
            </td>             
        </tr>  
        <tr>
            <td class="label">{__("Siret")}</td>
            <td> 
                <div  class="error-form">{$form.siret->getError()}</div> 
                <input type="text" class="MutualPartner" name="siret" value="{$item->get('siret')|escape}" size="30" />
                {if $form->siret->getOption('required')}*{/if} 
            </td>             
        </tr>  
    </table>
{else}
    <span>{__('MutualPartner is invalid.')}</span>
{/if}    

<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
    $(".MutualPartner").click(function() {  $('#MutualPartner-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
    $('#MutualPartner-Cancel').click(function(){                           
        return $.ajax2({                               
                        url : "{url_to('app_mutual_ajax',['action'=>'ListPartialMutualPartner'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });
      
    $('#MutualPartner-Save').click(function(){                             
        var  params= {            
                        MutualPartner: {   
                           id: "{$item->get('id')}",
                           country : $(".MutualPartner[name=country] option:selected").val(),
                           token :'{$form->getCSRFToken()}'
                        } };        
        $("input.MutualPartner").each(function() {  params.MutualPartner[this.name]=$(this).val();  });               
        return $.ajax2({ data : params,                            
                        errorTarget: ".MutualPartner-errors",
                        url: "{url_to('app_mutual_ajax',['action'=>'SaveMutualPartner'])}",
                        target: "#actions" }); 
    });  
     
</script>