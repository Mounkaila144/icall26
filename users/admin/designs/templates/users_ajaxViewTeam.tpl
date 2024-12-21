{messages class="site-errors"}
<h3>{__("Team [%s]",$item->get('name'))}</h3>
<div>
    {if $user->hasCredential([['superadmin','admin','settings_user_team_modify']])}
    <a href="#" id="UserTeam-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    {/if}
    <a href="#" id="UserTeam-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
{if $item->isLoaded()}
    <table cellpadding="0" cellspacing="0">     
           <tr>
             <td><span>{__("name")}</span></td>
             <td>
                <div>{$form.name->getError()}</div>
                <input type="text" size="48" class="UserTeam" {if !$user->hasCredential([['ssuperadmin','sadmin','settings_user_team_modify']])}disabled="disabled"{/if} name="name" value="{$item->get('name')}"/>    
                {if $form->name->getOption('required')}*{/if} 
             </td>
        </tr>  
         <tr>
        <td>{__('Manager')}
        </td>
        <td>
             {if $user->hasCredential([['supersadmin','adsmin','settings_user_team_modify']])}
            {html_options_format format="__" class="UserTeam" name="manager_id" options=$form->manager_id->getOption('choices') selected=$item->get('manager_id')}
            {else}
                {$item->getManager()}
            {/if}    
        </td>
    </tr>
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
                                UserTeam: { 
                                   id: "{$item->get('id')}",
                                   manager_id: $(".UserTeam[name=manager_id] option:selected").val(),
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserTeam").each(function() { params.UserTeam[this.name]=$(this).val(); });       
        //      alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                            
                           url: "{url_to('users_ajax',['action'=>'SaveTeam'])}",  
                           loading: "#tab-site-dashboard-x-settings-loading",    
                           errorTarget: ".site-errors",
                           target: "#actions"}); 
        });  
     
</script>
