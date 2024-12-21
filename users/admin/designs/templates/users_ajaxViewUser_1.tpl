{messages class="site-errors"}
<h3>{__("Edit user")}</h3>
<div>
    {if $user->hasCredential([['superadmin','admin','settings_user_modify']])}
        {if $item->isLoaded()}<a href="#" id="Save" class="btn" style="display:none">  <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
            {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('save')}</a>{/if}
    {/if}
    <a href="#" id="Cancel" class="btn">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
         {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('cancel')}</a>
</div>
{if $item->isLoaded()} 
   <table class="tab-form" cellspacing="0">
         <tr>
             <td class="label">{__("title")}</td>
           <td>              
               <div class="error-form">{$form.sex->getError()}</div> 
                {foreach $form->sex->getOption("choices") as $name=>$gender}
                        {if $user->hasCredential([['superadmin','admin','settings_user_modify']])}
                        <input type="radio" class="User" name="sex" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        {else}
                        <input type="radio" name="sex" disabled="disabled" value="{$name}" {if $item->get('sex')==$name}checked="checked"{/if}/>
                        {/if}    
                        <span>{format_gender($gender,1,true)|capitalize}</span>
                 {/foreach}                
   
           </td>
          </tr>       
         <tr>
             <td class="label">{__("username")}</td>
             <td> 
                 <div class="error-form">{$form.username->getError()}</div> 
                 <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if}name="username" value="{$item->get('username')|escape}" size="30"/>{if $form->username->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td class="label">{__("firstname")}</td>
             <td>
                <div class="error-form">{$form.firstname->getError()}</div>  
                <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="firstname" value="{$item->get('firstname')|escape}" size="30"/>{if $form->firstname->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td class="label">{__("lastname")}</td>
             <td> 
                 <div class="error-form">{$form.lastname->getError()}</div> 
                 <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="lastname" value="{$item->get('lastname')|escape}" size="30"/>{if $form->lastname->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td class="label">{__("email")}</td>
             <td> 
                 <div class="error-form">{$form.email->getError()}</div> 
                 <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="email" value="{$item->get('email')|escape}" size="30"/>{if $form->email->getOption('required')}*{/if}
             </td>
         </tr> 
        <tr>
             <td class="label">{__("code by email")}</td>
             <td>                  
                 <input type="checkbox" class="User Checkbox" value="true"  name="is_secure_by_code" {if $item->isSecureByCode()}checked=""{/if}/>{if $form->is_secure_by_code->getOption('required')}*{/if}
             </td>
        </tr>  
            <tr>
        <td class="label">{__("mobile")}</td>
        <td> 
            <div class="error-form">{$form.mobile->getError()}</div> 
            <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="mobile" value="{$item->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
        </td>
    </tr>    
    {if $user_settings->hasCallcenter()}
                   <tr>
                    <td class="label">{__('Callcenter')}
                    </td>
                    <td>
                       {if $form->hasValidator('callcenter_id')}
                         <div>{$form.callcenter_id->getError()}</div> 
                         {html_options class="User" name="callcenter_id" options=$form->callcenter_id->getOption('choices') selected=$item->get('callcenter_id')}
                       {else}
                           <span>{if $item->hasCallcenter()}{$item->getCallcenter()->get('name')|upper}{else}{__('No callcenter')}{/if}</span>
                       {/if}
                    </td>
                </tr> 
     {/if}
    {if $form->hasValidator('company_id')}
    <tr>
        <td class="label">{__('Company')}</td>
        <td>
            <div class="error-form">{$form.company_id->getError()}</div> 
            {html_options  class="User Select" name="company_id" options=$form->company_id->getChoices()->toArray() selected=$item->get('company_id')}
        </td>
    </tr>
    {/if}
          <tr>
             <td class="label">{__("updated at")}</td>
             <td> 
                 <span>{$item->get('updated_at')|escape}</span>
             </td>
         </tr>   
         <tr>
             <td class="label">{__("last login")}</td>
             <td> 
                 <span>{$item->get('lastlogin')|escape}</span>
             </td>
         </tr>      
         <tr>
             <td class="label">{__("last password generated")}</td>
             <td> 
                 <span>{$item->get('last_password_gen')|escape}</span>
             </td>
         </tr>                          
    </table>  
{else}
    <span>{__("This user is invalid.")}</span>
{/if}

<script type="text/javascript">

         $('#Cancel').click(function(){ return $.ajax2({ 
                    data : { filter : {$filter->toJson()} },
                    url: "{url_to('users_ajax',['action'=>'ListPartial'])}", 
                    loading: "#tab-site-dashboard-x-settings-loading",
                    errorTarget: ".site-errors",
                    target: "#actions" });
         });
         
         $(".User").click(function() { $("#Save").show(); });
            
         $('#Save').click(function(){              
                  var params= { filter : {$filter->toJson()} ,
                                User: { 
                                        id: "{$item->get('id')}", 
                                        team_id:  $(".User[name=team_id] option:selected").val(), 
                                        callcenter_id:  $(".User[name=callcenter_id] option:selected").val(), 
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.User[type=text]").each(function() { params.User[this.name]=this.value; });                  
                  $("input.User[type=radio]:checked").each(function() { params.User[this.name]=$(this).val(); }); 
                  $("input.User[type=checkbox]:checked").each(function() { params.User[this.name]=$(this).val(); }); 
                  $(".User.Select option:selected").each(function() { params.User[$(this).parent().attr('name')]=$(this).val(); }); 
                  return $.ajax2({  data: params, 
                                    url: "{url_to('users_ajax',['action'=>'SaveUser'])}", 
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                    errorTarget: ".site-errors",
                                    target: "#actions"}); 
         });
             
          
          
</script>
