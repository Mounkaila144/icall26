{component name="/site/sublink"} 
<div>{messages class="site-errors"}</div>
<h3>{__("View company")}</h3>
<div>
    <a class="btn" href="#" id="Company-Save" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a class="btn" href="#" id="Company-Cancel"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{if $item->isLoaded()}
<fieldset>
    <h3>{__('Company')}</h3>
    <table class="tab-form" id="Company-form" cellpadding="0" table-column="2" cellspacing="0">
      <tr>
          <td class="label">{__("Name")}</td>
         <td> 
             <div  {if $form.name->hasError()}class="error_form"{/if}>{$form.name->getError()}</div> 
             <input type="text" class="Company input-text" name="name" value="{$item->get('name')|escape}" size="30"/>{if $form->name->getOption('required')}*{/if}
              {__("Type")}
             {html_options name="type" class="Company Select" options=$form->type->getChoices() selected=$item->get('type')} 
         </td>
     </tr>
     <tr>
         <td class="label">{__("Commercial name")}</td>
         <td>
            <div {if $form.commercial->hasError()}class="error_form"{/if}>{$form.commercial->getError()}</div>  
            <input type="text" class="Company input-text" name="commercial" value="{$item->get('commercial')|escape}" size="30"/>{if $form->commercial->getOption('required')}*{/if}
         </td>
     </tr>
      <tr>
         <td class="label">{__("Web")}</td>
         <td> 
             <div {if $form.web->hasError()}class="error_form"{/if}>{$form.web->getError()}</div> 
             <input type="text" class="Company input-text" name="web" value="{$item->get('web')|escape}" size="30"/>{if $form->web->getOption('required')}*{/if}
         </td>
     </tr>
     <tr>
         <td class="label">{__("Email")}</td>
         <td> 
             <div {if $form.email->hasError()}class="error_form"{/if}>{$form.email->getError()}</div> 
             <input type="text" class="Company input-text" name="email" value="{$item->get('email')|escape}" size="30"/>{if $form->email->getOption('required')}*{/if}
         </td>             
     </tr>  
      <tr>
         <td class="label">{__("Address1")}</td>
         <td> 
             <div {if $form.address1->hasError()}class="error_form"{/if}>{$form.address1->getError()}</div> 
             <input type="text" class="Company input-text" name="address1" value="{$item->get('address1')|escape}" size="30" />{if $form->address1->getOption('required')}*{/if}
         </td>             
     </tr>   
  {*   <tr>
         <td class="label">{__("address2")}</td>
         <td> 
             <div {if $form.address2->hasError()}class="error_form"{/if}>{$form.address2->getError()}</div> 
             <input type="text" class="Company input-text" name="address2" value="{$item->get('address2')|escape}" size="30" />{if $form->getValidator('address2')->getOption('required')}*{/if}
         </td>             
     </tr> *}  
     <tr>
         <td class="label">{format_postal_code()}</td>
         <td> 
             <div {if $form.postcode->hasError()}class="error_form"{/if}>{$form.postcode->getError()}</div> 
             <input type="text" class="Company input-text" name="postcode" value="{$item->get('postcode')|escape}" size="10" />{if $form->postcode->getOption('required')}*{/if}
         </td>             
     </tr>    
     <tr>
         <td class="label">{__("City")}</td>
         <td> 
             <div {if $form.city->hasError()}class="error_form"{/if}>{$form.city->getError()}</div> 
             <input type="text" class="Company input-text" name="city" value="{$item->get('city')|escape}" size="30"/>{if $form->city->getOption('required')}*{/if}
             <div id="cities_container"></div>
         </td>             
     </tr>  
     <tr>
         <td class="label">{__("Country")}</td>
         <td> 
             <div {if $form.country->hasError()}class="error_form"{/if}>{$form.country->getError()}</div>                 
             {select_country name="country" class="Company input-text" selected=$item->get('country')}
         </td> 
     </tr>    
    
     <tr>
         <td class="label">{__('Picture')}</td>
         <td>
           {* <span id="pictureFilename">{if $item->get("picture")}[{$item->get('picture')}]{/if}</span>*}
            <img height="128" width="128" {if !$item->hasPicture()}style="display:none;"{/if} id="pictureImg" {if $item->get("picture")}src='{$item->getPicture()->getUrl()}'{/if}/>                 
            <a id="pictureDelete" class="btn" href="javascript:void(0);" {if !$item->hasPicture()}style="display:none"{/if}><i class="fa fa-remove" style="margin-right:10px;"></i>{__('Delete')}</a>
            <a id="pictureChange" class="btn" href="javascript:void(0);" {if !$item->hasPicture()}style="display:none"{/if}><i class="fa fa-edit" style="margin-right:10px;"></i>{__('Change picture')}</a>
            <a id="pictureAdd" href="javascript:void(0);" class="btn" {if $item->hasPicture()}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add picture')}</a> 
           
            <div id="pictureForm" style="display:none">
                  <input id="pictureFile" type="file" name="CustomerMeetingCompany[picture]"/> 
                  <a href="javascript:void(0);" id="pictureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                  <img id="pictureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"/> 
            </div>    
        </td>
    </tr>
   
  
     <tr>
         <td class="label">{__('Header')}</td>
         <td>
            <span id="headerFilename">{if $item->hasHeader()}[{$item->get('header')}]{/if}</span>
            <img height="128" width="128" id="headerImg" {if !$item->hasHeader()}style="display:none;"{/if} {if $item->get("header")}src="{$item->getHeader()->getUrl()}"{/if}/>                 
            <a id="headerDelete" href="javascript:void(0);" {if !$item->hasHeader()}style="display:none"{/if}><i class="fa fa-remove" style="margin-right:10px;"></i></a>        
            <a id="headerChange" class="btn" href="#" {if !$item->hasHeader()}style="display:none"{/if}><i class="fa fa-edit" style="margin-right:10px;"></i>{__('Change header')}</a>
            <a id="headerAdd" href="javascript:void(0);" class="btn" {if $item->hasHeader()}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add header')}</a>                  
            <div id="headerForm" style="display:none">
                  <input id="headerFile" type="file" name="CustomerMeetingCompany[header]"/> 
                  <a href="javascript:void(0);" id="headerUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="headerLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"/> 
            </div>    
        </td>
    </tr> 
   
    
     <tr>
         <td class="label">{__('Footer')}
         </td>
         <td>
            <span id="footerFilename">{if $item->hasFooter()}[{$item->get('footer')}]{/if}</span> 
            <img height="128" width="128" {if !$item->hasFooter()}style="display:none;"{/if} id="footerImg" {if $item->hasFooter()}src="{$item->getFooter()->getUrl()}"{/if}/>  
             
            <a id="footerDelete" class="btn" href="javascript:void(0);" {if !$item->hasFooter()}style="display:none"{/if}><i class="fa fa-remove" style="margin-right:10px;"></i></a>
            <a id="footerChange" class="btn" href="javascript:void(0);" {if !$item->hasFooter()}style="display:none"{/if}><i class="fa fa-edit" style="margin-right:10px;"></i>{__('Change footer')}</a>          
            <a id="footerAdd" href="javascript:void(0);" {if $item->hasFooter()}style="display:none"{/if}  class="btn"><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add footer')}</a>            
            <div id="footerForm" style="display:none">           
                  <input id="footerFile" type="file" name="CustomerMeetingCompany[footer]"/>                   
                  <a href="javascript:void(0);" id="footerUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="footerLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"/> 
            </div>    
        </td>
    </tr>
    
    
     <tr>
         <td class="label">{__('Stamp')}</td>
         <td>                      
            <img height="128" width="128" {if !$item->hasStamp()}style="display:none;"{/if}  id="stampImg" {if $item->hasStamp()}src='{$item->getStamp()->getUrl()}'{/if}/>                 
            <a id="stampDelete" class="btn" href="javascript:void(0);" {if !$item->hasStamp()}style="display:none"{/if}><i class="fa fa-remove" style="margin-right:10px;"></i>{__('Delete')}</a>                
            <a id="stampChange" class="btn" href="#" {if !$item->hasStamp()}style="display:none"{/if}><i class="fa fa-edit" style="margin-right:10px;"></i>{__('Change stamp')}</a>
            <a id="stampAdd" href="javascript:void(0);" class="btn" {if $item->hasStamp()}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add stamp')}</a>            
            <div id="stampForm" style="display:none">
                  <input id="stampFile" type="file" name="CustomerMeetingCompany[stamp]"/> 
                  <a href="javascript:void(0);" id="stampUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="stampLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>
    </tr>
   
        
     <tr>
         <td class="label">{__('Signature')}</td>
         <td>                      
            <img height="128" width="128" {if !$item->hasSignature()}style="display:none;"{/if}  id="signatureImg" {if $item->get("signature")}src='{$item->getSignature()->getUrl()}'{/if}/>                 
                 <a id="signatureDelete" class="btn" href="#" {if !$item->get("signature")}style="display:none"{/if}><i class="fa fa-remove" style="margin-right:10px;"></i>{__('Delete')}</a>
     
           
                 <a id="signatureChange" class="btn" href="javascript:void(0);" {if !$item->get("signature")}style="display:none"{/if}><i class="fa fa-edit" style="margin-right:10px;"></i>{__('Change signature')}</a>
            <a id="signatureAdd" href="javascript:void(0);" class="btn" {if $item->get("signature")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{__('Add signature')}</a> 
           
            <div id="signatureForm" style="display:none">
                  <input id="signatureFile" type="file" name="CustomerMeetingCompany[signature]"/> 
                  <a href="javascript:void(0);" id="signatureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('Upload')}"></a>
                  <img id="signatureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>
    </tr>
   
    
     <tr>
         <td class="label">{__("phone")}</td>
         <td> 
             <div>{$form.phone->getError()}</div> 
             <input type="text" class="Company input-text" name="phone" value="{$item->get('phone')|escape}" size="30"/>{if $form->phone->getOption('required')}*{/if}
         </td>             
     </tr>  
     <tr>
         <td class="label">{__("mobile")}</td>
         <td> 
             <div {if $form.mobile->hasError()}class="error_form"{/if}>{$form.mobile->getError()}</div> 
             <input type="text" class="Company input-text" name="mobile" value="{$item->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
         </td>             
     </tr>           
     <tr>
         <td class="label">{__("fax")}</td>
         <td> 
             <div>{$form.fax->getError()}</div> 
             <input type="text" class="Company input-text" name="fax" value="{$item->get('fax')|escape}" size="30" />{if $form->fax->getOption('required')}*{/if}
         </td>             
     </tr>  
  {*    <tr>
         <td class="label">{__("GPS coordinates")}</td>
         <td> 
             <div {if $form.coordinates->hasError()}class="error_form"{/if}{$form.coordinates->getError()}</div> 
             <input type="text" class="Company input-text" name="coordinates" value="{$item->get('coordinates')|escape}" size="30"/>{if $form->coordinates->getOption('required')}*{/if}
         </td>             
     </tr>   *}  
     <tr>
         <td class="label">{__("NAF")}
         </td>
         <td>
             <div {if $form.ape->hasError()}class="error_form"{/if}>{$form.ape->getError()}</div> 
            <input type="text" class="Company input-text" name="ape" value="{$item->get('ape')|escape}" size="30"/>{if $form->ape->getOption('required')}*{/if} 
         </td>
     </tr>
      <tr>
         <td class="label">{__("Siret")}
         </td>
         <td>
             <div {if $form.siret->hasError()}class="error_form"{/if}>{$form.siret->getError()}</div> 
            <input type="text" class="Company input-text" name="siret" value="{$item->get('siret')|escape}" size="30"/>{if $form->siret->getOption('required')}*{/if} 
         </td>
     </tr>
       <tr>
         <td class="label">{__("RCS")}
         </td>
         <td>
             <div {if $form.rcs->hasError()}class="error_form"{/if}>{$form.rcs->getError()}</div> 
            <input type="text" class="Company input-text" name="rcs" value="{$item->get('rcs')|escape}" size="30"/>{if $form->rcs->getOption('required')}*{/if} 
         </td>
     </tr>
      <tr>
         <td class="label">{__("N°TVA")}
         </td>
         <td>
             <div {if $form.tva->hasError()}class="error_form"{/if}>{$form.tva->getError()}</div> 
            <input type="text" class="Company input-text" name="tva" value="{$item->get('tva')|escape}" size="30"/>{if $form->tva->getOption('required')}*{/if} 
         </td>
     </tr>
      <tr>
         <td class="label">{__("RGE")}
         </td>
         <td>
             <div {if $form.rge->hasError()}class="error_form"{/if}>{$form.rge->getError()}</div> 
            <input type="text" class="Company input-text" name="rge" value="{$item->get('rge')|escape}" size="30"/>{if $form->rge->getOption('required')}*{/if} 
         </td>
      </tr>
         <tr>
         <td class="label">{__("Capital")}
         </td>
         <td>
             <div {if $form.capital->hasError()}class="error_form"{/if}>{$form.capital->getError()}</div> 
            <input type="text" class="Company input-text" name="capital" value="{$item->get('capital')|escape}" size="30"/>{if $form->capital->getOption('required')}*{/if} 
         </td>
     </tr>
        <tr>
         <td class="label">{__("Comments")}
         </td>
         <td>
             <div {if $form.comments->hasError()}class="error_form"{/if}>{$form.comments->getError()}</div> 
            <textarea rows="2" cols="80" class="Company input-text" name="comments">{$item->get('comments')|escape}</textarea>{if $form->comments->getOption('required')}*{/if} 
         </td>
     </tr>
   {*  {foreach $form->getRegistrationValidators() as $name=>$validator}                                             
           <tr id="{$name}" {if $name=="tva" && $form->hasValidator('autoentreprise') && $item->isAutoEnterprise()}style="display:none"{/if} class="registration">
               <td class="label">
                    {if $validator->title}{__($validator->title)}{elseif $name=="commercial"}{__("commercial name")}{else}{__($name)}{/if}   
               </td>   
               <td>
                   {if $name=='autoentreprise'}            
                           <input type="checkbox" name="autoentreprise" {if $item->isAutoEnterprise()}checked=""{/if}/>                                                                                                            
                   {else}     
                           <div>{$form[$name]->getError()}</div>
                           <input type="text" class="Company input-text" name="{$name}" value="{$item->get($name)|escape}"/>   
                           {if $validator->getOption("required")}*{/if}
                   {/if}           
               </td>
           </tr>             
      {/foreach}     *}
</table>
</fieldset>
<fieldset>
    <h3>{__('Main contact')}</h3>
      <table class="tab-form"  cellpadding="0" table-column="2" cellspacing="0">
             <tr>
     <td class="label">{__("Title")}</td>
     <td> 
         <div>{$form.gender->getError()}</div>                
         {foreach $form->gender->getOption("choices") as $name=>$gender}
                <input type="radio" class="Company" name="gender" value="{$name}" {if $item->get('gender')==$name}checked="checked"{/if}/>
                <span>{format_gender($gender,1,true)|capitalize}</span>
         {/foreach}{if $form->gender->getOption('required')}*{/if}
     </td>
 </tr>
      <tr>
          <td class="label">{__("Firstname")}</td>
         <td> 
             <div  {if $form.firstname->hasError()}class="error_form"{/if}>{$form.firstname->getError()}</div> 
             <input type="text" class="Company input-text" name="firstname" value="{$item->get('firstname')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
         </td>
     </tr>
      <tr>
          <td class="label">{__("Lastname")}</td>
         <td> 
             <div  {if $form.lastname->hasError()}class="error_form"{/if}>{$form.lastname->getError()}</div> 
             <input type="text" class="Company input-text" name="lastname" value="{$item->get('lastname')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
         </td>
     </tr>
      <tr>
          <td class="label">{__("Function")}</td>
         <td> 
             <div  {if $form.function->hasError()}class="error_form"{/if}>{$form.function->getError()}</div> 
             <input type="text" class="Company input-text" name="function" value="{$item->get('function')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
         </td>
     </tr>
      </table>
</fieldset>
<script type="text/javascript">

        $(document).off("click", "#cities"); // Remove old events
         
        $('#Company-Cancel').click(function(){ return $.ajax2({ url:"{url_to('customers_meeting_ajax',['action'=>'ListPartialCompany'])}",
                                                                loading: "#tab-site-dashboard-x-settings-loading",
                                                                  target: "#actions" 
                                                                            }); 
        });
         
        $('#Company-Save').click(function(){ 
                  var params= { CustomerMeetingCompany: {   
                                        id : '{$item->get('id')}',
                                        country : $(".Company[name=country] option:selected").val(), 
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.Company,textarea.Company").each(function() { params.CustomerMeetingCompany[this.name]=$(this).val(); });                     
                  $("input.Company[type=radio]:checked").each(function() { params.CustomerMeetingCompany[this.name]=$(this).val(); }); 
                  if ($("[name=autoentreprise]").length)
                        params.Company.autoentreprise= $("[name=autoentreprise]").is(":checked")?"YES":"NO";  
                //     alert("params="+params.toSource()); return ;
                  return $.ajax2({ data : params,
                                   files: ".files",
                                   url: "{url_to('customers_meeting_ajax',['action'=>'SaveCompany'])}",
                                   loading: "#tab-site-dashboard-x-settings-loading",
                                   errorTarget: ".site-errors",
                                     target: "#actions" }); 
         });
             
             
        $(".Company").click(function() { $('#Company-Save').show(); });
                                          
         $(".Company[name=postcode]").keyup(function() { 
             if ($(this).val().length > 2)
             {                         
                return $.ajax2({ data: { city: {
                         country:$(".Company[name=country]").val(),
                         postcode: $(this).val()
                      } }, 
                      url: "{url_to('utils_city',[],'frontend')}",
                      success: function(response) {               
                                     $("#cities_container").show();
                                     if (response.length)
                                     {    
                                         $("#cities_container").html('<select id="cities"></select>');  
                                         $.each(response,function () {
                                             $("#cities").append('<option value="'+this.postalcode+'|'+this.city+'">'+this.postalcode+' '+this.city+'</option>');
                                         });
                                     }
                                     else
                                         $("#cities_container").html("{__('no city exists')}");  
                              }
                      } ); 
             }   
             else
             {
                 $(".Company[name=city]").val('');
                 $("#cities_container").html('');  
             }    
         });
         
       $(document).on("click", "#cities", function() {            
             city_postcode=$("#cities").val().split('|');
             $(".Company[name=postcode]").val(city_postcode[0]);
             $(".Company[name=city]").val(city_postcode[1]);
         });
         
       {* =========================== PICTURE ============================================================================= *}  
          $("#pictureUpload").click(function () { 
             return $.ajax2({ data : { CustomerMeetingCompany : { id: "{$item->get('id')}", token : "{mfForm::getToken('CustomerMeetingCompanyPictureForm')}" } },
                              files: "#pictureFile",
                              url: "{url_to('customers_meeting_ajax',['action'=>'SavePictureCompany'])}",
                              loading: "#pictureLoading",
                              success: function (response)
                                       {
                                            $("#pictureFile").val('');     
                                            if (response.picture)
                                            { 
                                                $("#pictureImg").attr('src',"{$item->getPicture()->getURLPath()}"+response.picture+"?"+$.now()); 
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
                  return $.ajax2({ data : { CustomerMeetingCompany:'{$item->get("id")}' }, 
                                   url: "{url_to('customers_meeting_ajax',['action'=>'DeletePictureCompany'])}",
                                   success :function(response) {
                                                    if (response.action=='DeletePicture'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#pictureAdd").show();
                                                        $("#pictureChange,#pictureFilename,#pictureImg,#pictureDelete,#pictureForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
               {* =========================== HEADER ============================================================================= *}  
          $("#headerUpload").click(function () { 
             return $.ajax2({ data : { CustomerMeetingCompany : { id: "{$item->get('id')}", token : "{mfForm::getToken('CustomerMeetingCompanyHeaderForm')}" } },
                              files: "#headerFile",
                              url: "{url_to('customers_meeting_ajax',['action'=>'SaveHeaderCompany'])}",
                              loading: "#headerLoading",
                              success: function (response)
                                       {
                                            $("#headerFile").val('');     
                                            if (response.header)
                                            { 
                                                $("#headerImg").attr('src',"{$item->getHeader()->getURLPath()}"+response.header+"?"+$.now()); 
                                                $("#headerFilename").html("["+response.header+"]");
                                                $("#headerForm,#headerAdd").hide(); 
                                                $("#headerChange,#headerDelete,#headerFilename,#headerImg").show();
                                            }
                                       }
                            });
         });
       
          $('#headerChange,#headerAdd').click(function(){ 
              $("#headerForm").show();
              $(this).hide();
              $("#headerFile").focus();
         });
         
         $('#headerDelete').click(function(){ 
                  if (!confirm('{__("Header  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { CustomerMeetingCompany:'{$item->get("id")}' }, 
                                   url: "{url_to('customers_meeting_ajax',['action'=>'DeleteHeaderCompany'])}",
                                   success :function(response) {
                                                    if (response.action=='DeleteHeader'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#headerAdd").show();
                                                        $("#headerChange,#headerFilename,#headerImg,#headerDelete,#headerForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
               {* =========================== FOOTER ============================================================================= *}  
          $("#footerUpload").click(function () { 
             return $.ajax2({ data : { CustomerMeetingCompany : { id: "{$item->get('id')}", token : "{mfForm::getToken('CompanyFooterForm')}" } },
                              files: "#footerFile",
                              url: "{url_to('customers_meeting_ajax',['action'=>'SaveFooterCompany'])}",
                              loading: "#footerLoading",
                              success: function (response)
                                       {
                                            $("#footerFile").val('');     
                                            if (response.footer)
                                            { 
                                                $("#footerImg").attr('src',"{$item->getFooter()->getURLPath()}"+response.footer+"?"+$.now()); 
                                                $("#footerFilename").html("["+response.footer+"]");
                                                $("#footerForm,#footerAdd").hide(); 
                                                $("#footerChange,#footerDelete,#footerFilename,#footerImg").show();
                                            }
                                       }
                            });
         });
       
          $('#footerChange,#footerAdd').click(function(){ 
              $("#footerForm").show();
              $(this).hide();
         });
         
         $('#footerDelete').click(function(){ 
                  if (!confirm('{__("footer  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { CustomerMeetingCompany:'{$item->get("id")}' }, 
                                   url: "{url_to('customers_meeting_ajax',['action'=>'DeleteFooterCompany'])}",
                                   success :function(response) {
                                                    if (response.action=='DeleteFooter'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#footerAdd").show();
                                                        $("#footerChange,#footerFilename,#footerImg,#footerDelete,#footerForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
         
          {* =========================== STAMP ============================================================================= *}  
          $("#stampUpload").click(function () { 
             return $.ajax2({ data : { CustomerMeetingCompany : { id: "{$item->get('id')}", token : "{mfForm::getToken('CustomerMeetingCompanyStampForm')}" } },
                              files: "#stampFile",
                              url: "{url_to('customers_meeting_ajax',['action'=>'SaveStampCompany'])}",
                              loading: "#stampLoading",
                              success: function (response)
                                       {
                                            $("#stampFile").val('');     
                                            if (response.stamp)
                                            { 
                                                $("#stampImg").attr('src',"{$item->getStamp()->getURLPath()}"+response.stamp+"?"+$.now()); 
                                                $("#stampFilename").html("["+response.stamp+"]");
                                                $("#stampForm,#stampAdd").hide(); 
                                                $("#stampChange,#stampDelete,#stampFilename,#stampImg").show();
                                            }
                                       }
                            });
         });
       
          $('#stampChange,#stampAdd').click(function(){ 
              $("#stampForm").show();
              $(this).hide();
         });
         
          $('#stampDelete').click(function(){ 
                  if (!confirm('{__("Stamp  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { CustomerMeetingCompany:'{$item->get("id")}' }, 
                                   url: "{url_to('customers_meeting_ajax',['action'=>'DeleteStampCompany'])}",
                                   success :function(response) {
                                                    if (response.action=='DeleteStamp'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#stampAdd").show();
                                                        $("#stampChange,#stampFilename,#stampImg,#stampDelete,#stampForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
         
            
          {* =========================== SIGNATURE ============================================================================= *}  
          $("#signatureUpload").click(function () { 
             return $.ajax2({ data : { CustomerMeetingCompany : { id: "{$item->get('id')}", token : "{mfForm::getToken('CustomerMeetingCompanySignatureForm')}" } },
                              files: "#signatureFile",
                              url: "{url_to('customers_meeting_ajax',['action'=>'SaveSignatureCompany'])}",
                              loading: "#signatureLoading",
                              success: function (response)
                                       {
                                            $("#signatureFile").val('');     
                                            if (response.signature)
                                            { 
                                                $("#signatureImg").attr('src',"{$item->getSignature()->getURLPath()}"+response.signature+"?"+$.now()); 
                                                $("#signatureFilename").html("["+response.stamp+"]");
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
                  if (!confirm('{__("Signature  will be deleted. Confirm ?")}')) return false; 
                  return $.ajax2({ data : { CustomerMeetingCompany:'{$item->get("id")}' }, 
                                   url: "{url_to('customers_meeting_ajax',['action'=>'DeleteSignatureCompany'])}",
                                   success :function(response) {
                                                    if (response.action=='DeleteSignature'&&response.id=="{$item->get('id')}")
                                                    {
                                                        $("#signatureAdd").show();
                                                        $("#signatureChange,#signatureFilename,#signatureImg,#signatureDelete,#signatureForm").hide();
                                                    }
                                           }
                  } ); 
         });
       {* ===================================================================================================================== *}  
        $("[name=autoentreprise]").click(function() { 
           if ($(this).is(":checked"))
               $("#tva").hide();
           else
               $("#tva").show(); 
        });        
         
      
</script>

{else}
    {__('Company is invalid.')}
{/if}    