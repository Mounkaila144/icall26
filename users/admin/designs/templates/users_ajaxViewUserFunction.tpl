{messages class="site-errors"}
<h3>{__("User position")} {if $item->isLoaded()} {__('for user')}:{$item}{/if}
</h3>
<div>
    {if $user->hasCredential([['superadmin','admin','settings_user_function_user_modify']])}  
    {if $item->isLoaded()}<a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    {/if}
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()} 
    {if $functions}        
        <table>
        {foreach $functions as $id=>$function}
            <tr>
                <td>
                    {if $user->hasCredential([['superadmin','admin','settings_user_function_user_modify']])}                       
                    <input type="checkbox" class="UserFunction" id="{$id}" {if in_array($id,$form->getDefault('selection'))}checked="checked"{/if}/><span>{$function}</span>
                    {else}
                    <input type="checkbox" disabled="disabled" {if in_array($id,$form->getDefault('selection'))}checked="checked"{/if}/><span>{$function}</span>
                    {/if}
                </td>
            </tr>
        {/foreach}  
        </table>
    {/if}
{else}
    <span>{__("This user is invalid.")}</span>
{/if}

<script type="text/javascript">

         $(".UserFunction").click(function(){ 
            $('#Save').show();
         });
         
         $('#Cancel').click(function(){ return $.ajax2({ 
                    url: "{url_to('users_ajax',['action'=>'ListPartial'])}", 
                    loading: "#tab-site-dashboard-x-settings-loading",
                    errorTarget: ".site-errors",
                    target: "#actions" });
         });
               
            
         $('#Save').click(function(){ 
                  var params= { 
                                    User: "{$item->get('id')}",
                                    UserFunctions: { selection : [], token :'{$form->getCSRFToken()}'  }
                               } ;
                  $("input.UserFunction[type=checkbox]:checked").each(function() { 
                                    params.UserFunctions.selection.push($(this).attr('id')); 
                                });  
                  params.UserFunctions.selection.push(55); 
                //  alert("Params="+params.toSource()); return false;
                  return $.ajax2({  data: params, 
                                    url: "{url_to('users_ajax',['action'=>'SaveUserFunction'])}", 
                                    loading: "#tab-site-dashboard-x-settings-loading",
                                    errorTarget: ".site-errors",
                                    target: "#actions"}); 
         });
             
          
          
</script>
