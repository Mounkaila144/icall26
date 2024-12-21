{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("Edit user")}</h3>
<div>
    {if $user->isLoaded()}<a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $user->isLoaded()} 
   <table cellpadding="0" cellspacing="0">
         <tr>
           <td>{__("title")}</td>
           <td>
               <div>{$form.sex->getError()}</div> 
                {foreach $form->sex->getOption("choices") as $name=>$gender}
                        <input type="radio" class="{$site->getSiteID()}-User" name="sex" value="{$name}" {if $user->get('sex')==$name}checked="checked"{/if}/>
                        <span>{format_gender($gender,1,true)|capitalize}</span>
                 {/foreach} 
           </td>
          </tr>       
         <tr>
             <td>{__("username")}</td>
             <td> 
                 <div>{$form.username->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-User" name="username" value="{$user->get('username')|escape}" size="30"/>{if $form->username->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("firstname")}</td>
             <td>
                <div>{$form.firstname->getError()}</div>  
                <input type="text" class="{$site->getSiteID()}-User" name="firstname" value="{$user->get('firstname')|escape}" size="30"/>{if $form->firstname->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("lastname")}</td>
             <td> 
                 <div>{$form.lastname->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-User" name="lastname" value="{$user->get('lastname')|escape}" size="30"/>{if $form->lastname->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("email")}</td>
             <td> 
                 <div>{$form.email->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-User" name="email" value="{$user->get('email')|escape}" size="30"/>{if $form->email->getOption('required')}*{/if}
             </td>
         </tr> 
          <tr>
        <td>{__("mobile")}</td>
        <td> 
            <div>{$form.mobile->getError()}</div> 
            <input type="text" class="{$site->getSiteID()}-User" name="mobile" value="{$user->get('mobile')|escape}" size="30"/>{if $form->mobile->getOption('required')}*{/if}
        </td>
    </tr>         
          <tr>
             <td>{__("updated at")}</td>
             <td> 
                 <span>{$user->get('updated_at')|escape}</span>
             </td>
         </tr>   
         <tr>
             <td>{__("last login")}</td>
             <td> 
                 <span>{$user->get('lastlogin')|escape}</span>
             </td>
         </tr>      
         <tr>
             <td>{__("last password generated")}</td>
             <td> 
                 <span>{$user->get('last_password_gen')|escape}</span>
             </td>
         </tr>                          
    </table>  
{else}
    <span>{__("This user is invalid.")}</span>
{/if}

<script type="text/javascript">

         $('#{$site->getSiteID()}-Cancel').click(function(){ return $.ajax2({ 
                    url: "{url_to('users_site_ajax',['action'=>'ListPartial'])}", 
                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                    errorTarget: ".{$site->getSiteID()}-site-errors",
                    target: "#{$site->getSiteID()}-actions" });
         });
         
         $(".{$site->getSiteID()}-User").click(function() { $("#{$site->getSiteID()}-Save").show(); });
            
         $('#{$site->getSiteID()}-Save').click(function(){ 
                  var params= { User: { 
                                        id: "{$user->get('id')}", 
                                        team_id:  $(".{$site->getSiteID()}-User[name=team_id] option:selected").val(), 
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.{$site->getSiteID()}-User[type=text]").each(function() { params.User[this.name]=this.value; });                  
                  $("input.{$site->getSiteID()}-User[type=radio]:checked").each(function() { params.User[this.name]=$(this).val(); }); 
                  return $.ajax2({  data: params, 
                                    url: "{url_to('users_site_ajax',['action'=>'SaveUser'])}", 
                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                    target: "#{$site->getSiteID()}-actions"}); 
         });
             
          
          
</script>
