 {messages class=" site-errors"}
<h3>{__("Edit group")}</h3>
<div>
    {if $group->isLoaded()}<a href="#" id=" Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>{/if}
    <a href="#" id=" Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>

{if $group->isLoaded()}
    <table cellpadding="0" cellspacing="0">
         <tr>
             <td>{__("name")}</td>
             <td> 
                 <div>{$form.name->getError()}</div> 
                 <input type="text" class=" Group" name="name" value="{$group->get('name')|escape}" size="30"/>{if $form->name->getOption('required')}*{/if}
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
    
         $('# Cancel').click(function(){ return  $.ajax2({ 
                url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                loading: "#tab-site- dashboard-site-x-settings-loading",
                errorTarget: ". site-errors",
                target: "# actions"});
         });
        
         {if $group->isLoaded()}
            $(". Group").click(function() { 
                $("# Save").show();
            });
            
            $('# Save').click(function() { 
                 var params= { Group : { 
                                       id : "{$group->get('id')}",
                                       token : '{$form->getCSRFToken()}' 
                                    } }; 
             
                   $("input. Group").each(function() {  params.Group[this.name]=this.value; });
                   return $.ajax2({ data:params, 
                                    url:"{url_to('users_guard_ajax',['action'=>'SaveGroup'])}" , 
                                    loading: "#tab-site- dashboard-site-x-settings-loading",
                                    errorTarget: ". site-errors",
                                    target: "# actions"}); 
                   
            });  
             
         {/if}   
   
</script>

