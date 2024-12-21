{messages class="UserAttribution-errors"}
<h3>{__("New attribution")}</h3>
<div>
    <a href="#" id="UserAttribution-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="UserAttribution-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.attribution_i18n.lang site=$item->getSite()}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.attribution_i18n.lang->getError()}</div>      
            <img class="UserAttributionI18n" id="{$form.attribution_i18n.lang}" name="lang" src="{url("/flags/`$form.attribution_i18n.lang`.png","picture")}" title="{if !$form.attribution_i18n.lang->getError()}{format_country($form.attribution_i18n.lang)}{/if}" />
            <a id="UserAttribution-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr>     
     <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div id="UserAttribution-error_value">{$form.attribution.name->getError()}</div>
            <input type="text" size="48" class="UserAttribution" name="name" value="{$item->get('name')}"/>    
            {if $form->attribution.name->getOption('required')}*{/if} 
         </td>
    </tr>   
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div>{$form.attribution_i18n.value->getError()}</div>
            <input type="text" size="48" class="UserAttributionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->attribution_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".UserAttribution,.UserAttributionI18n").click(function() {  $("#UserAttribution-Save").show(); });           
         
     {* =================== L A N G U A G E ================================ *}
         $( "#UserAttribution-ChangeLang").click(function() {
            $("#UserAttribution-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".UserAttributionI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#UserAttribution-Cancel').click(function(){   
             $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.UserAttributionI18n").attr('id'), token: "{mfForm::getToken('UsersAttributionFormFilter')}" } },                              
                              url : "{url_to('users_ajax',['action'=>'ListPartialAttribution'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#UserAttribution-Save').click(function(){                             
            var  params= {      iFrame:true,             
                                UserAttribution: { 
                                   attribution_i18n : { lang: $(".UserAttributionI18n[name=lang]").attr('id')  },
                                   attribution : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserAttributionI18n").each(function() { params.UserAttribution.attribution_i18n[this.name]=$(this).val(); });    
          $("input.UserAttribution").each(function() { params.UserAttribution.attribution[this.name]=$(this).val(); });       
        //      alert("Params="+params.toSource());   return ;
          $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".UserAttribution-files",
                           url: "{url_to('users_ajax',['action'=>'SaveNewAttributionI18n'])}",
                           loading: "#tab-site-dashboard-x-settings-loading", 
                           target: "#actions"}); 
        });  
     
</script>
