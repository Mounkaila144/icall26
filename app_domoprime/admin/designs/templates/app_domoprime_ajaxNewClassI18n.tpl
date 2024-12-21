{messages class="DomoprimeClass-errors"}
<h3>{__("New class")}</h3>
<div>
    <a href="#" id="DomoprimeClass-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeClass-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.class_i18n.lang}   
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.class_i18n.lang->getError()}</div>      
            <img class="DomoprimeClassI18n" id="{$form.class_i18n.lang}" name="lang" src="{url("/flags/`$form.class_i18n.lang`.png","picture")}" title="{if !$form.class_i18n.lang->getError()}{format_country($form.class_i18n.lang)}{/if}" />
            <a id="DomoprimeClass-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr>    
    <tr class="full-with">
        <td class="label"><span>{__("name")}</span></td>
        <td>
            <div class="error-form">{$form.class.name->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="name" value="{$item_i18n->getClass()->get('name')}"/> 
        </td>
    </tr>      
       <tr class="full-with">
           <td class="label"><span>{__("value")}</span></td>
         <td>
            <div id="error_pages" class="error-form">{$form.class_i18n.value->getError()}</div>
            <input type="text" size="40" class="DomoprimeClassI18n" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->class_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>
      <tr class="full-with">
        <td class="label"><span>{__("Coef")}</span></td>
        <td>
            <div class="error-form">{$form.class.coef->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="coef" value="{$item_i18n->getClass()->get('coef')}"/> 
        </td>
    </tr>  
     <tr class="full-with">
        <td class="label"><span>{__("Multiple")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple" value="{$item_i18n->getClass()->get('multiple')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple floor")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple_floor->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple_floor" value="{$item_i18n->getClass()->get('multiple_floor')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple top")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple_top->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple_top" value="{$item_i18n->getClass()->get('multiple_top')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple wall")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple_wall->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple_wall" value="{$item_i18n->getClass()->get('multiple_wall')}"/> 
        </td>
    </tr>
</table> 
   
  
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeClass,.DomoprimeClassI18n").click(function() {  $('#DomoprimeClass-Save').show(); });           
         
     {* =================== L A N G U A G E ================================ *}
         $( "#DomoprimeClass-ChangeLang").click(function() {
            $("#DomoprimeClass-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".DomoprimeClassI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeClass-Cancel').click(function(){   
           //  $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.DomoprimeClassI18n").attr('id'), token: "{mfForm::getToken('DomoprimeClassFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}",
                              errorTarget: ".DomoprimeClass-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#DomoprimeClass-Save').click(function(){                             
            var  params= {             
                                DomoprimeClass: { 
                                   class_i18n : { lang: $(".DomoprimeClassI18n[name=lang]").attr('id')  },
                                   class : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeClassI18n").each(function() { params.DomoprimeClass.class_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeClass").each(function() {  params.DomoprimeClass.class[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
        //  $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".DomoprimeClass-files",
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveNewClassI18n'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           errorTarget: ".DomoprimeClass-errors",
                           target: "#actions"}); 
        });  
     
</script>
