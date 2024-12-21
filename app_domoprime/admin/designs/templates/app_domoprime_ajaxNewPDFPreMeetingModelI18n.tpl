{messages class="site-errors"}
<h3>{__('New PDF model')}</h3>
<div>
    <a href="#" class="btn" id="Model-Save" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" class="btn" id="Model-Cancel">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.model_i18n.lang site=$site}   
<table class="tab-form" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.model_i18n.lang->getError()}</div>      
            <img class="ModelI18n" id="{$form.model_i18n.lang}" name="lang" src="{url("/flags/`$form.model_i18n.lang`.png","picture")}" title="{if !$form.model_i18n.lang->getError()}{format_country($form.model_i18n.lang)}{/if}" />
            <a id="Model-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label"><span>{__("Name")}</span>{if $form->model.name->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.name->getError()}</div>               
             <input type="text" class="Model" size="64" name="name" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>     
       <tr class="full-with">
         <td class="label"><span>{__("Value")}</span>  {if $form->model_i18n.value->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text"  class="ModelI18n" size="64" name="value" value="{$item_i18n->get('value')}"/>              
         </td>
    </tr>     
      <tr class="full-with">
        <td class="label"><span>{__("PDF")}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.model_i18n.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->model_i18n.file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="PreMeetingModel[model_i18n][file]"/> 
            </div>
            {if $form->model_i18n.file->getOption('required')}*{/if}   
        </td>
    </tr>
</table> 
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".Model,.ModelI18n").click(function() {  $('#Model-Save').show(); });    
        
         
     {* =================== L A N G U A G E ================================ *}
         $( "#Model-ChangeLang").click(function() {
            $("#Model-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".ModelI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#Model-Cancel').click(function(){   
             
             return $.ajax2({ data: { filter: { lang:$("img.ModelI18n").attr('id'), token: "{mfForm::getToken('DomoprimePreMeetingModelsFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialPreMeetingModel'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#Model-Save').click(function(){                             
            var  params= {     
                                PreMeetingModel: { 
                                   model_i18n : { lang: $(".ModelI18n[name=lang]").attr('id')  },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.ModelI18n,textarea.ModelI18n").each(function() { params.PreMeetingModel.model_i18n[this.name]=$(this).val(); });
          $("input.Model").each(function() {  params.PreMeetingModel.model[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          
          return $.ajax2({ data : params,   
                           files: ".files",
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveNewPDFPreMeetingModelI18n'])}",
                            loading: "#tab-site-dashboard-x-settings-loading",  
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });                
</script>


