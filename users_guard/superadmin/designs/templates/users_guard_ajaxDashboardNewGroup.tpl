{messages class="errors"}
<h3>{__("new groups")|capitalize}</h3>
<div>
    <a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">
    {section name=index loop=(string)$form['groups_count']}
    <tr id="group_{$smarty.section.index.index}" class="group_form">
        <td>#{$smarty.section.index.index+1}</td>
        <td>{__("name")}</td>
        <td> 
            <div>&nbsp;{$form['groups'][$smarty.section.index.index]['name']->getError()}</div> 
            <input type="text" class="group" name="name" value="{$form['groups'][$smarty.section.index.index]['name']|escape}" size="30"/>{if $form->groups[$smarty.section.index.index]['name']->getOption('required')}*{/if}
            {if $smarty.section.index.index!=0}<a href="#" title="{__('delete')}" class="Delete" id="{$smarty.section.index.index}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>{/if}
        </td> 
    </tr>
    {/section}
</table>  
<div>
   <a id="Add" href="#"  style="{if (string)$form['groups_count'] >= $form->groups_count->getOption('max')}display:none{/if}"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('add group')|capitalize}</a>
</div>
<script type="text/javascript">
         
        $('#Cancel').click(function(){             
            $(document).off('click','.Delete');
            return $.ajax2({ url:"{url_to('users_guard_ajax',['action'=>'DashboardListPartialGroups'])}",
                            loading:"#tab-dashboard-superadmin-loading",
                             target: "#actions"}); 
        });
         
       
        $(document).on('click',".group",function() { $("#Save").show(); });
        
        
        $("#Add").click(function() { 
            id=$(".group_form").length;
            if (id>={$form->groups_count->getOption('max')})
            {
                alert("{__('maximum records has been reached.')}");
                $(this).hide();
                return ;
            }    
            $("#group_"+(id-1)).after('<tr id="group_'+(id)+'" class="group_form"><td>#'+(id+1)+
                  '<td>{__("name")}</td>'+
                  '<td><div>&nbsp;</div>'+
                  '<input type="text" class="group" name="name" value="" size="30"/>{if $form->groups["0"]["name"]->getOption("required")}*{/if}\n'+
                  '<a href="#" title="{__("delete")}" class="Delete" id="'+(id)+'"><img  src="{url("/icons/delete.gif","picture")}" alt="{__("delete")}"/></a>'+
                  '</td></tr>');
        });

        $(document).on('click',".Delete",function () {         
            $("#group_"+$(this).attr('id')).remove();
            $(".group_form").each(function(id) {
                  $("#"+$(this).attr('id')).attr('id',"group_"+id);
                  $("#group_"+id+" td:first").html("#"+(id+1));
                  $(".Delete").each(function (id) { $(this).attr("id",id+1); });
            });
             $("#Add").show();
        });
        
        $('#Save').click(function(){ 
            var  params= { group: { 
                                    token :'{$form->getCSRFToken()}' 
                                  } };
                 params.group.groups_count=$(".group_form").length;
                 params.group.groups= { };
                 $(".group_form").each(function(idx) {
                     params.group.groups[idx]={ };
                     $("#group_"+idx+" input.group").each(function(id) {
                          params.group.groups[idx][this.name]=this.value;
                     });
                 });
              $(document).off('click','.Delete');
              $.ajax2({ data: params, 
                        url: "{url_to('users_guard_ajax',['action'=>'DashboardNewGroup'])}",
                        loading:"#tab-dashboard-superadmin-loading",
                        target: "#actions"}); 
         });  
                
</script>

