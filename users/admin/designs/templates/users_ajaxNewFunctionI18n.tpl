{messages class="UserFunction-errors"}
<h3>{__("New Function")}</h3>
<div>
    <a href="#" id="UserFunction-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="UserFunction-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.function_i18n.lang site=$user_function_i18n->getSite()}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.function_i18n.lang->getError()}</div>      
            <img class="UserFunctionI18n" id="{$form.function_i18n.lang}" name="lang" src="{url("/flags/`$form.function_i18n.lang`.png","picture")}" title="{if !$form.function_i18n.lang->getError()}{format_country($form.function_i18n.lang)}{/if}" />
            <a id="UserFunction-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr>     
     <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div id="UserFunction-error_value">{$form.function.name->getError()}</div>
            <input type="text" size="48" class="UserFunction" name="name" value="{$user_function_i18n->get('name')}"/>    
            {if $form->function.name->getOption('required')}*{/if} 
         </td>
    </tr>   
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div>{$form.function_i18n.value->getError()}</div>
            <input type="text" size="48" class="UserFunctionI18n" name="value" value="{$user_function_i18n->get('value')}"/>    
            {if $form->function_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".UserFunction,.UserFunctionI18n").click(function() {  $('#UserFunction-Save').show(); });           
         
     {* =================== L A N G U A G E ================================ *}
         $( "#UserFunction-ChangeLang").click(function() {
            $("#UserFunction-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".UserFunctionI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#UserFunction-Cancel').click(function(){   
             $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.UserFunctionI18n").attr('id'), token: "{mfForm::getToken('UsersFunctionFormFilter')}" } },                              
                              url : "{url_to('users_ajax',['action'=>'ListPartialFunction'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#UserFunction-Save').click(function(){                             
            var  params= {      iFrame:true,             
                                UserFunction: { 
                                   function_i18n : { lang: $(".UserFunctionI18n[name=lang]").attr('id')  },
                                   function : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserFunctionI18n").each(function() { params.UserFunction.function_i18n[this.name]=$(this).val(); });    
          $("input.UserFunction").each(function() { params.UserFunction.function[this.name]=$(this).val(); });       
        //      alert("Params="+params.toSource());   return ;
          $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".UserFunction-files",
                           url: "{url_to('users_ajax',['action'=>'SaveNewFunctionI18n'])}",
                           target: "#actions"}); 
        });  
     
</script>
