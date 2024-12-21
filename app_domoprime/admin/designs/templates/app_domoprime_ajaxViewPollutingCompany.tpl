{messages class="Polluting-errors"}
<h3>{__("View Polluting")}</h3>
<div>
    <a href="#" id="Polluting-Save" class="btn" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Polluting-Cancel" class="btn"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    <table class="tab-form">
        <tr>
            <td class="label"><span>{__("name")}</span></td>
            <td class="label">
                 <div>{$form.name->getError()}</div>               
                 <input type="text" class="Polluting Input" name="name" size="64" value="{$item->get('name')}"/> 
                 {if $form->name->getOption('required')}*{/if} 
            </td>
        </tr> 
        <tr>
            <td class="label"><span>{__("commercial name")}</span></td>
            <td class="label">
                 <div>{$form.commercial->getError()}</div>               
                 <input type="text" class="Polluting Input" name="commercial" size="64" value="{$item->get('commercial')}"/> 
                 {if $form->commercial->getOption('required')}*{/if} 
            </td>
        </tr> 
         <tr>
             <td class="label">{__("web")}</td>
             <td class="label"> 
                 <div>{$form.web->getError()}</div> 
                 <input type="text" class="Polluting Input" name="web" size="64" value="{$item->get('web')|escape}" size="30"/>
                 {if $form->web->getOption('required')}*{/if} 
             </td>
         </tr>      
         <tr>
             <td class="label">{__("email")}</td>
             <td class="label"> 
                 <div>{$form.email->getError()}</div> 
                 <input type="text" class="Polluting Input" name="email" size="64" value="{$item->get('email')|escape}" size="30"/>
                  {if $form->email->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("address1")}</td> 
             <td class="label"> 
                 <div>{$form.address1->getError()}</div> 
                 <input type="text" class="Polluting Input" name="address1" size="64"  value="{$item->get('address1')|escape}" size="30" />
                 {if $form->address1->getOption('required')}*{/if} 
             </td>             
         </tr>   
         <tr>
             <td class="label">{__("address2")}</td>
             <td class="label"> 
                 <div>{$form.address2->getError()}</div> 
                 <input type="text" class="Polluting Input" name="address2" size="64" value="{$item->get('address2')|escape}" size="30" />
                 {if $form->address2->getOption('required')}*{/if} 
             </td>             
         </tr>   
           <tr>
             <td class="label">{__("post code")}</td>
             <td class="label"> 
                 <div>{$form.postcode->getError()}</div> 
                 <input type="text" class="Polluting Input" name="postcode" size="10" value="{$item->get('postcode')|escape}" size="30"/>
                 {if $form->postcode->getOption('required')}*{/if} 
             </td>
         </tr>
          <tr>
             <td class="label">{__("city")}</td>
             <td class="label"> 
                 <div>{$form.city->getError()}</div> 
                 <input type="text" class="Polluting Input" name="city" size="32" value="{$item->get('city')|escape}" size="30"/>
                 {if $form->city->getOption('required')}*{/if} 
                 <div id="Polluting-cities_container"></div>
             </td>             
         </tr>  
       {*  <tr>
             <td class="label">{__("country")}</td>
             <td class="label"> 
                 <div>{$form.country->getError()}</div>                 
                 {select_country class="Polluting" name="country" selected=$item->get('country')}
             </td> 
         </tr> *}  
          <tr>
             <td class="label">{__("phone")}</td>
             <td class="label"> 
                 <div>{$form.phone->getError()}</div> 
                 <input type="text" class="Polluting Input" name="phone" value="{$item->get('phone')|escape}" size="30"/>
                 {if $form->phone->getOption('required')}*{/if} 
             </td>             
         </tr>  
         <tr>
             <td class="label">{__("mobile")}</td>
             <td class="label"> 
                 <div>{$form.mobile->getError()}</div> 
                 <input type="text" class="Polluting Input" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>
                 {if $form->mobile->getOption('required')}*{/if} 
             </td>             
         </tr>           
         <tr>
             <td class="label">{__("fax")}</td>
             <td class="label"> 
                 <div>{$form.fax->getError()}</div> 
                 <input type="text" class="Polluting Input" name="fax" value="{$item->get('fax')|escape}" size="30" />
                 {if $form->fax->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("siret")}</td>
             <td class="label"> 
                 <div>{$form.siret->getError()}</div> 
                 <input type="text" class="Polluting Input" name="siret" value="{$item->get('siret')|escape}" size="30" />
                 {if $form->siret->getOption('required')}*{/if} 
             </td>             
         </tr>  
          <tr>
             <td class="label">{__("GPS coordinates")}</td>
             <td class="label"> 
                 <div>{$form.coordinates->getError()}</div> 
                 <input type="text" class="Polluting Input" name="coordinates" value="{$item->get('coordinates')|escape}" size="30"/>
                 {if $form->coordinates->getOption('required')}*{/if} 
             </td>             
         </tr> 
           <tr>
            <td class="label">{__("Comments")}</td>
            <td class="label"> 
                <div>{$form.comments->getError()}</div> 
                <textarea rows="4" cols="40" class="Polluting Input" name="comments">{$item->get('comments')|escape}</textarea>
                {if $form->comments->getOption('required')}*{/if} 
            </td>             
        </tr> 
          <tr>
         <td class="label">{__('Logo')}</td>
         <td>           
            <img {if $item->get("logo")}height="128px" width="128px"{/if} style="display:block"  id="logoImg" {if $item->get("logo")}src='{$item->getLogo()->getUrl()}' alt="{__('Logo')}{else}style="display:none"{/if}"/>                 
                 <a id="logoDelete" class="btn" href="#" {if !$item->get("logo")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('Delete')}"/>{__('Delete')}</a>
     
           
            <a id="logoChange" class="btn" href="#" {if !$item->get("logo")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','picture')}" alt="{__('Change')}"/>{__('Change logo')}</a>
            <a id="logoAdd" href="#" class="btn" {if $item->get("logo")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add logo')}</a> 
           
            <div id="logoForm" style="display:none">
                  <input id="logoFile" type="file" name="PartnerPolluter[logo]"/> 
                  <a href="#" id="logoUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="logoLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>         
    </tr>
      <tr>
         <td class="label">{__('Signature')}</td>
         <td>           
            <img {if $item->get("signature")}height="128px" width="128px"{/if} style="display:block"  id="signatureImg" {if $item->get("signature")}src='{$item->getSignature()->getUrl()}' alt="{__('Signature')}{else}style="display:none"{/if}"/>                 
                 <a id="signatureDelete" class="btn" href="#" {if !$item->get("signature")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('Delete')}"/>{__('Delete')}</a>
     
           
            <a id="signatureChange" class="btn" href="#" {if !$item->get("signature")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','picture')}" alt="{__('Change')}"/>{__('Change signature')}</a>
            <a id="signatureAdd" href="#" class="btn" {if $item->get("signature")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add signature')}</a> 
           
            <div id="signatureForm" style="display:none">
                  <input id="signatureFile" type="file" name="PartnerPolluter[signature]"/> 
                  <a href="#" id="signatureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="signatureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>         
    </tr>
    
      <tr>
         <td class="label">{__('Picture')}</td>
         <td>           
            <img {if $item->get("picture")}height="128px" width="128px"{/if} style="display:block"  id="pictureImg" {if $item->get("picture")}src='{$item->getPicture()->getUrl()}' alt="{__('Picture')}{else}style="display:none"{/if}"/>                 
                 <a id="pictureDelete" class="btn" href="#" {if !$item->get("picture")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('Delete')}"/>{__('Delete')}</a>
     
           
            <a id="pictureChange" class="btn" href="#" {if !$item->get("picture")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','picture')}" alt="{__('Change')}"/>{__('Change picture')}</a>
            <a id="pictureAdd" href="#" class="btn" {if $item->get("picture")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add picture')}</a> 
           
            <div id="pictureForm" style="display:none">
                  <input id="pictureFile" type="file" name="PartnerPolluter[picture]"/> 
                  <a href="#" id="pictureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="pictureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>         
    </tr>
    
    <tr>
        <td class="label">{__('Default')}</td>
         <td>           
            <input type="checkbox" class="Polluting Checkbox" name="is_default" {if $item->isDefault()}checked=""{/if} />
        </td>
    </tr>
    </table>
{else}
    <span>{__('Installer is invalid.')}</span>
{/if}    

<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".Polluting").click(function() {  $('#Polluting-Save').show(); });    
    
   
    
     {* =================== A C T I O N S ================================ *}
     $('#Polluting-Cancel').click(function(){                           
             return $.ajax2({                               
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPollutingCompany'])}",
                              errorTarget: ".Polluting-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#Polluting-Save').click(function(){                             
            var  params= {            
                                Polluting: {   
                                   id: "{$item->get('id')}",
                                   country : $(".Polluting[name=country] option:selected").val(),
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".Polluting.Input").each(function() {  params.Polluting[this.name]=$(this).val();  });  // Get foreign key               
          $(".Polluting.Checkbox:checked").each(function() {  params.Polluting[this.name]='YES';  });  // Get foreign key
          return $.ajax2({ data : params,                            
                           errorTarget: ".Polluting-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",         
                           url: "{url_to('app_domoprime_ajax',['action'=>'SavePolluting'])}",
                           target: "#actions" }); 
        });  
    

        $("#logoUpload").click(function () { 
             return $.ajax2({ data : { PartnerPolluter : { id: "{$item->get('id')}", token : "{mfForm::getToken('PartnerPolluterLogoForm')}" } },
                              files: "#logoFile",
                              url: "{url_to('partners_polluter_ajax',['action'=>'SaveLogo'])}",
                              errorTarget: ".Polluting-errors",
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
                  return $.ajax2({ data : { PartnerPolluter:"{$item->get('id')}" }, 
                                   url: "{url_to('partners_polluter_ajax',['action'=>'DeleteLogo'])}",
                                   errorTarget: ".Polluting-errors",
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
         
         
         
         $("#signatureUpload").click(function () { 
             return $.ajax2({ data : { PartnerPolluter : { id: "{$item->get('id')}", token : "{mfForm::getToken('PartnerPolluterSignatureForm')}" } },
                              files: "#signatureFile",
                              url: "{url_to('partners_polluter_ajax',['action'=>'SaveSignature'])}",
                              errorTarget: ".Polluting-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",         
                              success: function (response)
                                       {
                                            $("#signatureFile").val('');     
                                            if (response.signature)
                                            { 
                                                $("#signatureImg").attr('src',"{$item->getSignature()->getURLPath()}"+response.signature+"?"+$.now()); 
                                                $("#signatureImg").attr({ height:"128px",width:"128px" });
                                                $("#signatureFilename").html("["+response.signature+"]");
                                                $("#signatureForm,#signatureAdd").hide(); 
                                                $("#signatureChange,#signatureDelete,#signatureFilename,#signatureImg").show();
                                            }
                                       }
                            });
         });
       
          $('#signatureChange,#signatureAdd').click(function(){ 
              $("#signatureForm").show();
              $(this).hide();
         });
         
          $('#signatureDelete').click(function(){ 
                  if (!confirm('{__("Picture  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { PartnerPolluter:"{$item->get('id')}" }, 
                                   url: "{url_to('partners_polluter_ajax',['action'=>'DeleteSignature'])}",
                                   errorTarget: ".Polluting-errors",
                                   loading: "#tab-site-dashboard-x-settings-loading", 
                                   success :function(response) {
                                                    if (response.action=='DeleteSignature'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#signatureAdd").show();
                                                        $("#signatureChange,#signatureFilename,#signatureImg,#signatureDelete,#signatureForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
         
         
          $("#pictureUpload").click(function () { 
             return $.ajax2({ data : { PartnerPolluter : { id: "{$item->get('id')}", token : "{mfForm::getToken('PartnerPolluterPictureForm')}" } },
                              files: "#pictureFile",
                              url: "{url_to('partners_polluter_ajax',['action'=>'SavePicture'])}",
                              errorTarget: ".Polluting-errors",
                             loading: "#tab-site-dashboard-x-settings-loading",         
                              success: function (response)
                                       {
                                            $("#pictureFile").val('');     
                                            if (response.picture)
                                            { 
                                                $("#pictureImg").attr('src',"{$item->getPicture()->getURLPath()}"+response.picture+"?"+$.now()); 
                                                $("#pictureImg").attr({ height:"128px",width:"128px" });
                                                $("#pictureFilename").html("["+response.picture+"]");
                                                $("#pictureForm,#pictureAdd").hide(); 
                                                $("#pictureChange,#pictureDelete,#pictureFilename,#pictureImg").show();
                                            }
                                       }
                            });
         });
       
          $('#pictureChange,#pictureAdd').click(function(){ 
              $("#pictureForm").show();
              $(this).hide();
         });
         
          $('#pictureDelete').click(function(){ 
                  if (!confirm('{__("Picture  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { PartnerPolluter:"{$item->get('id')}" }, 
                                   url: "{url_to('partners_polluter_ajax',['action'=>'DeletePicture'])}",
                                   errorTarget: ".Polluting-errors",
                                   loading: "#tab-site-dashboard-x-settings-loading", 
                                   success :function(response) {
                                                    if (response.action=='DeletePicture'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#pictureAdd").show();
                                                        $("#pictureChange,#pictureFilename,#pictureImg,#pictureDelete,#pictureForm").hide();
                                                    }
                                           }
                  } ); 
         });
</script>
