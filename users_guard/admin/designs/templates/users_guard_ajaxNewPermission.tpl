{messages class="site-errors"}
<h3>{__("New permissions")}</h3>
<div>
    <a href="#" id=" Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('Save')}</a>
    <a href="#" id=" Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('Cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">
    {section name=index loop=(string)$form.count}
    <tr id=" permission-{$smarty.section.index.index}" class=" permission-form">
        <td>#{$smarty.section.index.index+1}</td>
        <td>{__("name")}</td>
        <td> 
            <div>&nbsp;{$form.collection[$smarty.section.index.index].name->getError()}</div> 
            <input type="text" class="permission" name="name" value="{$form['collection'][$smarty.section.index.index]['name']|escape}" size="30"/>{if $form->collection[$smarty.section.index.index]['name']->getOption('required')}*{/if}
            {if $smarty.section.index.index!=0}<a href="#" title="{__('delete')}" class="Delete" id="{$smarty.section.index.index}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>{/if}
        </td> 
    </tr>
    {/section}
</table>  
<div>
   <a id=" Add" href="#"  style="{if (string)$form.count>=$form->count->getOption('max')}display:none{/if}"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('add permission')|capitalize}</a>
</div>
<script type="text/javascript">
         
        $('# Cancel').click(function(){ 
            $(document).off('click','. Delete');
            return $.ajax2({ url: "{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",
                             loading: "#tab-site-dashboard-x-settings-loading",
                             errorTarget: ".site-errors",
                             target: "#actions"
                           }); 
        });
         
        $(document).on('click',". permission",function() { $("# Save").show(); });
        
        $("# Add").click(function() { 
            id=$(". permission-form").length;
            if (id>={$form->count->getOption('max')})
            {
                alert("{__('maximum records has been reached.')}");
                $(this).hide();
                return ;
            }                
            $("# permission-"+(id-1)).after('<tr id="permission-'+(id)+'" class="permission-form"><td>#'+(id+1)+
                  '<td>{__("name")}</td>'+
                  '<td><div>&nbsp;</div>'+
                  '<input type="text" class="permission" name="name" value="" size="30"/>{if $form->collection["0"]["name"]->getOption("required")}*{/if}\n'+
                  '<a href="#" title="{__("delete")}" class="Delete" id="'+(id)+'"><img  src="{url("/icons/delete.gif","picture")}" alt="{__("delete")}"/></a>'+
                  '</td></tr>');
        });

        $(document).on('click',".Delete",function () { 
            $("#permission-"+$(this).attr('id')).remove();
            $(".permission-form").each(function(id) {
                  $("#"+$(this).attr('id')).attr('id',"permission-"+id);
                  $("#permission-"+id+" td:first").html("#"+(id+1));
                  $(".Delete").each(function (id) { $(this).attr("id",id+1); });
            });
            $("#Add").show();
        });
               
        $('#Save').click(function(){ 
              var params= { Permissions: {                                     
                                    token :'{$form->getCSRFToken()}' 
                                  } };
                 params.Permissions.count=$(".permission-form").length;
                 params.Permissions.collection= { };
                 $(".permission-form").each(function(idx) {
                     params.Permissions.collection[idx]={ };
                     $("#permission-"+idx+" input.permission").each(function(id) {
                          params.Permissions.collection[idx][this.name]=this.value;
                     });
                 });
              $(document).off('click','.Delete');
              $.ajax2({ data: params, 
                         url: "{url_to('users_guard_ajax',['action'=>'NewPermission'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        errorTarget: ".site-errors",
                        target: "#actions"}); 
         });  
                    
</script>
