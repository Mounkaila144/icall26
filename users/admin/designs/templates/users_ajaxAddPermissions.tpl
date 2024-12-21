{messages class="site-errors"}
{if  $user->isLoaded()}
    <h3>{__('user')|capitalize} : {$user->get('username')} [{$user}] - {__('permissions')|capitalize}</h3>    
    <div>
        <a href="#" id="Save" style="display:none;"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
        <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div> 
    <div style="overflow-y:auto;">
        <table>
        {foreach $permissions as $permission}
            {if $permission@index % 5 ==0}<tr>{/if}
                <td>
            <div class="{if $permission->get('user_id')}active{else}field{/if}" id="{$permission->get('id')}">
                <span>{__($permission->get('name'),'','permissions')}</span>    
            </div>
            </td>
            {if $permission@index % 5 ==5}</tr>{/if}
        {/foreach}
        </table>
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
                                       url: "{url_to('users_ajax',['action'=>'PermissionsList'])}",
                                       errorTarget: ".site-errors",
                                       target: "#actions" });
          });
          
          $("#Save").click(function (){ 
                     params= { permissions: { selection : new Array(),user_id : "{$user->get('id')}",token: "{mfForm::getToken('AddPermissionsUserForm')}" } };
                     $(".field.selected").each(function(id) { params.permissions.selection[id]= this.id; });  
                     return $.ajax2({ data: params, 
                                      url: "{url_to('users_ajax',['action'=>'AddPermissionsSave'])}",
                                      errorTarget: ".site-errors",
                                      target: "#actions" });
          });
</script>