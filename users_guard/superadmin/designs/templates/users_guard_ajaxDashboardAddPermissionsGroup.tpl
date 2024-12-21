{messages class="errors"}
<h3>{__('group')|capitalize} : {$group->get('name')} - {__('permissions')|capitalize}</h3>    
<div>
    <a href="#" id="Save" style="display:none;"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div> 
{if  $group->isLoaded()}
    <div style="overflow-y:auto; width: 200px;">
        {foreach $permissions as $permission}
            <div class="{if $permission->get('group_id')}active{else}field{/if}" id="{$permission->get('id')}">
                <span>{$permission->name}</span>    
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
            
          $('#Cancel').click(function(){ return $.ajax2({ data: { group : "{$group->get('id')}" }, 
          url: "{url_to('users_guard_ajax',['action'=>'DashboardListPermissionsGroup'])}",
           loading: "#tab-dashboard-superadmin-loading",
          target: "#actions"}); });
          
          $("#Save").click(function (){ 
                     var params= { permissions : { selection : [],group_id : "{$group->get('id')}",token: "{mfForm::getToken('addPermissionsGroupForm')}" } };
                     $(".field.selected").each(function(id) { params.permissions.selection[id]= this.id; }); 
                     return $.ajax2({ data: params,
                     url: "{url_to('users_guard_ajax',['action'=>'DashboardAddPermissionsGroupSave'])}",
                      loading: "#tab-dashboard-superadmin-loading",
                     target: "#actions"});
          });
</script>