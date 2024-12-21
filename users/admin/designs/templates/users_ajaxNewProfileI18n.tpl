{messages class="UserProfile-errors"}
<h3>{__("New Profile")}</h3>
<div>
    <a href="#" id="UserProfile-Save" class="btn" style="display:none">
         <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
         {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>
    <a href="#" id="UserProfile-Cancel" class="btn" >
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
<style> .ui-dialog { font-size: 62.5%; }</style> 
{component name="/site_languages/dialogListLanguagesFrontend" selected=(string)$form.profile_i18n.lang site=$item_i18n->getSite()}   
<table class="tab-form" cellspacing="0">
   <tr class="full-with">
        <td></td>
        <td>
            <div class="error-form">{$form.profile_i18n.lang->getError()}</div>      
            <img class="UserProfileI18n" id="{$form.profile_i18n.lang}" name="lang" src="{url("/flags/`$form.profile_i18n.lang`.png","picture")}" title="{if !$form.profile_i18n.lang->getError()}{format_country($form.profile_i18n.lang)}{/if}" />
            <a id="UserProfile-ChangeLang" href="#" title="{__('Change')}"><img  src="{url('/icons/edit.gif','picture')}" alt='{__("language")}'/></a> 
        </td>
    </tr>     
     {* <tr class="full-with">
         <td class="label"><span>{__("Name")}</span></td>
         <td>
            <div id="UserProfile-error_value" class="error-form">{$form.profile.name->getError()}</div>
            <input type="text" size="48" class="Fields UserProfile Input" name="name" value="{$item_i18n->getProfile()->get('name')}"/>    
            {if $form->profile.name->getOption('required')}*{/if} 
         </td>
    </tr>  *} 
       <tr class="full-with">
         <td class="label"><span>{__("Profile")}</span></td>
         <td>
            <div class="error-form">{$form.profile_i18n.value->getError()}</div>
            <input type="text" size="48" class="Fields UserProfileI18n Input" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->profile_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr> 
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
     $(".UserProfile,.UserProfileI18n").click(function() {  $('#UserProfile-Save').show(); });           
         
     {* =================== L A N G U A G E ================================ *}
         $( "#UserProfile-ChangeLang").click(function() {
            $("#UserProfile-Save").show();
            $("#dialogListLanguages").dialog("open");
         });  
         
         $("#dialogListLanguages").bind('select',function(event){                    
            $(".UserProfileI18n[name=lang]").attr({
                                  id: event.selected.id,
                                  src: '{url("/flags/","picture")}'+event.selected.id+'.png',
                                  title: event.selected.lang
                                  });         
         }); 
     
     
     {* =================== A C T I O N S ================================ *}
     $('#UserProfile-Cancel').click(function(){                
             return $.ajax2({ data: { filter: { lang:$("img.UserProfileI18n").attr('id'), token: "{mfForm::getToken('UserProfileFormFilter')}" } },                              
                              url : "{url_to('users_ajax',['action'=>'ListPartialProfile'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#UserProfile-Save').click(function(){                             
            var  params= {      UserProfile: { 
                                   profile_i18n : { lang: $(".UserProfileI18n[name=lang]").attr('id')  },
                                   profile : { },
                                   functions : [], groups : [],
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".UserProfileI18n.Input").each(function() { params.UserProfile.profile_i18n[$(this).attr('name')]=$(this).val(); });    
          $(".UserProfile.Input").each(function() { params.UserProfile.profile[$(this).attr('name')]=$(this).val(); });       
          $(".UserProfile.Select option:selected").each(function() { params.UserProfile.profile[$(this).parent().attr('name')]=$(this).val(); });       
          $(".UserProfileFunction.Checkbox:checked").each(function() { params.UserProfile.functions.push($(this).attr('id')); }); 
          $(".UserProfileGroup.Checkbox:checked").each(function() { params.UserProfile.groups.push($(this).attr('id')); });
        //      alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                           
                           url: "{url_to('users_ajax',['action'=>'SaveNewProfileI18n'])}",
                           target: "#actions"}); 
        });  
     
</script>
