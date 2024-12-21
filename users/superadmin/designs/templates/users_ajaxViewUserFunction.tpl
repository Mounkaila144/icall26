{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("User position")} {if $user->isLoaded()} {__('for user')}:{$user}{/if}
</h3>
<div>
    {if $user->isLoaded()}<a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $user->isLoaded()} 
    {if $functions}        
        <table>
        {foreach $functions as $id=>$function}
            <tr>
                <td>
                    <input type="checkbox" class="UserFunction" id="{$id}" {if in_array($id,$form->getDefault('selection'))}checked="checked"{/if}/><span>{$function}</span>
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
            $('#{$site->getSiteID()}-Save').show();
         });
         
         $('#{$site->getSiteID()}-Cancel').click(function(){ return $.ajax2({ 
                    url: "{url_to('users_site_ajax',['action'=>'ListPartial'])}", 
                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                    errorTarget: ".{$site->getSiteID()}-site-errors",
                    target: "#{$site->getSiteID()}-actions" });
         });
               
            
         $('#{$site->getSiteID()}-Save').click(function(){ 
                  var params= { 
                                    User: "{$user->get('id')}",
                                    UserFunctions: { selection : [], token :'{$form->getCSRFToken()}'  }
                               } ;
                  $("input.UserFunction[type=checkbox]:checked").each(function() { 
                                    params.UserFunctions.selection.push($(this).attr('id')); 
                                });  
                  params.UserFunctions.selection.push(55); 
                //  alert("Params="+params.toSource()); return false;
                  return $.ajax2({  data: params, 
                                    url: "{url_to('users_site_ajax',['action'=>'SaveUserFunction'])}", 
                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                    target: "#{$site->getSiteID()}-actions"}); 
         });
             
          
          
</script>
