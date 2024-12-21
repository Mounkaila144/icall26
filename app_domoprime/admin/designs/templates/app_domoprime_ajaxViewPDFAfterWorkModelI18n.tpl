{messages class="AfterWorkModel-errors"}
<h3>{__("View PDF model")}</h3>
<div>
    <a href="#" id="AfterWorkModel-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
        <a href="#" id="AfterWorkModel-Cancel" class="btn">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">   
    <tr class="full-with">
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Name")} {if $form->model.name->getOption('required')}*{/if} </span>
        </td>
        <td><div id="AfterWorkModel-error_name" class="error-form">{$form.model.name->getError()}</div>  
            <input type="text" class="AfterWorkModel Input" name="name" size="64" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>        
    <tr class="full-with">
         <td class="label"><span>{__("Value")}{if $form->model_i18n.value->getOption('required')}*{/if}</span></td>
         <td>
            <div id="AfterWorkModel-error_value" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text" size="64" class="AfterWorkModelI18n Input" name="value" value="{$item_i18n->get('value')}"/>              
         </td>
    </tr>          
    {if $form->model_i18n->hasValidator('file')}
        <tr class="full-with">
        <td class="label"><span>{__("PDF")}{if $form->model_i18n.file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.model_i18n.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->model_i18n.file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="AfterWorkModelI18n[model_i18n][file]"/> 
            </div>          
        </td>
    </tr>
    {/if}    
    {if $user->hasCredential([['superadmin']])}
     <tr class="full-with">
        <td class="label"><span>{__("Variables")}</span></td>
        <td>
            <textarea disabled="" readonly="" cols="80" rows="10">{$item_i18n->getVariablesOfFile()->implode("\n")}</textarea>
        </td>
    </tr>
    {/if} 
  <tr class="full-with">
        <td class="label"><span>{__("Polluter logo")}</span>{if $form->model.polluter_logo->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.polluter_logo->getError()}</div>               
             <input type="text" class="AfterWorkModel Input" size="64" name="polluter_logo" value="{if $form->hasErrors()}{$form.model.polluter_logo}{else}{$item_i18n->getModel()->getOptions()->getPolluter()->implode(";")}{/if}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Layer logo")}</span>{if $form->model.layer_logo->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.layer_logo->getError()}</div>               
             <input type="text" class="AfterWorkModel Input" size="64" name="layer_logo" value="{if $form->hasErrors()}{$form.model.layer_logo}{else}{$item_i18n->getModel()->getOptions()->getLayer()->implode(";")}{/if}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Company logo")}</span>{if $form->model.company_logo->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.company_logo->getError()}</div>               
             <input type="text" class="AfterWorkModel Input" size="64" name="company_logo" value="{if $form->hasErrors()}{$form.model.company_logo}{else}{$item_i18n->getModel()->getOptions()->getCompany()->implode(";")}{/if}"/> 
        </td>
    </tr>   
    {if $form->model->hasValidator('partner_logo')}
    <tr class="full-with">
        <td class="label"><span>{__("partner logo")}</span>{if $form->model.partner_logo->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.partner_logo->getError()}</div>               
             <input type="text" class="AfterWorkModel Input" size="64" name="partner_logo" value="{if $form->hasErrors()}{$form.model.partner_logo}{else}{$item_i18n->getModel()->getOptions()->getPartnerLogo()->implode(";")}{/if}"/> 
        </td>
    </tr>   
    {/if}
     <tr class="full-with">
        <td class="label"><span>{__("Company header")}</span>{if $form->model.company_header->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.company_header->getError()}</div>               
             <input type="text" class="AfterWorkModel Input" size="64" name="company_header" value="{if $form->hasErrors()}{$form.model.company_header}{else}{$item_i18n->getModel()->getOptions()->getHeaderCompany()->implode(";")}{/if}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Company footer")}</span>{if $form->model.company_footer->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.company_footer->getError()}</div>               
             <input type="text" class="AfterWorkModel Input" size="64" name="company_footer" value="{if $form->hasErrors()}{$form.model.company_footer}{else}{$item_i18n->getModel()->getOptions()->getFooterCompany()->implode(";")}{/if}"/> 
        </td>
    </tr>
</table>


<script type="text/javascript">
  
     {* =================== F I E L D S ================================ *}
     $(".AfterWorkModelI18n,.AfterWorkModel").click(function() {  $('#AfterWorkModel-Save').show(); });    
                       
     {* =================== A C T I O N S ================================ *}
     $('#AfterWorkModel-Cancel').click(function(){              
             return $.ajax2({ data: { filter: { lang:'{$item_i18n->get('lang')}', token: "{mfForm::getToken('DomoprimeAfterWorkModelFormFilter')}" } },  
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialAfterWorkModel'])}",
                              errorTarget: ".AfterWorkModelI18n-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#AfterWorkModel-Save').click(function(){                             
            var  params= {            
                                AfterWorkModelI18n: { 
                                   model_i18n : { lang: "{$item_i18n->get('lang')}",model_id: "{$item_i18n->get('model_id')}"    },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.AfterWorkModelI18n,textarea.AfterWorkModelI18n").each(function() { params.AfterWorkModelI18n.model_i18n[this.name]=$(this).val(); });
          $("input.AfterWorkModel").each(function() {  params.AfterWorkModelI18n.model[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".files",
                           errorTarget: ".AfterWorkModel-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",  
                           url: "{url_to('app_domoprime_ajax',['action'=>'SavePDFAfterWorkModelI18n'])}",
                           target: "#actions" }); 
        });  
     
  
     
</script>