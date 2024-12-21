{component name="/site/sublink"} 
<div>{messages class="site-errors"}</div>
<h3>{__("edit company")|capitalize}</h3>
<div>
    <a class="btn" href="javascript:void(0);" id="Company-Save" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a class="btn" href="javascript:void(0);" id="Company-Cancel"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<fieldset class="tab-form">
    <legend><h3>{__('Company')}</h3></legend>
        <div class="form-inline Company" id="company-form" >
            <div class="cols">
                <div class="label">{__("Name")}</div>
                <span style="display: inline-block;">
                    <div  {if $form.name->hasError()}class="error_form"{/if}>{$form.name->getError()}</div> 
                    <input type="text" class="Company" name="name" value="{$site_company->get('name')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
                </span>
            </div>
            <div class="cols">
                <div class="label">{__("Commercial name")}</div>
                <span style="display: inline-block;">
                    <div {if $form.commercial->hasError()}class="error_form"{/if}>{$form.commercial->getError()}</div>  
                    <input type="text" class="Company" name="commercial" value="{$site_company->get('commercial')|escape}" size="30"/>{if $form->getValidator('commercial')->getOption('required')}*{/if}
                </span>
            </div>
            <div class="cols">
                <div class="label">{__("Web")}</div>
                <span style="display: inline-block;">
                    <div {if $form.web->hasError()}class="error_form"{/if}>{$form.web->getError()}</div> 
                    <input type="text" class="Company" name="web" value="{$site_company->get('web')|escape}" size="30"/>{if $form->getValidator('web')->getOption('required')}*{/if}
                </span>
            </div>
            <div class="cols">
                <div class="label">{__("Email")}</div>
                <span style="display: inline-block;">
                    <div {if $form.email->hasError()}class="error_form"{/if}>{$form.email->getError()}</div> 
                    <input type="text" class="Company" name="email" value="{$site_company->get('email')|escape}" size="30"/>{if $form->getValidator('email')->getOption('required')}*{/if}
                </span>
            </div>
            <div class="cols">
                <div class="label">{__("Address1")}</div>
                <span style="display: inline-block;">
                    <div {if $form.address1->hasError()}class="error_form"{/if}>{$form.address1->getError()}</div> 
                    <input type="text" class="Company" name="address1" value="{$site_company->get('address1')|escape}" size="30" />{if $form->getValidator('address1')->getOption('required')}*{/if}
                </span>
            </div>
            <div class="cols">
                <div class="label">{format_postal_code()}</div>
                <span style="display: inline-block;">
                    <div {if $form.postcode->hasError()}class="error_form"{/if}>{$form.postcode->getError()}</div> 
                    <input type="text" class="Company" name="postcode" value="{$site_company->get('postcode')|escape}" size="10" />{if $form->getValidator('postcode')->getOption('required')}*{/if}
                </span>
            </div>
            <div class="cols">
                <div class="label">{__("City")}</div>
                <span style="display: inline-block;">
                    <div {if $form.city->hasError()}class="error_form"{/if}>{$form.city->getError()}</div> 
                    <input type="text" class="Company" name="city" value="{$site_company->get('city')|escape}" size="30"/>{if $form->getValidator('city')->getOption('required')}*{/if}
                    <div id="cities_container"></div>
                </span>
            </div>
            <div class="cols">
                <div class="label">{__("Country")}</div>
                <span style="display: inline-block;">
                    <div {if $form.country->hasError()}class="error_form"{/if}>{$form.country->getError()}</div>                 
                    {select_country name="country" class="Company" selected=$site_company->get('country')}
                </span>
            </div>
            {if $site_company->isLoaded()}
                <div class="cols">
                    <div class="label">{__("Picture")}<a href="javascript:void(0);" id="GeneratePictures"><i class="fa fa-cog"></i></a></div>
                    <span style="display: inline-block;">
                        <div class="CompanyBlockFile">
                            <div class="CompanyBlockImg">
                                <img id="pictureImg" class="CompanyImg1" {if $site_company->get("picture")}src='{$site_company->getPicture()->getUrl()}' alt="{__('my picture')}"{else}style="display:none"{/if}/>            
                                <img id="pictureImgThumb" {if $site_company->get("picture")}src='{$site_company->getPicture()->getThumb()->getUrl()}' alt="{__('my picture')}"{else}style="display:none"{/if}/> 
                            </div>
                            <div class="CompanyBlockIcons" >
                                    <a id="pictureDelete" class="" href="javascript:void(0);" {if !$site_company->get("picture")}style="display:none"{/if}><i class="fa fa-trash" aria-hidden="true"></i></a>               
                                    <a id="pictureChange" class="" href="javascript:void(0);" {if !$site_company->get("picture")}style="display:none"{/if}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a id="pictureAdd" href="javascript:void(0);" class="" {if $site_company->get("picture")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i>{*<img  src="{url('/icons/add.gif','picture')}" alt="{__('edit')}"/>*}</a>
                            </div>
                            <div id="pictureForm" style="display:none">
                                  <input id="pictureFile" type="file" name="Company[picture]"/> 
                                  <a href="javascript:void(0);" id="pictureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                                  <img id="pictureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                            </div>                              
                        </div>                                                
                    </span>
                </div>
                {else}
                <div class="cols">
                    <div class="label">{__("Picture")}</div>
                    <span style="display: inline-block;">
                    <div id="pictureForm">
                        <input id="pictureFile" type="file" class="files" name="Company[picture]"/>
                    </div>
                    </span>
                </div>             
            {/if}
            
            {if $site_company->isLoaded()}
                <div class="cols">
                    <div class="label">{__("Header")}</div>
                    <span style="display: inline-block;">
                        <div class="CompanyBlockFile">
                            <div class="CompanyBlockImg">
                                <img class="CompanyImg1" width="" id="headerImg" {if $site_company->get("header")}src='{$site_company->getHeader()->getUrl()}' alt="{__('My header')}"{else}style="display:none"{/if}/>  
                            </div>
                            <div class="CompanyBlockIcons" >
                                <span id="headerFilename">{if $site_company->get("header")}[{$site_company->get('header')}]{/if}</span>
                                <a id="headerDelete" href="javascript:void(0);" {if !$site_company->get("header")}style="display:none"{/if}><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a id="headerChange" href="javascript:void(0);" {if !$site_company->get("header")}style="display:none"{/if}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a id="headerAdd" href="javascript:void(0);" {if $site_company->get("header")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i></a>                             
                            </div>
                            <div id="headerForm" style="display:none">
                                  <input id="headerFile" type="file" name="Company[header]"/> 
                                  <a href="javascript:void(0);" id="headerUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                                  <img id="headerLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                            </div>                                 
                        </div>                                                
                    </span>
                </div>
                {else}
                <div class="cols">
                    <div class="label">{__("Header")}</div>
                    <span style="display: inline-block;">
                        <div id="headerForm">
                             <input id="headerFile" type="file" class="files" name="Company[header]"/> 
                       </div>   
                    </span>
                </div>             
            {/if}
            {if $site_company->isLoaded()}
                <div class="cols">
                    <div class="label">{__("Footer")}</div>
                    <span style="display: inline-block;">
                        <div class="CompanyBlockFile">
                            <div class="CompanyBlockImg">
                                <img class="CompanyImg1" width="" id="footerImg" {if $site_company->get("footer")}src='{$site_company->getFooter()->getUrl()}' alt="{__('my footer')}"{else}style="display:none"{/if}/>    
                            </div>
                            <div class="CompanyBlockIcons" >
                                <span id="footerFilename">{if $site_company->get("footer")}[{$site_company->get('footer')}]{/if}</span>
                                <a id="footerDelete" href="javascript:void(0);" {if !$site_company->get("footer")}style="display:none"{/if}><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a id="footerChange" href="javascript:void(0);" {if !$site_company->get("footer")}style="display:none"{/if}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a id="footerAdd" href="javascript:void(0);" {if $site_company->get("footer")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i></a>
                            </div>
                            <div id="footerForm" style="display:none">
                                  <input id="footerFile" type="file" name="Company[footer]"/> 
                                  <a href="javascript:void(0);" id="footerUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                                  <img id="footerLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                            </div>                               
                        </div>                                                
                    </span>
                </div>
                {else}
                <div class="cols">
                    <div class="label">{__("Footer")}</div>
                    <span style="display: inline-block;">
                        <div id="footerForm">
                              <input id="footerFile" type="file" class="files" name="Company[footer]"/> 
                        </div>  
                    </span>
                </div>             
            {/if}
            {if $site_company->isLoaded()}
                <div class="cols">
                    <div class="label">{__("Stamp")}</div>
                    <span style="display: inline-block;">
                        <div class="CompanyBlockFile">
                            <div class="CompanyBlockImg">
                                <img class="CompanyImg1" width=""  id="stampImg" {if $site_company->get("stamp")}src='{$site_company->getStamp()->getUrl()}' alt="{__('Stamp')}"{else}style="display:none"{/if}/>     
                            </div>
                            <div class="CompanyBlockIcons" >
                                <span id="footerFilename">{if $site_company->get("footer")}[{$site_company->get('footer')}]{/if}</span>
                                <a id="stampDelete" class="" href="javascript:void(0);" {if !$site_company->get("stamp")}style="display:none"{/if}><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a id="stampChange" class="" href="javascript:void(0);" {if !$site_company->get("stamp")}style="display:none"{/if}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a id="stampAdd" href="javascript:void(0);" class="" {if $site_company->get("stamp")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i></a> 
                            </div>
                            <div id="stampForm" style="display:none">
                                  <input id="stampFile" type="file" name="Company[stamp]"/> 
                                  <a href="javascript:void(0);" id="stampUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                                  <img id="stampLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                            </div>                                
                        </div>                                                
                    </span>
                </div>
                {else}
                <div class="cols">
                    <div class="label">{__("Stamp")}</div>
                    <span style="display: inline-block;">
                    <div id="stampForm">
                          <input id="stampFile" type="file" class="files" name="Company[stamp]"/>
                    </div>     
                    </span>
                </div>             
            {/if}
            {if $site_company->isLoaded()}
                <div class="cols">
                    <div class="label">{__("Signature")}</div>
                    <span style="display: inline-block;">
                        <div class="CompanyBlockFile">
                            <div class="CompanyBlockImg">
                                <img class="CompanyImg1" width=""   id="signatureImg" {if $site_company->get("signature")}src='{$site_company->getSignature()->getUrl()}' alt="{__('Signature')}" {else}style="display:none"{/if}/>      
                            </div>
                            <div class="CompanyBlockIcons" >
                                <span id="footerFilename">{if $site_company->get("footer")}[{$site_company->get('footer')}]{/if}</span>
                                
                                <a id="signatureDelete" class="" href="javascript:void(0);" {if !$site_company->get("signature")}style="display:none"{/if}><i class="fa fa-trash" aria-hidden="true"></i></a>              
                                <a id="signatureChange" class="" href="javascript:void(0);" {if !$site_company->get("signature")}style="display:none"{/if}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a id="signatureAdd" href="javascript:void(0);" class="" {if $site_company->get("signature")}style="display:none"{/if}><i class="fa fa-plus" style="margin-right:10px;"></i></a> 
                            </div>
                            <div id="signatureForm" style="display:none">
                                  <input id="signatureFile" type="file" name="Company[signature]"/> 
                                  <a href="javascript:void(0);" id="signatureUpload"><img src="{url('/icons/upload.png','picture')}" alt="{__('upload')|capitalize}"></a>
                                  <img id="signatureLoading" height="16" width="16" src="{url('/icons/loading.gif','picture')}" alt="" style="display:none;"> 
                            </div>                                
                        </div>                                                
                    </span>
                </div>
                {else}
                <div class="cols">
                    <div class="label">{__("Stamp")}</div>
                    <span style="display: inline-block;">
                    <div id="signatureForm">
                          <input id="signatureFile" type="file" class="files" name="Company[signature]"/>
                    </div>     
                    </span>
                </div>             
            {/if}
            <div class="cols">
                <div class="label">{__("phone")}</div>
                <span style="display: inline-block;">
                    <div>{$form.phone->getError()}</div> 
                    <input type="text" class="Company" name="phone" value="{$site_company->get('phone')|escape}" size="30"/>{if $form->phone->getOption('required')}*{/if}
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("mobile")}</div>
                <span style="display: inline-block;">
                    <div {if $form.mobile->hasError()}class="error_form"{/if}>{$form.mobile->getError()}</div> 
                    <input type="text" class="Company" name="mobile" value="{$site_company->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("fax")}</div>
                <span style="display: inline-block;">
                    <div>{$form.fax->getError()}</div> 
                    <input type="text" class="Company" name="fax" value="{$site_company->get('fax')|escape}" size="30" />{if $form->fax->getOption('required')}*{/if}
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("NAF")}</div>
                <span style="display: inline-block;">
                    <div {if $form.ape->hasError()}class="error_form"{/if}>{$form.ape->getError()}</div> 
                   <input type="text" class="Company" name="ape" value="{$site_company->get('ape')|escape}" size="30"/>{if $form->ape->getOption('required')}*{/if} 
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("Siret")}</div>
                <span style="display: inline-block;">
                    <div {if $form.siret->hasError()}class="error_form"{/if}>{$form.siret->getError()}</div> 
                    <input type="text" class="Company" name="siret" value="{$site_company->get('siret')|escape}" size="30"/>{if $form->siret->getOption('required')}*{/if} 
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("RCS")}</div>
                <span style="display: inline-block;">
                    <div {if $form.rcs->hasError()}class="error_form"{/if}>{$form.rcs->getError()}</div> 
                    <input type="text" class="Company" name="rcs" value="{$site_company->get('rcs')|escape}" size="30"/>{if $form->rcs->getOption('required')}*{/if} 
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("N°TVA")}</div>
                <span style="display: inline-block;">
                    <div {if $form.tva->hasError()}class="error_form"{/if}>{$form.tva->getError()}</div> 
                    <input type="text" class="Company" name="tva" value="{$site_company->get('tva')|escape}" size="30"/>{if $form->tva->getOption('required')}*{/if} 
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("RGE")}</div>
                <span style="display: inline-block;">
                    <div {if $form.rge->hasError()}class="error_form"{/if}>{$form.rge->getError()}</div> 
                    <input type="text" class="Company" name="rge" value="{$site_company->get('rge')|escape}" size="30"/>{if $form->rge->getOption('required')}*{/if} 
                </span>             
            </div> 
             <div class="cols">
                <div class="label">{__("RGE Start At")}</div>
                <span style="display: inline-block;">
                    <div {if $form.rge_start_at->hasError()}class="error_form"{/if}>{$form.rge_start_at->getError()}</div> 
                    <input type="text" class="Company Date" id="rge_from" name="rge_start_at" value="{if $form->hasErrors()}{$form.rge_start_at}{else if $site_company->hasRgeStartAt()}{$site_company->getRgeStartAt()->getText()}{/if}" size="30"/>{if $form->rge_start_at->getOption('required')}*{/if} 
                </span>             
            </div>
             <div class="cols">
                <div class="label">{__("RGE End At")}</div>
                <span style="display: inline-block;">
                    <div {if $form.rge_end_at->hasError()}class="error_form"{/if}>{$form.rge_end_at->getError()}</div> 
                    <input type="text" class="Company Date" id="rge_to" name="rge_end_at" value="{if $form->hasErrors()}{$form.rge_end_at}{else if $site_company->hasRgeEndAt()}{$site_company->getRgeEndAt()->getText()}{/if}" size="30"/>{if $form->rge_end_at->getOption('required')}*{/if} 
                </span>             
            </div>
            <div class="cols">
                <div class="label">{__("Capital")}</div>
                <span style="display: inline-block;">
                    <div {if $form.capital->hasError()}class="error_form"{/if}>{$form.capital->getError()}</div> 
                    <input type="text" class="Company" name="capital" value="{$site_company->get('capital')|escape}" size="30"/>{if $form->capital->getOption('required')}*{/if}  
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("Comments")}</div>
                <span style="display: inline-block;">
                    <div {if $form.comments->hasError()}class="error_form"{/if}>{$form.comments->getError()}</div> 
                    <textarea rows="2" cols="80" class="Company" name="comments">{$site_company->get('comments')|escape}</textarea>{if $form->comments->getOption('required')}*{/if}   
                </span>             
            </div> 
            <div class="cols">
                <div class="label">{__("Footer text")}</div>
                <span style="display: inline-block;">
                    <div {if $form.footer_text->hasError()}class="error_form"{/if}>{$form.footer_text->getError()}</div> 
                    <textarea rows="2" cols="80" class="Company" name="footer_text">{$site_company->get('footer_text')|escape}</textarea>{if $form->footer_text->getOption('required')}*{/if}    
                </span>             
            </div> 
                
        </div>
            
  {*   <tr>
         <td class="label">{__("address2")}</td>
         <td> 
             <div {if $form.address2->hasError()}class="error_form"{/if}>{$form.address2->getError()}</div> 
             <input type="text" class="Company" name="address2" value="{$site_company->get('address2')|escape}" size="30" />{if $form->getValidator('address2')->getOption('required')}*{/if}
         </td>             
     </tr> *}                                           
  {*    <tr>
         <td class="label">{__("GPS coordinates")}</td>
         <td> 
             <div {if $form.coordinates->hasError()}class="error_form"{/if}{$form.coordinates->getError()}</div> 
             <input type="text" class="Company" name="coordinates" value="{$site_company->get('coordinates')|escape}" size="30"/>{if $form->coordinates->getOption('required')}*{/if}
         </td>             
     </tr>   *}  

   {*  {foreach $form->getRegistrationValidators() as $name=>$validator}                                             
           <tr id="{$name}" {if $name=="tva" && $form->hasValidator('autoentreprise') && $site_company->isAutoEnterprise()}style="display:none"{/if} class="registration">
               <td class="label">
                    {if $validator->title}{__($validator->title)}{elseif $name=="commercial"}{__("commercial name")}{else}{__($name)}{/if}   
               </td>   
               <td>
                   {if $name=='autoentreprise'}            
                           <input type="checkbox" name="autoentreprise" {if $site_company->isAutoEnterprise()}checked=""{/if}/>                                                                                                            
                   {else}     
                           <div>{$form[$name]->getError()}</div>
                           <input type="text" class="Company" name="{$name}" value="{$site_company->get($name)|escape}"/>   
                           {if $validator->getOption("required")}*{/if}
                   {/if}           
               </td>
           </tr>             
      {/foreach}     *}
</fieldset>
<fieldset class="tab-form">
      <legend><h3>{__('Main contact')}</h3></legend>
      <div class="form-inline Company">
          
            <div class="cols" style="text-align: center;">
                <div class="label">{__("Title")}</div>
                <span style="display: inline-block;">
                    <div>{$form.gender->getError()}</div>                
                    {foreach $form->gender->getOption("choices") as $name=>$gender}
                           <input type="radio" style="width: auto;" class="Company" name="gender" value="{$name}" {if $site_company->get('gender')==$name}checked="checked"{/if}/>
                           <span>{format_gender($gender,1,true)|capitalize}</span>
                    {/foreach}{if $form->gender->getOption('required')}*{/if}
                </span>
            </div>
                
            <div class="cols">
                <div class="label">{__("Firstname")}</div>
               <span style="display: inline-block;">
                   <div  {if $form.firstname->hasError()}class="error_form"{/if}>{$form.firstname->getError()}</div> 
                   <input type="text" class="Company" name="firstname" value="{$site_company->get('firstname')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
               </span>
            </div>
            <div class="cols">
               <div class="label">{__("Lastname")}</div>
               <span style="display: inline-block;">
                   <div  {if $form.lastname->hasError()}class="error_form"{/if}>{$form.lastname->getError()}</div> 
                   <input type="text" class="Company" name="lastname" value="{$site_company->get('lastname')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
               </span>
            </div>
          
            <div class="cols">
              <div class="label">{__("Function")}</div>
             <span style="display: inline-block;">
                 <div  {if $form.function->hasError()}class="error_form"{/if}>{$form.function->getError()}</div> 
                 <input type="text" class="Company" name="function" value="{$site_company->get('function')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
             </span>
            </div>
      </div>

</fieldset>                  
         
<fieldset class="tab-form">
    <legend><h3>{__('Second contact')}</h3></legend>
    <div class="form-inline Company">
        <div class="cols">
            <div class="label">{__("Firstname")}</div>
            <span style="display: inline-block;">
                <div  {if $form.firstname1->hasError()}class="error_form"{/if}>{$form.firstname1->getError()}</div> 
                <input type="text" class="Company" name="firstname1" value="{$site_company->get('firstname1')|escape}" size="30"/>{if $form->firstname1->getOption('required')}*{/if}
            </span>
        </div>            
        <div class="cols">
            <div class="label">{__("Lastname")}</div>
            <span style="display: inline-block;">
                <div  {if $form.lastname1->hasError()}class="error_form"{/if}>{$form.lastname1->getError()}</div> 
                <input type="text" class="Company" name="lastname1" value="{$site_company->get('lastname1')|escape}" size="30"/>{if $form->lastname1->getOption('required')}*{/if}
            </span>
       </div>  
        <div class="cols">
         <div class="label">{__("Function")}</div>
         <span style="display: inline-block;"> 
             <div  {if $form.function1->hasError()}class="error_form"{/if}>{$form.function1->getError()}</div> 
             <input type="text" class="Company" name="function1" value="{$site_company->get('function1')|escape}" size="30"/>{if $form->function1->getOption('required')}*{/if}
         </span>
        </div>
    </div>
</fieldset>         
<script type="text/javascript">


     {*    $("[name=autoentreprise]").die(); *}
         
        $(document).off("click", "#cities"); // Remove old events
         
        $('#Company-Cancel').click(function(){ return $.ajax2({ url:"{url_to('site_ajax',['action'=>'Home'])}",
                                                                loading: "#tab-site-dashboard-x-settings-loading",
                                                                target: "#tab-dashboard-x-settings" 
                                                                            }); 
        });
         
        $('#Company-Save').click(function(){ 
                  var params= { Company: {                                        
                                        country : $(".Company[name=country] option:selected").val(), 
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.Company,textarea.Company").each(function() { params.Company[this.name]=$(this).val(); });                     
                  $("input.Company[type=radio]:checked").each(function() { params.Company[this.name]=$(this).val(); }); 
                  if ($("[name=autoentreprise]").length)
                        params.Company.autoentreprise= $("[name=autoentreprise]").is(":checked")?"YES":"NO";  
                //     alert("params="+params.toSource()); return ;
                  return $.ajax2({ data : params,
                                   files: ".files",
                                   url: "{url_to('site_company_ajax',['action'=>'Save'])}",
                                   loading: "#tab-site-dashboard-x-settings-loading",
                                   errorTarget: ".site-errors",
                                   target: "#tab-dashboard-x-settings"}); 
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
                  return $.ajax2({ data : { Company:'{$site_company->get("id")}' }, 
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
         
         
          {* =========================== STAMP ============================================================================= *}  
          $("#stampUpload").click(function () { 
             return $.ajax2({ data : { Company : { id: "{$site_company->get('id')}", token : "{mfForm::getToken('CompanyStampForm')}" } },
                              files: "#stampFile",
                              url: "{url_to('site_company_ajax',['action'=>'SaveStamp'])}",
                              loading: "#stampLoading",
                              success: function (response)
                                       {
                                            $("#stampFile").val('');     
                                            if (response.stamp)
                                            { 
                                                $("#stampImg").attr('src',"{$site_company->getStamp()->getURLPath()}"+response.stamp+"?"+$.now()); 
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
                  return $.ajax2({ data : { Company:'{$site_company->get("id")}' }, 
                                   url: "{url_to('site_company_ajax',['action'=>'DeleteStamp'])}",
                                   success :function(response) {
                                                    if (response.action=='deleteStamp'&&response.id=="{$site_company->get('id')}")
                                                    {
                                                        $("#stampAdd").show();
                                                        $("#stampChange,#stampFilename,#stampImg,#stampDelete,#stampForm").hide();
                                                    }
                                           }
                  } ); 
         });
         
         
            
          {* =========================== SIGNATURE ============================================================================= *}  
          $("#signatureUpload").click(function () { 
             return $.ajax2({ data : { Company : { id: "{$site_company->get('id')}", token : "{mfForm::getToken('CompanySignatureForm')}" } },
                              files: "#signatureFile",
                              url: "{url_to('site_company_ajax',['action'=>'SaveSignature'])}",
                              loading: "#signatureLoading",
                              success: function (response)
                                       {
                                            $("#signatureFile").val('');     
                                            if (response.signature)
                                            { 
                                                $("#signatureImg").attr('src',"{$site_company->getSignature()->getURLPath()}"+response.signature+"?"+$.now()); 
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
                  return $.ajax2({ data : { Company:'{$site_company->get("id")}' }, 
                                   url: "{url_to('site_company_ajax',['action'=>'DeleteSignature'])}",
                                   success :function(response) {
                                                    if (response.action=='deleteSignature'&&response.id=="{$site_company->get('id')}")
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
         
       {*  $(".company[name=country]").change(function(){          
             return $.ajax2({ data : { Registration : { country: $(this).val(), token : "{mfForm::getToken('CompanyRegistrationForm')}" } },                             
                              url: "{url_to('site_company_ajax',['action'=>'Registration'])}",                             
                              success: function (response)
                                       {   
                                          // alert('Reponse'+response);
                                           $(".registration").remove();
                                           $("#company-form").append(response);
                                       }
                            });
         }); *}
      
      $("#GeneratePictures").click(function () { 
          return $.ajax2({ data : { Company:'{$site_company->get("id")}' }, 
                                   url: "{url_to('site_company_ajax',['action'=>'GeneratePicture'])}",
                                   errorTarget: ".site-errors",
                                   success :function(resp) {
                                                    if (resp.action!='GeneratePicture') return ;
                                                   $("#pictureImgThumb").attr('src',resp.picture.thumb.url);
                                           }
                  } ); 
      });
      
      
          var dates = $( ".Company#rge_from, .Company#rge_to" ).datepicker({
			onSelect: function( selectedDate ) {
				var option = this.id == "rge_from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
    } } );
</script>
