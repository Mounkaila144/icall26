{messages class="`$site->getSiteID()`-site-errors"}
<h3>{__("Users for the team")}: {if $item->isLoaded()}[{$item->get('name')}]{/if}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-UserTeam-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-UserTeam-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    <div {if $form.users->hasError()}class="error_form"{/if}>{$form.users->getError()}</div>
    <table>
    {foreach $form->users->getOption('choices') as $user}
        {if $user@index % 8 == 0}<tr>{/if}
            <td>                
                <input type="checkbox" class="{$site->getSiteID()}-UserTeam" id="{$user->get('id')}" {if in_array($user->get('id'),(array)$form.users->getValue())}checked="checked"{/if}/>{$user}
            </td>
       {if $user@index % 8 == 8}</tr>{/if}
    {/foreach}
    </table>
{else}
    <span>{__('Team is invalid.')}</span>
{/if}

<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-UserTeam").click(function() {  $('#{$site->getSiteID()}-UserTeam-Save').show(); });    
             
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-UserTeam-Cancel').click(function(){               
             return $.ajax2({ 
                              url : "{url_to('users_site_ajax',['action'=>'ListPartialTeam'])}",
                              errorTarget: ".{$site->getSiteID()}-site-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions"}); 
      });
      
      $('#{$site->getSiteID()}-UserTeam-Save').click(function(){                             
            var  params= {                
                                TeamUsers: { 
                                   users: [],
                                   id: "{$item->get('id')}",
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-UserTeam:checked").each(function() { params.TeamUsers.users.push($(this).attr('id')) });       
       //       alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                            
                           url: "{url_to('users_site_ajax',['action'=>'SaveTeamUsers'])}",
                           errorTarget: ".{$site->getSiteID()}-site-errors",
                           target: "#{$site->getSiteID()}-actions"}); 
        });  
     
</script>