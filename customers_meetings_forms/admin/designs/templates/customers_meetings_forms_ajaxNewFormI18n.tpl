{messages class="CustomerMeetingForm-errors"}
<h3>{__("New form")}</h3>
<div>
    <a href="#" id="CustomerMeetingForm-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="CustomerMeetingForm-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.form_i18n.lang}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.form_i18n.lang->getError()}</div>      
            <img class="CustomerMeetingFormI18n" id="{$form.form_i18n.lang}" name="lang" src="{url("/flags/`$form.form_i18n.lang`.png","picture")}" title="{if !$form.form_i18n.lang->getError()}{format_country($form.form_i18n.lang)}{/if}" />
            <a id="CustomerMeetingForm-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
      <tr class="full-with">
        <td class="label"><span>{__("name")}</span></td>
        <td>
            <div class="error-form">{$form.form.name->getError()}</div>               
             <input type="text" size="30" class="CustomerMeetingForm" name="name" value="{$item->getForm()->get('name')}"/> 
             {if $form->form.name->getOption('required')}*{/if} 
        </td>
    </tr>
           <tr class="full-with">
           <td class="label"><span>{__("value")}</span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.form_i18n.value->getError()}</div>
            <input type="text" size="30" class="CustomerMeetingFormI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->form_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr> 
</table> 
   
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".CustomerMeetingForm,.CustomerMeetingFormI18n").click(function() {  $('#CustomerMeetingForm-Save').show(); });    
    
   
         
     {* =================== L A N G U A G E ================================ *}
         $( "#CustomerMeetingForm-ChangeLang").click(function() {
            $("#CustomerMeetingForm-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".CustomerMeetingFormI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#CustomerMeetingForm-Cancel').click(function(){   
             $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.CustomerMeetingFormI18n").attr('id'), token: "{mfForm::getToken('CustomerMeetingFormsFormFilter')}" } },                              
                              url : "{url_to('customers_meeting_forms_ajax',['action'=>'ListPartialForm'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-site-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#CustomerMeetingForm-Save').click(function(){                             
            var  params= {             
                                CustomerMeetingForm: { 
                                   form_i18n : { lang: $(".CustomerMeetingFormI18n[name=lang]").attr('id')  },
                                   form : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerMeetingFormI18n").each(function() { params.CustomerMeetingForm.form_i18n[this.name]=$(this).val(); });
          $("input.CustomerMeetingForm").each(function() {  params.CustomerMeetingForm.form[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,                            
                           url: "{url_to('customers_meeting_forms_ajax',['action'=>'SaveNewFormI18n'])}",
                           target: "#actions"}); 
        });  
     
</script>
