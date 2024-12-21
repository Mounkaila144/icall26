{messages class="site-errors"}
<h3>{__("New permissions group")}</h3>
<div>
    <a href="#" id="Save" class="btn" style="display:none">
           <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
           {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('Save')}</a>
    <a href="#" id="Cancel" class="btn">
         <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
         {*<img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>*}{__('Cancel')}</a>
</div>
<table  class="tab-form" cellpadding="0" cellspacing="0">
    {section name=index loop=(string)$form.count}
    <tr id="permission-group-{$smarty.section.index.index}" class="permission-group-form">
        <td>#{$smarty.section.index.index+1}</td>
        <td class="label">{__("name")}</td>
        <td> 
            <div class="error-form">&nbsp;{$form.collection[$smarty.section.index.index].name->getError()}</div> 
            <input type="text" class="permission-group" name="name" value="{$form['collection'][$smarty.section.index.index]['name']|escape}" size="30"/>{if $form->collection[$smarty.section.index.index]['name']->getOption('required')}*{/if}
        {if $smarty.section.index.index!=0}<a href="#" title="{__('delete')}" class="Delete" id="{$smarty.section.index.index}"><i class=" fa fa-trash" style=" margin-left: 10px;"></i>{*<img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/>*}</a>{/if}
        </td> 
    </tr>
    {/section}
</table>  
<div>
    <a id="Add" href="#" class="btn"  style="{if (string)$form.count>=$form->count->getOption('max')}display:none{/if}">
        <i class="fa fa-plus" style=" margin-right: 10px;"></i>
        {*<img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>*}{__('Add permission group')}</a>
</div>

<script type="text/javascript">
         
        $('#Cancel').click(function(){ 
            $(document).off('click','.Delete');
            return $.ajax2({ url: "{url_to('users_guard_ajax',['action'=>'ListPartialPermissionsGroup'])}",
                             loading: "#tab-site-dashboard-x-settings-loading",
                             errorTarget: ".site-errors",
                             target: "#actions"
                           }); 
        });
         
        $(document).on('click',".permission-group",function() { $("#Save").show(); });
        
        $("#Add").click(function() { 
            id=$(".permission-group-form").length;
            if (id>={$form->count->getOption('max')})
            {
                alert("{__('maximum records has been reached.')}");
                $(this).hide();
                return ;
            }                
            $("#permission-group-"+(id-1)).after('<tr id="permission-group-'+(id)+'" class="permission-group-form"><td>#'+(id+1)+
                  '<td class="label">{__("name")}</td>'+
                  '<td><div>&nbsp;</div>'+
                  '<input type="text" class="permission-group" name="name" value="" size="30"/>{if $form->collection["0"]["name"]->getOption("required")}*{/if}\n'+
                  '<a href="#" title="{__("delete")}" class="Delete" id="'+(id)+'"><i class=" fa fa-trash" style=" margin-left: 10px;"></i></a>'+
                  '</td></tr>');
        });

        $(document).on('click',".Delete",function () { 
            $("#permission-group-"+$(this).attr('id')).remove();
            $(".permission-group-form").each(function(id) {
                  $("#"+$(this).attr('id')).attr('id',"permission-group-"+id);
                  $("#permission-group-"+id+" td:first").html("#"+(id+1));
                  $(".Delete").each(function (id) { $(this).attr("id",id+1); });
            });
            $("#Add").show();
        });
               
        $('#Save').click(function(){ 
              var params= { PermissionsGroup: {                                     
                                    token :'{$form->getCSRFToken()}' 
                                  } };
                 params.PermissionsGroup.count=$(".permission-group-form").length;
                 params.PermissionsGroup.collection= { };
                 $(".permission-group-form").each(function(idx) {
                     params.PermissionsGroup.collection[idx]={ };
                     $("#permission-group-"+idx+" input.permission-group").each(function(id) {
                          params.PermissionsGroup.collection[idx][this.name]=this.value;
                     });
                 });
              $(document).off('click','.Delete');
              $.ajax2({ data: params, 
                         url: "{url_to('users_guard_ajax',['action'=>'NewPermissionsGroup'])}",
                        loading: "#tab-site-dashboard-x-settings-loading",
                        errorTarget: ".site-errors",
                        target: "#actions"}); 
         });  
                    
</script>
