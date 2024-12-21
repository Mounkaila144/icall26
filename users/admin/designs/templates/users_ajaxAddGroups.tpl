{messages class="site-errors"}
{if  $user->isLoaded()}
    <h3>{__('user')|capitalize} : {$user->get('username')} [{$user}] - {__('groups')|capitalize}</h3>    
    <div>
        <a href="#" id="Save" style="display:none;"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')|capitalize}</a>
        <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
    </div> 
    <div style="overflow-y:auto; width: 200px;">
        {foreach $groups as $group}
            <div class="{if $group->get('user_id')}active{else}field{/if}" id="{$group->get('id')}">
                <span>{$group->name}</span>    
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
            
          $('#Cancel').click(function() { 
               return $.ajax2({ data : { User : "{$user->get('id')}" }, 
                                url: "{url_to('users_ajax',['action'=>'GroupsList'])}",
                                loading: "#tab-site-dashboard-x-settings-loading",
                                errorTarget: ".site-errors",
                                target: "#actions"});
          });
          
          $("#Save").click(function (){ 
                     var params= { Groups: { selection : new Array(),user_id : "{$user->get('id')}",token: "{mfForm::getToken('AddUserGroupsForm')}" } };
                     $(".field.selected").each(function(id) { params.Groups.selection[id]= this.id; }); 
                     return $.ajax2({ data : params,
                                      url: "{url_to('users_ajax',['action'=>'AddGroupsSave'])}",
                                      errorTarget: ".site-errors",
                                      target: "#actions"});
          });
</script>