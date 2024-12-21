{messages class="UserTeam-errors"}
<h3>{__("New team")}</h3>
<div>
    <a href="#" id="UserTeam-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="UserTeam-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">     
       <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div>{$form.name->getError()}</div>
            <input type="text" size="48" class="UserTeam" name="name" value="{$item->get('name')}"/>    
            {if $form->name->getOption('required')}*{/if} 
         </td>
    </tr> 
     <tr>
        <td>{__('Manager')}
        </td>
        <td>
            {html_options_format format="__" class="UserTeam" name="manager_id" options=$form->manager_id->getOption('choices') selected=$item->get('manager_id')}
        </td>
    </tr>
</table> 
   
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
                                   manager_id: $(".UserTeam[name=manager_id] option:selected").val(),
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserTeam").each(function() { params.UserTeam[this.name]=$(this).val(); });       
        //      alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                            
                           url: "{url_to('users_ajax',['action'=>'NewTeam'])}",
                           target: "#actions"}); 
        });  
     
</script>
