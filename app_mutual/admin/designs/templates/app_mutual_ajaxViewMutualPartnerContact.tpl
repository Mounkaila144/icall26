{messages class="MutualPartner-errors"}
<h3>{__("View contact for mutual: %s.",$item->getPartner()->get('name'))}</h3>
<div>
    <a href="#" id="MutualPartnerContact-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="MutualPartnerContact-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>

<table class="tab-form">
    <tr>
        <td class="label">{__("Title")}</td>
        <td> 
            <div class="error-form">{$form.sex->getError()}</div>                
            {foreach $form->sex->getOption("choices") as $name=>$gender}
                <input type="radio" class="MutualPartnerContact" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                <span>{format_gender($gender,1,true)|capitalize}</span>
            {/foreach}{if $form->sex->getOption('required')}*{/if}
        </td>
    </tr>
    <tr>
        <td class="label"><span>{__("Firstname")}</span></td>
        <td>
            <div class="error-form">{$form.firstname->getError()}</div>               
            <input type="text" class="MutualPartnerContact" name="firstname" size="64" value="{$item->get('firstname')}"/> 
            {if $form->firstname->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Lastname")}</span></td>
        <td>
            <div class="error-form">{$form.lastname->getError()}</div>               
            <input type="text" class="MutualPartnerContact" name="lastname" size="64" value="{$item->get('lastname')}"/> 
            {if $form->lastname->getOption('required')}*{/if} 
        </td>
    </tr> 
    <tr>
        <td class="label" >{__("Email")}</td>
        <td> 
            <div class="error-form">{$form.email->getError()}</div> 
            <input type="text" class="MutualPartnerContact" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
            {if $form->email->getOption('required')}*{/if} 
        </td>             
    </tr>  
    <tr>
        <td class="label">{__("Phone")}</td>
        <td> 
            <div class="error-form">{$form.phone->getError()}</div> 
            <input type="text" class="MutualPartnerContact" name="phone" value="{$item->get('phone')|escape}" size="30"/>
            {if $form->phone->getOption('required')}*{/if} 
        </td>             
    </tr>  
    <tr>
        <td class="label">{__("Mobile")}</td>
        <td> 
            <div class="error-form">{$form.mobile->getError()}</div> 
            <input type="text" class="MutualPartnerContact" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
            {if $form->mobile->getOption('required')}*{/if} 
        </td>             
    </tr>     
    <tr>
        <td class="label">{__("Fax")}</td>
        <td> 
            <div class="error-form">{$form.fax->getError()}</div> 
            <input type="text" class="MutualPartnerContact" name="fax" value="{$item->get('fax')|escape}" size="30"/>
            {if $form->fax->getOption('required')}*{/if} 
        </td>             
   </tr>     
</table>

<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
    $(".MutualPartnerContact").click(function() {  $('#MutualPartnerContact-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
    $('#MutualPartnerContact-Cancel').click(function(){                           
        return $.ajax2({ data : { MutualPartner : "{$item->getPartner()->get('id')}" },                              
                        url : "{url_to('app_mutual_ajax',['action'=>'ListMutualPartnerContact'])}",
                        errorTarget: ".MutualPartner-errors",
                        loading: "#tab-site-dashboard-x-settings-loading",                         
                        target: "#actions" }); 
    });
      
    $('#MutualPartnerContact-Save').click(function(){                             
        var  params= {            
                        MutualPartnerContact: {  
                            id: "{$item->get('id')}",
                            country : $(".MutualPartnerContact[name=country] option:selected").val() ,                                   
                            token :'{$form->getCSRFToken()}'
                        } };                
        $("input.MutualPartnerContact[type=text]").each(function() {  params.MutualPartnerContact[this.name]=$(this).val();  });
        $("input.MutualPartnerContact[type=radio]:checked").each(function() { params.MutualPartnerContact[this.name]=$(this).val(); }); 
        return $.ajax2({ data : params,                            
                        errorTarget: ".MutualPartner-errors",
                        url: "{url_to('app_mutual_ajax',['action'=>'SaveMutualPartnerContact'])}",
                        target: "#actions" }); 
    });  
     
</script>