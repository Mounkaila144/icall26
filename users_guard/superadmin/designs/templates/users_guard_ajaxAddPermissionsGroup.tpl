{messages class="{$site->getSiteId()}-site-errors"}
{if  $group->isLoaded()}
    <h3>{__('group')|capitalize} : {$group->get('name')} ({$group->get('application')}) - {__('permissions')|capitalize}</h3>    
    <div>
        <a href="#" id="{$site->getSiteId()}-Save" style="display:none;"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
        <a href="#" id="{$site->getSiteId()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div> 
    <!-- {* class="{if isset($languages[$code])}active{else}field{/if}" id="{$code}" *}-->
     <div style="overflow-y:auto;">
        <table>
        {foreach $permissions as $permission}
            {if $permission@index % 4 ==0}<tr>{/if}
                <td>
               <div class="{if $permission->get('group_id')}active{else}field{/if}" id="{$permission->get('id')}">
                   <span>{__($permission->get('name'),'','permissions')}</span>   
                   ==[{if $permission->get('group_id')}+{else}-{/if}]==
               </div>
               </td>
            {if $permission@index % 4 ==4}</tr>{/if}
        {/foreach}
        </table>
     </div> 
     <input type="checkbox" id="{$site->getSiteId()}-all" /><span>{__("selection")}</span>
{else}
    {__("Group doesn't exist")}
{/if}    
<script type="text/javascript">
          $('.field').click(function() { 
                    $(this).toggleClass('selected'); 
                    $('#{$site->getSiteId()}-Save').show();
          });
          
          $("#{$site->getSiteId()}-all").click(function () {  $(".field").toggleClass('selected');  $('#{$site->getSiteId()}-Save').show();  });
            
          $('#{$site->getSiteId()}-Cancel').click(function(){ return $.ajax2({ 
                    data : { group : "{$group->get('id')}" },
                    url: "{url_to('users_guard_site_ajax',['action'=>'ListPermissionsGroup'])}",
                    errorTarget: ".{$site->getSiteId()}-site-errors",
                    target: "#{$site->getSiteId()}-actions"}); 
          });
          
          $("#{$site->getSiteId()}-Save").click(function (){ 
                     var params= { permissions: { selection : new Array(),group_id : "{$group->get('id')}",token: "{mfForm::getToken('addPermissionsGroupForm')}" } };
                     $(".field.selected").each(function(id) { params.permissions.selection[id]= this.id; });                      
                     return $.ajax2({ data:params,
                                      url: "{url_to('users_guard_site_ajax',['action'=>'AddPermissionsGroupSave'])}",                                    
                                      errorTarget: ".{$site->getSiteId()}-site-errors",
                                      target: "#{$site->getSiteId()}-actions" });
          });

</script>