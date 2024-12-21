{messages class="site-errors"}
<h3>{__("Users for the team")}: {if $item->isLoaded()}[{$item->get('name')}]{/if}</h3>
<div>
    <a href="#" id="UserTeam-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="UserTeam-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    <div {if $form.users->hasError()}class="error_form"{/if}>{$form.users->getError()}</div>
    <table>
    {foreach $form->users->getOption('choices') as $_user}
        {if $_user@index % 8 == 0}<tr>{/if}
            <td>                
                <input type="checkbox" class="UserTeam" id="{$_user->get('id')}" {if in_array($_user->get('id'),(array)$form.users->getValue())}checked="checked"{/if}/>{$_user}
            </td>
       {if $_user@index % 8 == 8}</tr>{/if}
    {/foreach}
    </table>
{else}
    <span>{__('Team is invalid.')}</span>
{/if}

<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".UserTeam").click(function() {  $('#UserTeam-Save').show(); });    
             
     {* =================== A C T I O N S ================================ *}
     $('#UserTeam-Cancel').click(function(){               
             return $.ajax2({ 
                              url : "{url_to('users_ajax',['action'=>'ListPartialTeam'])}",
                              errorTarget: ".site-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
      $('#UserTeam-Save').click(function(){                             
            var  params= {                
                                TeamUsers: { 
                                   users: [],
                                   id: "{$item->get('id')}",
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserTeam:checked").each(function() { params.TeamUsers.users.push($(this).attr('id')) });       
       //       alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                            
                           url: "{url_to('users_ajax',['action'=>'SaveTeamUsers'])}",
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });  
     
</script>