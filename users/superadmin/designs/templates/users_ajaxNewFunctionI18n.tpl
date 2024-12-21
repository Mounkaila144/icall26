{messages class="{$site->getSiteID()}-UserFunction-errors"}
<h3>{__("New Function")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-UserFunction-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-UserFunction-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.function_i18n.lang site=$user_function_i18n->getSite()}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.function_i18n.lang->getError()}</div>      
            <img class="{$site->getSiteID()}-UserFunctionI18n" id="{$form.function_i18n.lang}" name="lang" src="{url("/flags/`$form.function_i18n.lang`.png","picture")}" title="{if !$form.function_i18n.lang->getError()}{format_country($form.function_i18n.lang)}{/if}" />
            <a id="{$site->getSiteID()}-UserFunction-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr>     
     <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div id="UserFunction-error_value">{$form.function.name->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserFunction" name="name" value="{$user_function_i18n->getUserFunction()->get('name')}"/>    
            {if $form->function.name->getOption('required')}*{/if} 
         </td>
    </tr>   
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div>{$form.function_i18n.value->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserFunctionI18n" name="value" value="{$user_function_i18n->get('value')}"/>    
            {if $form->function_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-UserFunction,.{$site->getSiteID()}-UserFunctionI18n").click(function() {  $('#{$site->getSiteID()}-UserFunction-Save').show(); });           
         
     {* =================== L A N G U A G E ================================ *}
         $( "#{$site->getSiteID()}-UserFunction-ChangeLang").click(function() {
            $("#{$site->getSiteID()}-UserFunction-Save").show();
            $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
         });  
         
         $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                    
            $(".{$site->getSiteID()}-UserFunctionI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-UserFunction-Cancel').click(function(){   
             $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.{$site->getSiteID()}-UserFunctionI18n").attr('id'), token: "{mfForm::getToken('UsersFunctionFormFilter')}" } },                              
                              url : "{url_to('users_site_ajax',['action'=>'ListPartialFunction'])}",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions"}); 
      });
      
      $('#{$site->getSiteID()}-UserFunction-Save').click(function(){                             
            var  params= {      iFrame:true,             
                                UserFunction: { 
                                   function_i18n : { lang: $(".{$site->getSiteID()}-UserFunctionI18n[name=lang]").attr('id')  },
                                   function : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-UserFunctionI18n").each(function() { params.UserFunction.function_i18n[this.name]=$(this).val(); });    
          $("input.{$site->getSiteID()}-UserFunction").each(function() { params.UserFunction.function[this.name]=$(this).val(); });       
        //      alert("Params="+params.toSource());   return ;
          $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".{$site->getSiteID()}-UserFunction-files",
                           url: "{url_to('users_site_ajax',['action'=>'SaveNewFunctionI18n'])}",
                           target: "#{$site->getSiteID()}-actions"}); 
        });  
     
</script>
