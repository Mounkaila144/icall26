{messages class="site-errors"}
<h3>{__("Edit user")}</h3>
<div>
    {if $user->hasCredential([['superadmin','admin','settings_user_modify']])}
    {if $item->isLoaded()}<a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    {/if}
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()} 
   <table cellpadding="0" cellspacing="0">
         <tr>
           <td>{__("title")}</td>
           <td>              
               <div>{$form.sex->getError()}</div> 
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
             <td>{__("username")}</td>
             <td> 
                 <div>{$form.username->getError()}</div> 
                 <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if}name="username" value="{$item->get('username')|escape}" size="30"/>{if $form->username->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("firstname")}</td>
             <td>
                <div>{$form.firstname->getError()}</div>  
                <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="firstname" value="{$item->get('firstname')|escape}" size="30"/>{if $form->firstname->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("lastname")}</td>
             <td> 
                 <div>{$form.lastname->getError()}</div> 
                 <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="lastname" value="{$item->get('lastname')|escape}" size="30"/>{if $form->lastname->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("email")}</td>
             <td> 
                 <div>{$form.email->getError()}</div> 
                 <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="email" value="{$item->get('email')|escape}" size="30"/>{if $form->email->getOption('required')}*{/if}
             </td>
         </tr> 
            <tr>
        <td>{__("mobile")}</td>
        <td> 
            <div>{$form.mobile->getError()}</div> 
            <input type="text" class="User" {if !$user->hasCredential([['superadmin','admin','settings_user_modify']])}disabled="disabled"{/if} name="mobile" value="{$item->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
        </td>
    </tr>          
          <tr>
             <td>{__("updated at")}</td>
             <td> 
                 <span>{$item->get('updated_at')|escape}</span>
             </td>
         </tr>   
         <tr>
             <td>{__("last login")}</td>
             <td> 
                 <span>{$item->get('lastlogin')|escape}</span>
             </td>
         </tr>      
         <tr>
             <td>{__("last password generated")}</td>
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
                    url: "{url_to('users_ajax',['action'=>'ListPartial'])}", 
                    loading: "#tab-site-dashboard-x-settings-loading",
                    errorTarget: ".site-errors",
                    target: "#actions" });
         });
         
         $(".User").click(function() { $("#Save").show(); });
            
         $('#Save').click(function(){ 
                  var params= { User: { 
                                        id: "{$item->get('id')}", 
                                        team_id:  $(".User[name=team_id] option:selected").val(), 
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.User[type=text]").each(function() { params.User[this.name]=this.value; });                  
                  $("input.User[type=radio]:checked").each(function() { params.User[this.name]=$(this).val(); }); 
                  return $.ajax2({  data: params, 
                                    url: "{url_to('users_ajax',['action'=>'SaveUser'])}", 
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                    errorTarget: ".site-errors",
                                    target: "#actions"}); 
         });
             
          
          
</script>
