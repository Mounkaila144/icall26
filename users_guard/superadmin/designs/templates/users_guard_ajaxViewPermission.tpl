{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("Edit permission")}</h3>
<div>
    {if $permission->isLoaded()}<a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

{if $permission->isLoaded()}
    <table cellpadding="0" cellspacing="0">
         <tr>
             <td>{__("name")}</td>
             <td> 
                 <div>&nbsp;{$form.name->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Permissions" name="name" value="{$permission->get('name')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("group")}</td>
             <td> 
                 {html_options name="group_id" class="{$site->getSiteID()}-Permissions" selected=$permission->get('group_id')}
            </td>
         </tr>            
         <tr>
             <td>{__("created at")}</td>
             <td> 
                 <span>{$permission->get('created_at')|escape}</span>
             </td>
         </tr>   
         <tr>
             <td>{__("updated at")}</td>
             <td> 
                 <span>{$permission->get('updated_at')|escape}</span>
             </td>
         </tr>               
    </table>  
{else}
    <span>{__("this permission doesn't exist")}</span>
{/if} 
<script type="text/javascript">
    
         $('#{$site->getSiteID()}-Cancel').click(function(){ return $.ajax2({ 
                            loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                            url: "{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",
                            errorTarget: ".{$site->getSiteID()}-site-errors",
                            target: "#{$site->getSiteID()}-actions"
                        }); 
         });
        
         {if $permission->isLoaded()}
            $(".{$site->getSiteID()}-permissions").click(function() { 
                $("#{$site->getSiteID()}-Save").show();
            });
            
            $('#{$site->getSiteID()}-Save').click(function() { 
                 var params= { Permission : { 
                                       id : "{$permission->get('id')}",
                                       token : '{$form->getCSRFToken()}' 
                                    } }; 
             
                   $("input.{$site->getSiteID()}-Permissions").each(function() {  params.Permission[this.name]=this.value; });
                   return $.ajax2({ data:params, 
                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                    url: "{url_to('users_guard_ajax',['action'=>'SavePermission'])}",
                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                    target: "#{$site->getSiteID()}-actions"}); 
                   
            });  
             
         {/if}   
          
</script>

