{messages class="site-errors"}
<h3>{__("View model")}</h3>
{if $item_i18n->getModel()->isLoaded()}
<div>
    <a href="#" class="btn" id="SimulationModel-Save"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" class="btn" id="SimulationModel-Cancel"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
<table class="tab-form" cellpadding="0" cellspacing="0">
     <tr class="full-with">
        <td class="label">{__('id')}</td>
        <td>{if $item_i18n->isLoaded()} 
            <span>{$item_i18n->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr>
      <tr class="full-with">
        <td></td>
        <td><img class="SimulationModelI18n" id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
    <tr class="full-with">
        <td class="label"><span>{__("name")}</span></td>
        <td>
             <div class="error_form">{$form.model.name->getError()}</div>               
             <input type="text" class="SimulationModel" size="64" name="name" value="{$item_i18n->getModel()->get('name')}"/> 
        </td>
    </tr>     
       <tr class="full-with">
         <td class="label"><span>{__("value")}</span></td>
         <td>
            <div id="error_pages" class="error_form">{$form.model_i18n.value->getError()}</div>
            <input type="text"  class="SimulationModelI18n" size="64" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->model_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>     
    <tr class="body-email content" >
         <td class="label"><span>{__("body")}</span></td>
         <td class="editor-body">
             <div id="error_pages" class="error_form">{$form.model_i18n.body->getError()}</div>
            <textarea  class="SimulationModelI18n editor" rows="20" cols="80" name="body">{$item_i18n->get('body')}</textarea>    
            {if $form->model_i18n.body->getOption('required')}*{/if} 
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
     $(".SimulationModel,.SimulationModelI18n").click(function() {  $('#SimulationModel-Save').show(); });    
        
         
     {* =================== L A N G U A G E ================================ *}
         $( "#SimulationModel-ChangeLang").click(function() {
            $("#SimulationModel-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".SimulationModelI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#SimulationModel-Cancel').click(function(){              
             return $.ajax2({ data: { filter: { lang:$("img.SimulationModelI18n").attr('id'), token: "{mfForm::getToken('DomoprimeSimulationModelsFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationModel'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#SimulationModel-Save').click(function(){                             
            var  params= {         
                                DomoprimeSimulationModelI18n: { 
                                   model_i18n : { lang: "{$item_i18n->get('lang')}",model_id: "{$item_i18n->get('model_id')}"    },
                                   model : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.SimulationModelI18n,textarea.SimulationModelI18n").each(function() { params.DomoprimeSimulationModelI18n.model_i18n[this.name]=$(this).val(); });
          $("input.SimulationModel").each(function() {  params.DomoprimeSimulationModelI18n.model[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                        
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveSimulationModelI18n'])}",
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });  
        
  {*   $(".editor").on('editable.contentChanged', function (e, editor) {
            $('#SimulationModel-Save').show();
     });
  
      $('.editor').editable({ 
                            inlineMode: false, 
                            buttons: ['undo', 'redo' , 'sep', 'bold', 'italic','fontFamily', 'underline','html','color'],
                            height:"300px",
                             width: "100%",
                            language: '{$country}'  });    *} 

    {*  $('.SimulationModelI18n[name=body]').ckeditor({  
        
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
        $(".SimulationModelI18n[name=body]").ckeditorGet().insertText("{ldelim}$"+$(this).attr('name')+"{rdelim}");
     });  *}
</script>

{else}
    {__('Model is invalid')}    
{/if}    


