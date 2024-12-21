{messages class="site-errors"}
<h3>{__("Edit permission")}</h3>
<div>
    {if $permission->isLoaded()}<a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

{if $permission->isLoaded()}
    <table cellpadding="0" cellspacing="0">
         <tr>
             <td>{__("name")}</td>
             <td> 
                 <div>&nbsp;{$form->getErrorSchema()->getError('name')}</div> 
                 <input type="text" class="Permissions" name="name" value="{$permission->get('name')|escape}" size="30"/>{if $form->getValidator('name')->getOption('required')}*{/if}
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
    
         $('# Cancel').click(function(){ return $.ajax2({ 
                            loading: "#tab-site-dashboard-x-settings-loading",
                            url: "{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",
                            errorTarget: ".site-errors",
                            target: "#actions"
                        }); 
         });
        
         {if $permission->isLoaded()}
            $(".permissions").click(function() { 
                $("#Save").show();
            });
            
            $('#Save').click(function() { 
                 var params= { Permission : { 
                                       id : "{$permission->get('id')}",
                                       token : '{$form->getCSRFToken()}' 
                                    } }; 
             
                   $("input.Permissions").each(function() {  params.Permission[this.name]=this.value; });
                   return $.ajax2({ data:params, 
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                    url: "{url_to('users_guard_ajax',['action'=>'SavePermission'])}",
                                    errorTarget: ".site-errors",
                                    target: "#actions"}); 
                   
            });  
             
         {/if}   
          
</script>

