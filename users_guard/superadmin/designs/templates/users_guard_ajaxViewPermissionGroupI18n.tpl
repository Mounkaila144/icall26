{messages class="{$site->getSiteID()}-PermissionsGroup-errors"}
<h3>{__("View permissions group")|capitalize}</h3>
<div>
    <a href="#" id="PermissionsGroup-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="PermissionsGroup-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table>
    <tr>
        <td>{__('id')}</td>
        <td>{if $item->isLoaded()} 
            <span>{$item->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr>
    <tr>
        <td></td>
        <td><img id="{$item->get('lang')}" name="lang" src="{url("/flags/`$item->get('lang')`.png","picture")}" title="{format_country($item->get('lang'))}" />       
        </td>
    </tr>
     <tr>
        <td><span>{__("name")}</span>
        </td>
        <td><div id="PermissionsGroup-error_name">{$form.group.name->getError()}</div>  
            <input type="text" class="PermissionsGroup" name="name" size="48" value="{$item->getPermissionGroup()->get('name')}"/> 
        </td>
    </tr>          
    <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="PermissionsGroup-error_value">{$form.group_i18n.value->getError()}</div>
            <input type="text" size="10" class="PermissionsGroupI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->group_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>


<script type="text/javascript">
    
      
     {* =================== F I E L D S ================================ *}
     $(".PermissionsGroup,.PermissionsGroupI18n").click(function() {  $('#PermissionsGroup-Save').show(); });    
         
     {* =================== A C T I O N S ================================ *}
     $('#PermissionsGroup-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('PermissionsGroupFormFilter')}" } },                              
                              url : "{url_to('users_guard_site_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                              errorTarget: ".{$site->getSiteID()}-PermissionsGroup-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#PermissionsGroup-Save').click(function(){                             
            var  params= {            
                                PermissionGroupI18n: { 
                                   group_i18n : { lang: "{$item->get('lang')}",group_id: "{$item->get('group_id')}"    },
                                   group : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.PermissionsGroupI18n").each(function() { params.PermissionGroupI18n.group_i18n[this.name]=$(this).val(); });
          $("input.PermissionsGroup").each(function() {  params.PermissionGroupI18n.group[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".PermissionsGroup-files",
                           errorTarget: ".{$site->getSiteID()}-PermissionsGroup-errors",
                           url: "{url_to('users_guard_site_ajax',['action'=>'SavePermissionGroupI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>