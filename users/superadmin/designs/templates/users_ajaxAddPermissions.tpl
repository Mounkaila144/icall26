{messages class="{$site->getSiteID()}-site-errors"}
{if  $user->isLoaded()}
    <h3>{__('user')|capitalize} : {$user->get('username')} [{$user}] - {__('permissions')|capitalize}</h3>    
    <div>
        <a href="#" id="Save" style="display:none;"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
        <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div> 
    <div style="overflow-y:auto; width: 200px;">
        {foreach $permissions as $permission}
            <div class="{if $permission->get('user_id')}active{else}field{/if}" id="{$permission->get('id')}">
                <span>{$permission->name}</span>    
            </div>
        {/foreach}
    </div> 
    <input type="checkbox" id="all" /><span>{__("selection")}</span>
{else}
    {__("user doesn't exist")}
{/if}    
<script type="text/javascript">
        
          $('.field').click(function() { 
                    $(this).toggleClass('selected'); 
                    $('#Save').show();
          });
          
          $("#all").click(function () {  $(".field").toggleClass('selected');  $('#Save').show();  });
            
          $('#Cancel').click(function(){ 
              return $.ajax2({ data: { User : "{$user->get('id')}" }, 
                                       url: "{url_to('users_site_ajax',['action'=>'PermissionsList'])}",
                                       errorTarget: ".{$site->getSiteID()}-site-errors",
                                       target: "#{$site->getSiteID()}-actions" });
          });
          
          $("#Save").click(function (){ 
                     params= { Permissions: { selection : new Array(),user_id : "{$user->get('id')}",token: "{mfForm::getToken('AddPermissionsUserForm')}" } };
                     $(".field.selected").each(function(id) { params.Permissions.selection[id]= this.id; });  
                     return $.ajax2({ data: params, 
                                      url: "{url_to('users_site_ajax',['action'=>'AddPermissionsSave'])}",
                                      errorTarget: ".{$site->getSiteID()}-site-errors",
                                      target: "#{$site->getSiteID()}-actions" });
          });
</script>