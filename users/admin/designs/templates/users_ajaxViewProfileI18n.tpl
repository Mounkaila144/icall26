{messages class="UserProfile-errors"}
<h3>{__("View Profile")|capitalize}</h3>
<div>
    <a href="#" id="UserProfile-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="UserProfile-Cancel" class="btn">
          <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
            <a href="#" id="UserProfile-Process" class="btn">
          <i class="fa fa-cog" style="color:#000;margin-right:10px;"></i>{__('Process')}</a>
</div>
<table class="tab-form">
  {*  <tr>
        <td>{__('id')}</td>
        <td>{if $item_i18n->isLoaded()} 
            <span>{$item_i18n->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr> *}
    <tr class="full-with">
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
    {*<tr  class="full-with">
        <td class="label"><span>{__("Name")}</span></td>
         <td>
             <div id="UserProfile-error_value" class="error-form">{$form.profile.name->getError()}</div>
            <input type="text" size="48" class="Fields UserProfile Input" name="name" value="{$item_i18n->getProfile()->get('name')}"/>    
            {if $form->profile.name->getOption('required')}*{/if} 
         </td>
    </tr> *}      
    <tr  class="full-with">
         <td class="label"><span>{__("Profile")}</span></td>
         <td>
            <div id="UserProfile-error_value" class="error-form">{$form.profile_i18n.value->getError()}</div>
            <input type="text" size="48" class="Fields UserProfileI18n Input" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->profile_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>     
</table>
 </table>    
<h4>{__('Functions')}</h4>
<div class="error-form">{$form.functions->getError()}</div>
{if $form->functions->getOption('choices')}        
    <table class="tab-form">
    {foreach $form->functions->getOption('choices') as $id=>$function}
        <tr>
            <td>
                <input type="checkbox" class="Fields UserProfileFunction Checkbox" id="{$id}" {if in_array($id,$form->getDefault('functions'))}checked="checked"{/if}/><span>{$function}</span>
            </td>
        </tr>
    {/foreach}  
    </table>
{/if}

<h4>{__('Groups')}</h4>
<div class="error-form">{$form.groups->getError()}</div>
  {if $form->groups->getOption('choices')}        
        <table class="tab-form">
        {foreach $form->groups->getOption('choices') as $id=>$group}
            <tr>
                <td>                  
                    <input type="checkbox" class="Fields UserProfileGroup Checkbox" id="{$id}" {if in_array($id,$form->getDefault('groups'))}checked="checked"{/if}/><span>{$group}</span>
                </td>
            </tr>
        {/foreach}  
        </table>
    {/if}


<script type="text/javascript">
          
     {* =================== F I E L D S ================================ *}
     $(".Fields").click(function() {  $('#UserProfile-Save').show(); });    
        
    
     {* =================== A C T I O N S ================================ *}
     $('#UserProfile-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item_i18n->get('lang')}", token: "{mfForm::getToken('UserProfileFormFilter')}" } },                              
                              url : "{url_to('users_ajax',['action'=>'ListPartialProfile'])}",
                              errorTarget: ".UserProfile-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#UserProfile-Save').click(function(){                             
            var  params= {            
                                UserProfileI18n: { 
                                   profile : { },
                                   functions : [], groups : [],
                                   profile_i18n : { lang: "{$item_i18n->get('lang')}",profile_id: "{$item_i18n->get('profile_id')}"    },                                 
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".UserProfileI18n.Input").each(function() { params.UserProfileI18n.profile_i18n[$(this).attr('name')]=$(this).val(); });    
          $(".UserProfile.Input").each(function() { params.UserProfileI18n.profile[$(this).attr('name')]=$(this).val(); });       
          $(".UserProfile.Select option:selected").each(function() { params.UserProfileI18n.profile[$(this).parent().attr('name')]=$(this).val(); });       
          $(".UserProfileFunction.Checkbox:checked").each(function() { params.UserProfileI18n.functions.push($(this).attr('id')); }); 
          $(".UserProfileGroup.Checkbox:checked").each(function() { params.UserProfileI18n.groups.push($(this).attr('id')); });
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".UserProfile-errors",
                           url: "{url_to('users_ajax',['action'=>'SaveProfileI18n'])}",
                           target: "#actions" }); 
        });  
   

     $('#UserProfile-Process').click(function(){                              
            var  params= {  UserProfile:  "{$item_i18n->get('profile_id')}"     };
           
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".UserProfile-errors",
                           url: "{url_to('users_ajax',['action'=>'ProcessProfile'])}",
                           target: "#actions" 
                        }); 
        });  
</script>