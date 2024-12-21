{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("Create password for user [%s]",(string)$user)}</h3>
<div>
    {if $user->isLoaded()}<a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $user->isLoaded()} 
   <table cellpadding="0" cellspacing="0">                
         <tr>
             <td>{__("Password")}</td>
             <td> 
                 <div>{$form.password->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-User" name="password" value="{$form.password}" size="30"/>{if $form->password->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("Re-password")}</td>
             <td>
                <div>{$form.repassword->getError()}</div>  
                <input type="text" class="{$site->getSiteID()}-User" name="repassword" value="{$form.repassword}" size="30"/>{if $form->repassword->getOption('required')}*{/if}
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
                                        token :'{$form->getCSRFToken()}' 
                                     } };
                  $("input.{$site->getSiteID()}-User").each(function() { params.User[this.name]=this.value; });                              
                  return $.ajax2({  data: params, 
                                    url: "{url_to('users_site_ajax',['action'=>'SaveCreatePasswordUser'])}", 
                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                    target: "#{$site->getSiteID()}-actions"}); 
         });
             
          
          
</script>