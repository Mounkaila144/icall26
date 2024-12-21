{messages class="site-errors"}
<h3>{__("New model")}</h3>

<div>
    <a href="#" class="btn" id="CustomerModelEmail-Save"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" class="btn" id="CustomerModelEmail-Cancel"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.model_i18n.lang site=$site}   

<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error_form">{$form.model_i18n.lang->getError()}</div>      
            <img class="CustomerModelEmailI18n" id="{$form.model_i18n.lang}" name="lang" src="{url("/flags/`$form.model_i18n.lang`.png","picture")}" title="{if !$form.model_i18n.lang->getError()}{format_country($form.model_i18n.lang)}{/if}" />
            <a id="CustomerModelEmail-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr class="full-with">
        <td class="label"><span>{__("name")}</span></td>
        <td>
             <div class="error_form">{$form.model.name->getError()}</div>               
             <input type="text" class="CustomerModelEmail" size="64" name="name" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>     
       <tr class="full-with">
         <td class="label"><span>{__("value")}</span></td>
         <td>
            <div id="error_pages" class="error_form">{$form.model_i18n.value->getError()}</div>
            <input type="text"  class="CustomerModelEmailI18n" size="64" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->model_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>
    <tr class="full-with">
         <td class="label"><span>{__("Signature")}</span> {if $form->model_i18n.signature->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.signature->getError()}</div>
            <input type="text"  class="CustomerModelEmailI18n" size="64" name="signature" value="{$item_i18n->get('signature')}"/>               
         </td>
    </tr>
      <tr class="full-with">
         <td class="label"><span>{__("Initiator signature")}</span> {if $form->model_i18n.initiator_signature->getOption('required')}*{/if} </td>
         <td>
            <div id="error_pages" class="error-form">{$form.model_i18n.initiator_signature->getError()}</div>
            <input type="text"  class="CustomerModelEmailI18n" size="64" name="initiator_signature" value="{$item_i18n->get('initiator_signature')}"/>               
         </td>
    </tr>
    <tr class="body-email content" >
         <td class="label"><span>{__("body")}</span></td>
         <td class="editor-body">
             <div id="error_pages" class="error_form">{$form.model_i18n.content->getError()}</div>
            <textarea  class="CustomerModelEmailI18n editor" rows="20" cols="80" name="content">{$item_i18n->get('content')}</textarea>    
            {if $form->model_i18n.content->getOption('required')}*{/if} 
         </td>
    </tr>  
    <tr class="dict">
        <td>
             {component name="/utils_model_variables/EmailsTabs"}         
        </td>
    </tr> 
</table> 

<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".CustomerModelEmail,.CustomerModelEmailI18n").click(function() {  $('#CustomerModelEmail-Save').show(); });    
        
         
     {* =================== L A N G U A G E ================================ *}
         $( "#CustomerModelEmail-ChangeLang").click(function() {
            $("#CustomerModelEmail-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".CustomerModelEmailI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#CustomerModelEmail-Cancel').click(function(){              
             return $.ajax2({ data: { filter: { lang:$("img.CustomerModelEmailI18n").attr('id'), token: "{mfForm::getToken('DomoprimeAfterWorkModelFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialAfterWorkModel'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#CustomerModelEmail-Save').click(function(){                             
            var  params= {         
                                DomoprimeAfterWorkModel: { 
                                   model_i18n : { lang: $(".CustomerModelEmailI18n[name=lang]").attr('id')  },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerModelEmailI18n,textarea.CustomerModelEmailI18n").each(function() { params.DomoprimeAfterWorkModel.model_i18n[this.name]=$(this).val(); });
          $("input.CustomerModelEmail").each(function() {  params.DomoprimeAfterWorkModel.model[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                        
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveNewAfterWorkModelI18n'])}",
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });  
        
  {*   $(".editor").on('editable.contentChanged', function (e, editor) {
            $('#CustomerModelEmail-Save').show();
     });
  
      $('.editor').editable({ 
                            inlineMode: false, 
                            buttons: ['undo', 'redo' , 'sep', 'bold', 'italic','fontFamily', 'underline','html','color'],
                            height:"300px",
                             width: "100%",
                            language: '{$country}'  });    *} 

    {*  $('.CustomerModelEmailI18n[name=body]').ckeditor({  
        
       allowedContent: true,
        toolbar: [
             
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },             
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
            { name: 'colors', items : [ 'TextColor','BGColor' ] }
                ],
        toolbarGroups: [
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        ]
    }); 

    $(".ModelVariables").click(function() { 
        $(".CustomerModelEmailI18n[name=body]").ckeditorGet().insertText("{ldelim}$"+$(this).attr('name')+"{rdelim}");
     }); *}
</script>



