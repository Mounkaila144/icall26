{messages class=" site-errors"}
<h3>{__("New group")}</h3>
<div>
    <a href="#" id="Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">
    <tr>
        <td>{__("name")}</td>
        <td> 
            <div>{$form.name->getError()}</div> 
            <input type="text" class="Group" name="name" value="{$group->get('name')|escape}" size="30"/>{if $form->name->getOption('required')}*{/if}
        </td>
    </tr>
</table>  
<script type="text/javascript">
    
        $('#Cancel').click(function(){ return $.ajax2({ 
                        url:"{url_to('users_guard_ajax',['action'=>'ListPartialGroup'])}" , 
                        loading: "#tab-site-dashboard-x-settings-loading",
                        errorTarget: ".site-errors",
                        target: "#actions"}); 
        });
         
        $(".Group").click(function() { $("# Save").show(); });
        
        
        $('#Save').click(function(){ 
              var params= { Group: {                                    
                                    token :'{$form->getCSRFToken()}' 
                                  } };
              $("input.Group").each(function() { params.Group[this.name]=this.value; });
              return $.ajax2({  data:params, 
                                url:"{url_to('users_guard_ajax',['action'=>'NewGroup'])}" , 
                                loading: "#tab-site-dashboard-x-settings-loading",
                                errorTarget: ".site-errors",
                                target: "#actions"}); 
         });  
</script>
