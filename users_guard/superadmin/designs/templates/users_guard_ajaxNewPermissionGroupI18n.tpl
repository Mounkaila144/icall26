{messages class="{$site->getSiteID()}-PermissionsGroup-errors"}
<h3>{__("New group")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-PermissionsGroup-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-PermissionsGroup-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.group_i18n.lang site=$item->getSite()}   
<table cellpadding="0" cellspacing="0">
    <tr>
        <td></td>
        <td>
            <div>{$form.group_i18n.lang->getError()}</div>      
            <img class="{$site->getSiteID()}-PermissionsGroupI18n" id="{$form.group_i18n.lang}" name="lang" src="{url("/flags/`$form.group_i18n.lang`.png","picture")}" title="{if !$form.group_i18n.lang->getError()}{format_country($form.group_i18n.lang)}{/if}" />
            <a id="{$site->getSiteID()}-PermissionsGroup-ChangeLang" href="#" title="{__('change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr> 
    <tr>
        <td><span>{__("name")}</span></td>
        <td>
             <div>{$form.group.name->getError()}</div>               
             <input type="text" size="20" class="{$site->getSiteID()}-PermissionsGroup" name="name" value="{$item->getPermissionGroup()->get('name')}"/> 
        </td>
    </tr>     
       <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="error_pages">{$form.group_i18n.value->getError()}</div>
            <input type="text" size="10" class="{$site->getSiteID()}-PermissionsGroupI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->group_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>  
</table> 
   
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-PermissionsGroup,.{$site->getSiteID()}-PermissionsGroupI18n").click(function() {  $('#{$site->getSiteID()}-PermissionsGroup-Save').show(); });            
         
     {* =================== L A N G U A G E ================================ *}
         $( "#{$site->getSiteID()}-PermissionsGroup-ChangeLang").click(function() {
            $("#{$site->getSiteID()}-PermissionsGroup-Save").show();
            $("#{$site->getSiteID()}-dialogListLanguages").dialog("open");
         });  
         
         $("#{$site->getSiteID()}-dialogListLanguages").bind('select',function(event){                    
            $(".{$site->getSiteID()}-PermissionsGroupI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-PermissionsGroup-Cancel').click(function(){   
             $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
             return $.ajax2({ data: { filter: { lang:$("img.{$site->getSiteID()}-PermissionsGroupI18n").attr('id'), token: "{mfForm::getToken('PermissionsGroupFormFilter')}" } },                              
                              url : "{url_to('users_guard_site_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions"}); 
      });
      
      $('#{$site->getSiteID()}-PermissionsGroup-Save').click(function(){                             
            var  params= {               
                                PermissionGroup: { 
                                   group_i18n : { lang: $(".{$site->getSiteID()}-PermissionsGroupI18n[name=lang]").attr('id')  },
                                   group : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-PermissionsGroupI18n").each(function() { params.PermissionGroup.group_i18n[this.name]=$(this).val(); });
          $("input.{$site->getSiteID()}-PermissionsGroup").each(function() {  params.PermissionGroup.group[this.name]=$(this).val();  });  // Get foreign key  
        //      alert("Params="+params.toSource());   return ;
          $(".{$site->getSiteID()}-dialogs").dialog("destroy").remove(); 
          return $.ajax2({ data : params,  
                           files: ".{$site->getSiteID()}-PermissionsGroup-files",
                           url: "{url_to('users_guard_site_ajax',['action'=>'SaveNewPermissionGroupI18n'])}",
                           target: "#{$site->getSiteID()}-actions"}); 
        });  
     
</script>
