{messages class="site-errors"}
<h3>{__('New PDF model for polluter [%s]',$polluter->get('name'))}</h3>
<div>
    <a href="#" class="btn" id="PartnerPolluterModel-Save" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" class="btn" id="PartnerPolluterModel-Cancel">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.model_i18n.lang site=$site}   
<table class="tab-form" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.model_i18n.lang->getError()}</div>      
            <img class="PartnerPolluterModelI18n" id="{$form.model_i18n.lang}" name="lang" src="{url("/flags/`$form.model_i18n.lang`.png","picture")}" title="{if !$form.model_i18n.lang->getError()}{format_country($form.model_i18n.lang)}{/if}" />
            <a id="PartnerPolluterModel-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label"><span>{__("Name")}</span>{if $form->model.name->getOption('required')}*{/if}</td>
        <td>
             <div class="error-form">{$form.model.name->getError()}</div>               
             <input type="text" class="PartnerPolluterModel" size="64" name="name" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>     
       <tr class="full-with">
         <td class="label"><span>{__("Value")}</span>  {if $form->model_i18n.value->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.value->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="value" value="{$item_i18n->get('value')}"/>              
         </td>
    </tr>
      <tr class="full-with">
         <td class="label"><span>{__("Comments")}</span>  {if $form->model_i18n.comments->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.comments->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="comments" value="{$item_i18n->get('comments')}"/>              
         </td>
    </tr>
       <tr class="full-with">
         <td class="label"><span>{__("Signature")}</span> {if $form->model_i18n.signature->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.signature->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="signature" value="{$item_i18n->get('signature')}"/>               
         </td>
    </tr>
      <tr class="full-with">
         <td class="label"><span>{__("Initiator signature")}</span> {if $form->model_i18n.initiator_signature->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.initiator_signature->getError()}</div>
            <input type="text"  class="PartnerPolluterModelI18n" size="64" name="initiator_signature" value="{$item_i18n->get('initiator_signature')}"/>               
         </td>
    </tr>
      <tr class="full-with">
        <td class="label"><span>{__("PDF")}</span></td>
        <td>
            <div id="error_file" class="error-form">{$form.model_i18n.file->getError()}</div>  
            <div>{__('Max size for file %s.',format_size($form->model_i18n.file->getOption('max_size')))}</div>
            <div>
               <input class="files" type="file" name="PolluterModel[model_i18n][file]"/> 
            </div>
            {if $form->model_i18n.file->getOption('required')}*{/if}   
        </td>
    </tr>
</table> 
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".PartnerPolluterModel,.PartnerPolluterModelI18n").click(function() {  $('#PartnerPolluterModel-Save').show(); });    
        
         
     {* =================== L A N G U A G E ================================ *}
         $( "#PartnerPolluterModel-ChangeLang").click(function() {
            $("#PartnerPolluterModel-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".PartnerPolluterModelI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#PartnerPolluterModel-Cancel').click(function(){   
             
             return $.ajax2({ data: { Polluter: '{$polluter->get('id')}' , filter: { lang:$("img.PartnerPolluterModelI18n").attr('id'), token: "{mfForm::getToken('PolluterModelI18nForPolluterFormFilter')}" } },                              
                              url : "{url_to('partners_polluter_ajax',['action'=>'ListPartialModelI18nForPolluter'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#PartnerPolluterModel-Save').click(function(){                             
            var  params= {      Polluter: '{$polluter->get('id')}',   
                                PolluterModel: { 
                                   model_i18n : { lang: $(".PartnerPolluterModelI18n[name=lang]").attr('id')  },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.PartnerPolluterModelI18n,textarea.PartnerPolluterModelI18n").each(function() { params.PolluterModel.model_i18n[this.name]=$(this).val(); });
          $("input.PartnerPolluterModel").each(function() {  params.PolluterModel.model[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          
          return $.ajax2({ data : params,   
                           files: ".files",
                           url: "{url_to('partners_polluter_ajax',['action'=>'SaveNewPDFModelI18nForPolluter'])}",
                            loading: "#tab-site-dashboard-x-settings-loading",  
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });                
</script>

