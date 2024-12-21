{messages class="site-errors"}
{if  $group->isLoaded()}
    <h3>{__('Group')} : {$group->get('name')} {__('permissions')|capitalize}</h3>    
    <div>
        <a href="#" id="Save" style="display:none;"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
        <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div> 
    <!-- {* class="{if isset($languages[$code])}active{else}field{/if}" id="{$code}" *}-->
     <div style="overflow-y:auto;">        
        {foreach $group_permissions as $group_permission}
            <div>
                {if $group_permission->isLoaded()}
                    <h4>{$group_permission->get('name')}</h4>                  
                {else}
                    <h4>{__('Not defined')}</h4>
                {/if}
                {if $group_permission->hasPermissions()}
                 <table>                     
                    {foreach $group_permission->getSortedPermissions() as $permission}
                        {if $permission@index % 4 ==0}<tr>{/if}
                            <td>
                           <div class="{if $permission->get('group_id')}active{else}field{/if}" id="{$permission->get('id')}">
                               <span>{__($permission->get('name'),'','permissions')}</span>    
                           </div>
                           </td>
                        {if $permission@index % 4 ==4}</tr>{/if}
                    {/foreach}    
                    </table>
                 {else}
                     {__('No permission in this group.')}
                 {/if}   
            </div>
        {/foreach} 
     </div> 
     <input type="checkbox" id="all" /><span>{__("selection")}</span>
{else}
    {__("Group doesn't exist")}
{/if}    
<script type="text/javascript">
          $('.field').click(function() { 
                    $(this).toggleClass('selected'); 
                    $('#Save').show();
          });
          
          $("#all").click(function () {  $(".field").toggleClass('selected');  $('#Save').show();  });
            
          $('#Cancel').click(function(){ return $.ajax2({ 
                    data : { group : "{$group->get('id')}" },
                    url: "{url_to('users_guard_site_ajax',['action'=>'ListPermissionsGroup'])}",
                    errorTarget: ".site-errors",
                    target: "#actions"}); 
          });
          
          $("#Save").click(function (){ 
                     var params= { permissions: { selection : new Array(),group_id : "{$group->get('id')}",token: "{mfForm::getToken('addPermissionsGroupForm')}" } };
                     $(".field.selected").each(function(id) { params.permissions.selection[id]= this.id; });                      
                     return $.ajax2({ data:params,
                                      url: "{url_to('users_guard_site_ajax',['action'=>'AddPermissionsGroupSave'])}",                                    
                                      errorTarget: ".site-errors",
                                      target: "#actions" });
          });

</script>