{component name="/site/sublink"} 
{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("edit company")|capitalize}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table id="{$site->getSiteID()}-company-form" cellpadding="0" cellspacing="0">
      <tr>
         <td>{__("name")}</td>
         <td> 
             <div>{$form.name->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="name" value="{$site_company->get('name')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
         </td>
     </tr>
     <tr>
         <td>{__("commercial name")}</td>
         <td>
            <div>{$form.commercial->getError()}</div>  
            <input type="text" class="{$site->getSiteID()}-company" name="commercial" value="{$site_company->get('commercial')|escape}" size="30"/>{if $form->getValidator('commercial')->getOption('required')}*{/if}
         </td>
     </tr>
      <tr>
         <td>{__("web")}</td>
         <td> 
             <div>{$form.web->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="web" value="{$site_company->get('web')|escape}" size="30"/>{if $form->getValidator('web')->getOption('required')}*{/if}
         </td>
     </tr>
     <tr>
         <td>{__("email")}</td>
         <td> 
             <div>{$form.email->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="email" value="{$site_company->get('email')|escape}" size="30"/>{if $form->getValidator('email')->getOption('required')}*{/if}
         </td>             
     </tr>  
      <tr>
         <td>{__("address1")}</td>
         <td> 
             <div>{$form.address1->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="address1" value="{$site_company->get('address1')|escape}" size="30" />{if $form->getValidator('address1')->getOption('required')}*{/if}
         </td>             
     </tr>   
     <tr>
         <td>{__("address2")}</td>
         <td> 
             <div>{$form.address2->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="address2" value="{$site_company->get('address2')|escape}" size="30" />{if $form->getValidator('address2')->getOption('required')}*{/if}
         </td>             
     </tr>  
     <tr>
         <td>{format_postal_code()}</td>
         <td> 
             <div>{$form.postcode->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="postcode" value="{$site_company->get('postcode')|escape}" size="10" />{if $form->getValidator('postcode')->getOption('required')}*{/if}
         </td>             
     </tr>    
     <tr>
         <td>{__("city")}</td>
         <td> 
             <div>{$form.city->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="city" value="{$site_company->get('city')|escape}" size="30"/>{if $form->getValidator('city')->getOption('required')}*{/if}
             <div id="cities_container"></div>
         </td>             
     </tr>  
     <tr>
         <td>{__("country")}</td>
         <td> 
             <div>{$form.country->getError()}</div>                 
             {select_country name="country" class="`$site->getSiteID()`-company" selected=$site_company->get('country')}
         </td> 
     </tr>    
     {if $site_company->isLoaded()}
     <tr>
         <td>{__('picture')}</td>
         <td>
            <span id="pictureFilename">{if $site_company->get("picture")}[{$site_company->get('picture')}]{/if}</span>
            <img height="128" width="128" id="pictureImg" {if $site_company->get("picture")}src='{$site_company->getPicture()->getUrl()}' alt="{__('my picture')}{else}style="display:none"{/if}"/>                 
            <a id="pictureDelete" href="#" {if !$site_company->get("picture")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('delete')}"/></a>
         </td>
     </tr>             
     <tr>
        <td></td>
        <td>
            <div>
                 <a id="pictureChange" href="#" {if !$site_company->get("picture")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','picture')}" alt="{__('change')}"/>{__('change picture')|capitalize}</a>
                 <a id="pictureAdd" href="#" {if $site_company->get("picture")}style="display:none"{/if}><img  src="{url('/icons/add.gif','picture')}" alt="{__('edit')}"/>{__('add picture')|capitalize}</a> 
            </div>
            <div id="pictureForm" style="display:none">
                  <input id="pictureFile" type="file" name="Company[picture]"/> 
                  <a href="#" id="pictureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                  <img id="pictureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>
    </tr>
    {else}
      <tr>
         <td>{__('picture')}</td>        
        <td>           
            <div id="pictureForm">
                  <input id="pictureFile" type="file" class="files" name="Company[picture]"/> 
            </div>    
        </td>
    </tr>  
    {/if}    
    {if $site_company->isLoaded()}
     <tr>
         <td>{__('header')}</td>
         <td>
            <span id="headerFilename">{if $site_company->get("header")}[{$site_company->get('header')}]{/if}</span>
            <img height="128" width="128" id="headerImg" {if $site_company->get("header")}src='{$site_company->getHeader()->getUrl()}' alt="{__('my header')}{else}style="display:none"{/if}"/>                 
            <a id="headerDelete" href="#" {if !$site_company->get("header")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('delete')}"/></a>
         </td>
     </tr>             
     <tr>
        <td></td>
        <td>
            <div>
                 <a id="headerChange" href="#" {if !$site_company->get("header")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','picture')}" alt="{__('change')}"/>{__('change header')|capitalize}</a>
                 <a id="headerAdd" href="#" {if $site_company->get("header")}style="display:none"{/if}><img  src="{url('/icons/add.gif','picture')}" alt="{__('edit')}"/>{__('add header')|capitalize}</a> 
            </div>
            <div id="headerForm" style="display:none">
                  <input id="headerFile" type="file" name="Company[header]"/> 
                  <a href="#" id="headerUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                  <img id="headerLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>
    </tr>
    {else}
      <tr>
         <td>{__('header')}</td>        
        <td>           
            <div id="headerForm">
                  <input id="headerFile" type="file" class="files" name="Company[header]"/> 
            </div>    
        </td>
    </tr>  
    {/if}
     {if $site_company->isLoaded()}
     <tr>
         <td>{__('footer')}</td>
         <td>
            <span id="footerFilename">{if $site_company->get("footer")}[{$site_company->get('footer')}]{/if}</span>
            <img height="128" width="128" id="footerImg" {if $site_company->get("footer")}src='{$site_company->getFooter()->getUrl()}' alt="{__('my footer')}{else}style="display:none"{/if}"/>                 
            <a id="footerDelete" href="#" {if !$site_company->get("footer")}style="display:none"{/if}><img src="{url('/icons/delete.gif','picture')}" alt="{__('delete')}"/></a>
         </td>
     </tr>             
     <tr>
        <td></td>
        <td>
            <div>
                 <a id="footerChange" href="#" {if !$site_company->get("footer")}style="display:none"{/if}><img  src="{url('/icons/edit.gif','picture')}" alt="{__('change')}"/>{__('change footer')|capitalize}</a>
                 <a id="footerAdd" href="#" {if $site_company->get("footer")}style="display:none"{/if}><img  src="{url('/icons/add.gif','picture')}" alt="{__('edit')}"/>{__('add footer')|capitalize}</a> 
            </div>
            <div id="footerForm" style="display:none">
                  <input id="footerFile" type="file" name="Company[footer]"/> 
                  <a href="#" id="footerUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                  <img id="footerLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
            </div>    
        </td>
    </tr>
    {else}
      <tr>
         <td>{__('footer')}</td>        
        <td>           
            <div id="footerForm">
                  <input id="footerFile" type="file" class="files" name="Company[footer]"/> 
            </div>    
        </td>
    </tr>  
    {/if}
     <tr>
         <td>{__("phone")}</td>
         <td> 
             <div>{$form.phone->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="phone" value="{$site_company->get('phone')|escape}" size="30"/>{if $form->phone->getOption('required')}*{/if}
         </td>             
     </tr>  
     <tr>
         <td>{__("mobile")}</td>
         <td> 
             <div>{$form.mobile->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="mobile" value="{$site_company->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
         </td>             
     </tr>           
     <tr>
         <td>{__("fax")}</td>
         <td> 
             <div>{$form.fax->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="fax" value="{$site_company->get('fax')|escape}" size="30" />{if $form->fax->getOption('required')}*{/if}
         </td>             
     </tr>  
      <tr>
         <td>{__("GPS coordinates")}</td>
         <td> 
             <div>{$form.coordinates->getError()}</div> 
             <input type="text" class="{$site->getSiteID()}-company" name="coordinates" value="{$site_company->get('coordinates')|escape}" size="30"/>{if $form->coordinates->getOption('required')}*{/if}
         </td>             
     </tr>       
     {foreach $form->getRegistrationValidators() as $name=>$validator}                                             
           <tr id="{$name}" {if $name=="tva" && $form->hasValidator('autoentreprise') && $site_company->isAutoEnterprise()}style="display:none"{/if} class="registration">
               <td>
                    {if $validator->title}{__($validator->title)}{elseif $name=="commercial"}{__("commercial name")}{else}{__($name)}{/if}   
               </td>   
               <td>
                   {if $name=='autoentreprise'}            
                           <input type="checkbox" name="{$site->getSiteID()}-autoentreprise" {if $site_company->isAutoEnterprise()}checked=""{/if}/>                                                                                                            
                   {else}     
                           <div>{$form[$name]->getError()}</div>
                           <input type="text" class="{$site->getSiteID()}-company" name="{$name}" value="{$site_company->get($name)|escape}"/>   
                           {if $validator->getOption("required")}*{/if}
                   {/if}           
               </td>
           </tr>             
      {/foreach}     
</table>

<script type="text/javascript">


     {*    $("[name=autoentreprise]").die(); *}
         
        $(document).off("click", "#{$site->getSiteID()}-cities"); // Remove old events
         
        $('#{$site->getSiteID()}-Cancel').click(function(){ return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
                                                                              target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings" 
                                                                            }); 
        });
         
        $('#{$site->getSiteID()}-Save').click(function(){ 
                  var params= { Company: {                                        
                                        country : $(".{$site->getSiteID()}-company[name=country] option:selected").val(), 
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.{$site->getSiteID()}-company").each(function() { params.Company[this.name]=$(this).val(); });  
                  if ($("[name={$site->getSiteID()}-autoentreprise]").length)
                        params.Company.autoentreprise= $("[name=autoentreprise]").is(":checked")?"YES":"NO";  
                //     alert("params="+params.toSource()); return ;
                  return $.ajax2({ data : params,
                                   files: ".files",
                                   url: "{url_to('site_company_ajax',['action'=>'Save'])}",
                                   errorTarget: ".{$site->getSiteID()}-site-errors",
                                   target: "#tab-{$site->getSiteID()}-dashboard-site-x-settings"}); 
         });
             
             
        $(".{$site->getSiteID()}-company").click(function() { $('#{$site->getSiteID()}-Save').show(); });
                                          
         $(".{$site->getSiteID()}-company[name=postcode]").keyup(function() { 
             if ($(this).val().length > 2)
             {                         
                return $.ajax2({ data: { city: {
                         country:$(".{$site->getSiteID()}-company[name=country]").val(),
                         postcode: $(this).val()
                      } }, 
                      url: "{url_to('utils_city',[],'frontend')}",
                      success: function(response) {               
                                     $("#{$site->getSiteID()}-cities_container").show();
                                     if (response.length)
                                     {    
                                         $("#{$site->getSiteID()}-cities_container").html('<select id="{$site->getSiteID()}-cities"></select>');  
                                         $.each(response,function () {
                                             $("#{$site->getSiteID()}-cities").append('<option value="'+this.postalcode+'|'+this.city+'">'+this.postalcode+' '+this.city+'</option>');
                                         });
                                     }
                                     else
                                         $("#{$site->getSiteID()}-cities_container").html("{__('no city exists')}");  
                              }
                      } ); 
             }   
             else
             {
                 $(".{$site->getSiteID()}-company[name=city]").val('');
                 $("#{$site->getSiteID()}-cities_container").html('');  
             }    
         });
         
       $(document).on("click", "#{$site->getSiteID()}-cities", function() {            
             city_postcode=$("#{$site->getSiteID()}-cities").val().split('|');
             $(".{$site->getSiteID()}-company[name=postcode]").val(city_postcode[0]);
             $(".{$site->getSiteID()}-company[name=city]").val(city_postcode[1]);
         });
         
       {* =========================== PICTURE ============================================================================= *}  
          $("#pictureUpload").click(function () { 
             return $.ajax2({ data : { Company : { id: "{$site_company->get('id')}", token : "{mfForm::getToken('CompanyPictureForm')}" } },
                              files: "#pictureFile",
                              url: "{url_to('site_company_ajax',['action'=>'SavePicture'])}",
                              loading: "#pictureLoading",
                              success: function (response)
                                       {
                                            $("#pictureFile").val('');     
                                            if (response.picture)
                                            { 
                                                $("#pictureImg").attr('src',"{$site_company->getPicture()->getURLPath()}"+response.picture+"?"+$.now()); 
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
                  return $.ajax2({ data : { company:'{$site_company->get("id")}' }, 
                                   url: "{url_to('site_company_ajax',['action'=>'DeletePicture'])}",
                                   success :function(response) {
                                                    if (response.action=='deletePicture'&&response.id=="{$site_company->get('id')}")
                                                    {
                                                        $("#pictureAdd").show();
                                                        $("#pictureChange,#pictureFilename,#pictureImg,#pictureDelete,#pictureForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
               {* =========================== HEADER ============================================================================= *}  
          $("#headerUpload").click(function () { 
             return $.ajax2({ data : { Company : { id: "{$site_company->get('id')}", token : "{mfForm::getToken('CompanyHeaderForm')}" } },
                              files: "#headerFile",
                              url: "{url_to('site_company_ajax',['action'=>'SaveHeader'])}",
                              loading: "#headerLoading",
                              success: function (response)
                                       {
                                            $("#headerFile").val('');     
                                            if (response.header)
                                            { 
                                                $("#headerImg").attr('src',"{$site_company->getHeader()->getURLPath()}"+response.header+"?"+$.now()); 
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
                  return $.ajax2({ data : { Company:'{$site_company->get("id")}' }, 
                                   url: "{url_to('site_company_ajax',['action'=>'DeleteHeader'])}",
                                   success :function(response) {
                                                    if (response.action=='deleteHeader'&&response.id=="{$site_company->get('id')}")
                                                    {
                                                        $("#headerAdd").show();
                                                        $("#headerChange,#headerFilename,#headerImg,#headerDelete,#headerForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
               {* =========================== FOOTER ============================================================================= *}  
          $("#footerUpload").click(function () { 
             return $.ajax2({ data : { Company : { id: "{$site_company->get('id')}", token : "{mfForm::getToken('CompanyFooterForm')}" } },
                              files: "#footerFile",
                              url: "{url_to('site_company_ajax',['action'=>'SaveFooter'])}",
                              loading: "#footerLoading",
                              success: function (response)
                                       {
                                            $("#footerFile").val('');     
                                            if (response.footer)
                                            { 
                                                $("#footerImg").attr('src',"{$site_company->getFooter()->getURLPath()}"+response.footer+"?"+$.now()); 
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
                  return $.ajax2({ data : { Company:'{$site_company->get("id")}' }, 
                                   url: "{url_to('site_company_ajax',['action'=>'DeleteFooter'])}",
                                   success :function(response) {
                                                    if (response.action=='deleteFooter'&&response.id=="{$site_company->get('id')}")
                                                    {
                                                        $("#footerAdd").show();
                                                        $("#footerChange,#footerFilename,#footerImg,#footerDelete,#footerForm").hide();
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
         
         $(".{$site->getSiteID()}-company[name=country]").change(function(){          
             return $.ajax2({ data : { Registration : { country: $(this).val(), token : "{mfForm::getToken('CompanyRegistrationForm')}" } },                             
                              url: "{url_to('site_company_ajax',['action'=>'Registration'])}",                             
                              success: function (response)
                                       {   
                                          // alert('Reponse'+response);
                                           $(".{$site->getSiteID()}-registration").remove();
                                           $("#{$site->getSiteID()}-company-form").append(response);
                                       }
                            });
         });
      

</script>
