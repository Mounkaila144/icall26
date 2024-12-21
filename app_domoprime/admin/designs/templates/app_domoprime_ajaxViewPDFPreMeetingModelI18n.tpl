{messages class="PreMeetingModel-errors"}
<h3>{__("View PDF model")}</h3>
<div>
    <a href="#" id="PreMeetingModel-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
        <a href="#" id="PreMeetingModel-Cancel" class="btn">
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
        <td><div id="PreMeetingModel-error_name" class="error-form">{$form.model.name->getError()}</div>  
            <input type="text" class="PreMeetingModel Input" name="name" size="64" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>        
    <tr class="full-with">
         <td class="label"><span>{__("Value")}{if $form->model_i18n.value->getOption('required')}*{/if}</span></td>
         <td>
            <div id="PreMeetingModel-error_value" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text" size="64" class="PreMeetingModelI18n Input" name="value" value="{$item_i18n->get('value')}"/>              
         </td>
    </tr>          
    {if $form->model_i18n->hasValidator('file')}
        <tr class="full-with">
        <td class="label"><span>{__("PDF")}{if $form->model_i18n.file->getOption('required')}*{/if}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.model_i18n.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->model_i18n.file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="PreMeetingModelI18n[model_i18n][file]"/> 
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
</table>


<script type="text/javascript">
  
     {* =================== F I E L D S ================================ *}
     $(".PreMeetingModelI18n,.PreMeetingModel").click(function() {  $('#PreMeetingModel-Save').show(); });    
                       
     {* =================== A C T I O N S ================================ *}
     $('#PreMeetingModel-Cancel').click(function(){              
             return $.ajax2({ 
                 data: { filter: { lang:'{$item_i18n->get('lang')}', token: "{mfForm::getToken('DomoprimePreMeetingModelsFormFilter')}" } },                                
                 url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPreMeetingModel'])}",
                              errorTarget: ".PreMeetingModelI18n-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#PreMeetingModel-Save').click(function(){                             
            var  params= {            
                                PreMeetingModelI18n: { 
                                   model_i18n : { lang: "{$item_i18n->get('lang')}",model_id: "{$item_i18n->get('model_id')}"    },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.PreMeetingModelI18n,textarea.PreMeetingModelI18n").each(function() { params.PreMeetingModelI18n.model_i18n[this.name]=$(this).val(); });
          $("input.PreMeetingModel").each(function() {  params.PreMeetingModelI18n.model[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".files",
                           errorTarget: ".PreMeetingModel-errors",
                            loading: "#tab-site-dashboard-x-settings-loading",  
                           url: "{url_to('app_domoprime_ajax',['action'=>'SavePDFPreMeetingModelI18n'])}",
                           target: "#actions" }); 
        });  
     
  
     
</script>