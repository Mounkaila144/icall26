{messages class="{$site->getSiteID()}-site-errors"}
<h3>{__("New permissions")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('Save')}</a>
    <a href="#" id="{$site->getSiteID()}-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('Cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">
    {section name=index loop=(string)$form.count}
    <tr id="{$site->getSiteID()}-permission-{$smarty.section.index.index}" class="{$site->getSiteID()}-permission-form">
        <td>#{$smarty.section.index.index+1}</td>
        <td>{__("name")}</td>
        <td> 
            <div>&nbsp;{$form.collection[$smarty.section.index.index].name->getError()}</div> 
            <input type="text" class="{$site->getSiteID()}-permission" name="name" value="{$form['collection'][$smarty.section.index.index]['name']|escape}" size="30"/>{if $form->collection[$smarty.section.index.index]['name']->getOption('required')}*{/if}
            {if $smarty.section.index.index!=0}<a href="#" title="{__('delete')}" class="{$site->getSiteID()}-Delete" id="{$smarty.section.index.index}"><img  src="{url('/icons/delete.gif','picture')}" alt='{__("delete")}'/></a>{/if}
        </td> 
    </tr>
    {/section}
</table>  
<div>
   <a id="{$site->getSiteID()}-Add" href="#"  style="{if (string)$form.count>=$form->count->getOption('max')}display:none{/if}"><img  src="{url('/icons/add.gif','picture')}" alt="{__('new')}"/>{__('add permission')|capitalize}</a>
</div>
<script type="text/javascript">
         
        $('#{$site->getSiteID()}-Cancel').click(function(){ 
            $(document).off('click','.{$site->getSiteID()}-Delete');
            return $.ajax2({ url: "{url_to('users_guard_ajax',['action'=>'ListPartialPermission'])}",
                             loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                             errorTarget: ".{$site->getSiteID()}-site-errors",
                             target: "#{$site->getSiteID()}-actions"
                           }); 
        });
         
        $(document).on('click',".{$site->getSiteID()}-permission",function() { $("#{$site->getSiteID()}-Save").show(); });
        
        $("#{$site->getSiteID()}-Add").click(function() { 
            id=$(".{$site->getSiteID()}-permission-form").length;
            if (id>={$form->count->getOption('max')})
            {
                alert("{__('maximum records has been reached.')}");
                $(this).hide();
                return ;
            }                
            $("#{$site->getSiteID()}-permission-"+(id-1)).after('<tr id="{$site->getSiteID()}-permission-'+(id)+'" class="{$site->getSiteID()}-permission-form"><td>#'+(id+1)+
                  '<td>{__("name")}</td>'+
                  '<td><div>&nbsp;</div>'+
                  '<input type="text" class="{$site->getSiteID()}-permission" name="name" value="" size="30"/>{if $form->collection["0"]["name"]->getOption("required")}*{/if}\n'+
                  '<a href="#" title="{__("delete")}" class="{$site->getSiteID()}-Delete" id="'+(id)+'"><img  src="{url("/icons/delete.gif","picture")}" alt="{__("delete")}"/></a>'+
                  '</td></tr>');
        });

        $(document).on('click',".{$site->getSiteID()}-Delete",function () { 
            $("#{$site->getSiteID()}-permission-"+$(this).attr('id')).remove();
            $(".{$site->getSiteID()}-permission-form").each(function(id) {
                  $("#"+$(this).attr('id')).attr('id',"{$site->getSiteID()}-permission-"+id);
                  $("#{$site->getSiteID()}-permission-"+id+" td:first").html("#"+(id+1));
                  $(".{$site->getSiteID()}-Delete").each(function (id) { $(this).attr("id",id+1); });
            });
            $("#{$site->getSiteID()}-Add").show();
        });
               
        $('#{$site->getSiteID()}-Save').click(function(){ 
              var params= { Permissions: {                                     
                                    token :'{$form->getCSRFToken()}' 
                                  } };
                 params.Permissions.count=$(".{$site->getSiteID()}-permission-form").length;
                 params.Permissions.collection= { };
                 $(".{$site->getSiteID()}-permission-form").each(function(idx) {
                     params.Permissions.collection[idx]={ };
                     $("#{$site->getSiteID()}-permission-"+idx+" input.{$site->getSiteID()}-permission").each(function(id) {
                          params.Permissions.collection[idx][this.name]=this.value;
                     });
                 });
              $(document).off('click','.{$site->getSiteID()}-Delete');
              $.ajax2({ data: params, 
                         url: "{url_to('users_guard_ajax',['action'=>'NewPermission'])}",
                        loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                        errorTarget: ".{$site->getSiteID()}-site-errors",
                        target: "#{$site->getSiteID()}-actions"}); 
         });  
                    
</script>
