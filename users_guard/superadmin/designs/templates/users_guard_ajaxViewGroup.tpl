 {messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("Edit group")}</h3>
<div>
    {if $group->isLoaded()}<a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

{if $group->isLoaded()}
    <table cellpadding="0" cellspacing="0">
         <tr>
             <td>{__("name")}</td>
             <td> 
                 <div>{$form.name->getError()}</div> 
                 <input type="text" class="{$site->getSiteID()}-Group" name="name" value="{$group->get('name')|escape}" size="30"/>{if $form->name->getOption('required')}*{/if}
             </td>
         </tr>
         <tr>
             <td>{__("created at")}</td>
             <td> 
                 <span>{$group->get('created_at')|escape}</span>
             </td>
         </tr>   
         <tr>
             <td>{__("updated at")}</td>
             <td> 
                 <span>{$group->get('updated_at')|escape}</span>
             </td>
         </tr>               
         <tr>
             <td>{__("application")}</td>
             <td> 
                 <span>{$group->get('application')|escape}</span>
             </td>
         </tr>    
    </table>  
{else}
    <span>{__("This group is invalid.")}</span>
{/if} 
<script type="text/javascript">
    
         $('#{$site->getSiteID()}-Cancel').click(function(){ return  $.ajax2({ 
                url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                errorTarget: ".{$site->getSiteID()}-site-errors",
                target: "#{$site->getSiteID()}-actions"});
         });
        
         {if $group->isLoaded()}
            $(".{$site->getSiteID()}-Group").click(function() { 
                $("#{$site->getSiteID()}-Save").show();
            });
            
            $('#{$site->getSiteID()}-Save').click(function() { 
                 var params= { Group : { 
                                       id : "{$group->get('id')}",
                                       token : '{$form->getCSRFToken()}' 
                                    } }; 
             
                   $("input.{$site->getSiteID()}-Group").each(function() {  params.Group[this.name]=this.value; });
                   return $.ajax2({ data:params, 
                                    url:"{url_to('users_guard_ajax',['action'=>'SaveGroup'])}" , 
                                    loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                    errorTarget: ".{$site->getSiteID()}-site-errors",
                                    target: "#{$site->getSiteID()}-actions"}); 
                   
            });  
             
         {/if}   
   
</script>

