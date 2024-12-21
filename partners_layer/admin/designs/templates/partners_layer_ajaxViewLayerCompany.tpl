{messages class="PartnerLayer-errors"}
<h3>{__("View partner layer")}</h3>
<div>
    <a href="#" id="PartnerLayer-Save" class="btn" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('Save')}"/>{__('Save')}</a>
    <a href="#" id="PartnerLayer-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("Name")}</span></td>
            <td class="label">
                 <div>{$form.name->getError()}</div>               
                 <input type="text" class="PartnerLayer Input" name="name" size="64" value="{$item->get('name')}"/> 
                 {if $form->name->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td class="label">{__("Web")}</td>
             <td class="label"> 
                 <div>{$form.web->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="web" size="64" value="{$item->get('web')|escape}" size="30"/>
                 {if $form->web->getOption('required')}*{/if} 
             </td>
         </tr>
        <tr>
             <td class="label">{__("Post code")}</td>
             <td class="label"> 
                 <div>{$form.postcode->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="postcode" size="64" value="{$item->get('postcode')|escape}" size="30"/>
                 {if $form->postcode->getOption('required')}*{/if} 
             </td>
         </tr>
         <tr>
             <td class="label">{__("Email")}</td>
             <td class="label"> 
                 <div>{$form.email->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                  {if $form->email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("Address1")}</td>
             <td class="label"> 
                 <div>{$form.address1->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="address1" size="64"  value="{$item->get('address1')|escape}" size="30" />
                 {if $form->address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td class="label">{__("Address2")}</td>
             <td class="label"> 
                 <div>{$form.address2->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="address2" size="64" value="{$item->get('address2')|escape}" size="30" />
                 {if $form->address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
          <tr>
             <td class="label">{__("City")}</td>
             <td class="label"> 
                 <div>{$form.city->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="city" size="32" value="{$item->get('city')|escape}" size="30"/>
                 {if $form->city->getOption('required')}*{/if} 
                 <div id="PartnerLayer-cities_container"></div>
             </td>             
         </tr>  
        {* <tr>
             <td class="label">{__("Country")}</td>
             <td class="label"> 
                 <div>{$form.country->getError()}</div>                 
                 {select_country class="PartnerLayer" name="country" selected=$item->get('country')}
             </td> 
         </tr>  *}
          <tr>
             <td class="label">{__("Phone")}</td>
             <td class="label"> 
                 <div>{$form.phone->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                 {if $form->phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("Mobile")}</td>
             <td class="label"> 
                 <div>{$form.mobile->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                 {if $form->mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
         <tr>
             <td class="label">{__("Fax")}</td>
             <td class="label"> 
                 <div>{$form.fax->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="fax" value="{$item->get('fax')|escape}" size="30" />
                 {if $form->fax->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("Siret")}</td>
             <td class="label"> 
                 <div>{$form.siret->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="siret" value="{$item->get('siret')|escape}" size="30" />
                 {if $form->siret->getOption('required')}*{/if} 
             </td>             
         </tr>
          <tr>
             <td class="label">{__("RGE")}</td>
             <td> 
                 <div class="error-form">{$form.rge->getError()}</div> 
                 <input type="text" class="PartnerLayer Input" name="rge" value="{$item->get('rge')|escape}" size="30"/>
                 {if $form->rge->getOption('required')}*{/if} 
             </td>             
         </tr>
         <tr>
             <td class="label">{__("RGE Start At")}</td>
             <td> 
                 <div class="error-form">{$form.rge_start_at->getError()}</div> 
                 <input type="text" class="PartnerLayer Input Date" name="rge_start_at" value="{if $form->hasErrors()}{$form.rge_start_at}{else if $item->hasRgeStartAt()}{$item->getRgeStartAt()->getText()}{/if}" size="10"/>
                 {if $form->rge_start_at->getOption('required')}*{/if} 
             </td>             
         </tr>         
          <tr>
             <td class="label">{__("RGE End At")}</td>
             <td> 
                 <div class="error-form">{$form.rge_end_at->getError()}</div> 
                 <input type="text" class="PartnerLayer Input Date" name="rge_end_at" value="{if $form->hasErrors()}{$form.rge_end_at}{else if $item->hasRgeStartAt()}{$item->getRgeStartAt()->getText()}{/if}" size="10"/>
                 {if $form->rge_end_at->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("GPS coordinates")}</td>
             <td class="label">               
                 <span>{if $item->hasCoordinates()}{$item->getCoordinates()->getFormattedCoordinates()}{else}{__('---')}{/if}</span>
             </td>             
         </tr> 
          <tr>
         <td class="label">{__('Logo')}</td>
         <td>           
            <img {if $item->get("logo")}height="128px" width="128px"{/if} style="display:block"  id="logoImg" {if $item->get("logo")}src='{$item->getLogo()->getUrl()}' alt="{__('Logo')}{else}style="display:none"{/if}"/>                 
                 <a id="logoDelete" class="btn" href="#" {if !$item->get("logo")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('Delete')}"/>{__('Delete')}</a>
     
           
            <a id="logoChange" class="btn" href="#" {if !$item->get("logo")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','logo')}" alt="{__('Change')}"/>{__('Change logo')}</a>
            <a id="logoAdd" href="#" class="btn" {if $item->get("logo")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add logo')}</a> 
           
            <div id="logoForm" style="display:none">
                  <input id="logoFile" type="file" name="PartnerPolluter[logo]"/> 
                  <a href="#" id="logoUpload"><img src="{url('/icons/upload.png','logo')}" alt="{__('Upload')}"></a>
                  <img id="logoLoading" height="16" width="16" src="{url('/icons/loading.gif','logo')}" alt="" style="display:none;"> 
            </div>    
        </td>
    </tr>
       <tr>
        <td class="label">{__('Default')}</td>
         <td>           
            <input type="checkbox" class="PartnerLayer Checkbox" value="YES" name="is_default" {if $item->isDefault()}checked=""{/if} />
        </td>
    </tr>
    </table>
{else}
    <span>{__('Installer is invalid.')}</span>
{/if}    

<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".PartnerLayer").click(function() {  $('#PartnerLayer-Save').show(); });    
    
     $(".Date").datepicker();
    
     {* =================== A C T I O N S ================================ *}
     $('#PartnerLayer-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('partners_layer_ajax',['action'=>'ListPartialLayerCompany'])}",
                              errorTarget: ".PartnerLayer-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#PartnerLayer-Save').click(function(){                             
            var  params= {            
                                PartnerLayer: {   
                                   id: "{$item->get('id')}",
                                   country : $(".PartnerLayer[name=country] option:selected").val(),
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".PartnerLayer.Input").each(function() {  params.PartnerLayer[this.name]=$(this).val();  });  // Get foreign key               
          $(".PartnerLayer.Checkbox:checked").each(function() {  params.PartnerLayer[this.name]=$(this).val();  });  // Get foreign key               
          return $.ajax2({ data : params,                            
                           errorTarget: ".PartnerLayer-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",         
                           url: "{url_to('partners_layer_ajax',['action'=>'SaveLayerCompany'])}",
                           target: "#actions" }); 
        });  
    

        $("#logoUpload").click(function () { 
             return $.ajax2({ data : { PartnerLayer : { id: "{$item->get('id')}", token : "{mfForm::getToken('PartnerLayerCompanyLogoForm')}" } },
                              files: "#logoFile",
                              url: "{url_to('partners_layer_ajax',['action'=>'SaveLogoLayerCompany'])}",
                              errorTarget: ".PartnerLayer-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",         
                              success: function (response)
                                       {
                                            $("#logoFile").val('');     
                                            if (response.logo)
                                            { 
                                                $("#logoImg").attr('src',"{$item->getLogo()->getURLPath()}"+response.logo+"?"+$.now()); 
                                                $("#logoImg").attr({ height:"128px",width:"128px" });
                                                $("#logoFilename").html("["+response.logo+"]");
                                                $("#logoForm,#logoAdd").hide(); 
                                                $("#logoChange,#logoDelete,#logoFilename,#logoImg").show();
                                            }
                                       }
                            });
         });
       
          $('#logoChange,#logoAdd').click(function(){ 
              $("#logoForm").show();
              $(this).hide();
         });
         
          $('#logoDelete').click(function(){ 
                  if (!confirm('{__("Picture  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { PartnerLayer:"{$item->get('id')}" }, 
                                   url: "{url_to('partners_layer_ajax',['action'=>'DeleteLogoLayerCompany'])}",
                                   errorTarget: ".PartnerLayer-errors",
                                   loading: "#tab-site-dashboard-x-settings-loading", 
                                   success :function(response) {
                                                    if (response.action=='DeleteLogo'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#logoAdd").show();
                                                        $("#logoChange,#logoFilename,#logoImg,#logoDelete,#logoForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
</script>
