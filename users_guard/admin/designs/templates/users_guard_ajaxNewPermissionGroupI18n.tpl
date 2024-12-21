{messages class="PermissionsGroup-errors"}
<h3>{__("New group")}</h3>
<div>
    <a href="#" id="PermissionsGroup-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="PermissionsGroup-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.group_i18n.lang}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.group_i18n.lang->getError()}</div>      
            <img class="PermissionsGroupI18n" id="{$form.group_i18n.lang}" name="lang" src="{url("/flags/`$form.group_i18n.lang`.png","picture")}" title="{if !$form.group_i18n.lang->getError()}{format_country($form.group_i18n.lang)}{/if}" />
            <a id="PermissionsGroup-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td><span>{__("name")}</span></td>
        <td>
             <div>{$form.group.name->getError()}</div>               
             <input type="text" size="20" class="PermissionsGroup" name="name" value="{$item->getPermissionGroup()->get('name')}"/> 
        </td>
    </tr>     
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="error_pages">{$form.group_i18n.value->getError()}</div>
            <input type="text" size="10" class="PermissionsGroupI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->group_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".PermissionsGroup,.PermissionsGroupI18n").click(function() {  $('#PermissionsGroup-Save').show(); });            
         
     {* =================== L A N G U A G E ================================ *}
         $( "#PermissionsGroup-ChangeLang").click(function() {
            $("#PermissionsGroup-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".PermissionsGroupI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#PermissionsGroup-Cancel').click(function(){   
             $(".dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.PermissionsGroupI18n").attr('id'), token: "{mfForm::getToken('PermissionsGroupFormFilter')}" } },                              
                              url : "{url_to('users_guard_site_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-site-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#PermissionsGroup-Save').click(function(){                             
            var  params= {               
                                PermissionGroup: { 
                                   group_i18n : { lang: $(".PermissionsGroupI18n[name=lang]").attr('id')  },
                                   group : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.PermissionsGroupI18n").each(function() { params.PermissionGroup.group_i18n[this.name]=$(this).val(); });
          $("input.PermissionsGroup").each(function() {  params.PermissionGroup.group[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          $(".dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".PermissionsGroup-files",
                           url: "{url_to('users_guard_site_ajax',['action'=>'SaveNewPermissionGroupI18n'])}",
                           target: "#actions"}); 
        });  
     
</script>
