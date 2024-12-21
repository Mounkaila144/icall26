{messages class="{$site->getSiteID()}-UserTeam-errors"}
<h3>{__("New team")}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-UserTeam-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-UserTeam-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table cellpadding="0" cellspacing="0">     
       <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div>{$form.name->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserTeam" name="name" value="{$item->get('name')}"/>    
            {if $form->name->getOption('required')}*{/if} 
         </td>
    </tr>  
    <tr>
        <td>{__('Manager')}
        </td>
        <td>
            {html_options_format format="__" class="`$site->getSiteID()`-UserTeam" name="manager_id" options=$form->manager_id->getOption('choices') selected=$item->get('manager_id')}
        </td>
    </tr>
</table> 
   
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
                                UserTeam: {   
                                   manager_id: $(".{$site->getSiteID()}-UserTeam[name=manager_id] option:selected").val(),
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-UserTeam").each(function() { params.UserTeam[this.name]=$(this).val(); });       
        //      alert("Params="+params.toSource());   return ;          
          return $.ajax2({ data : params,                            
                           url: "{url_to('users_site_ajax',['action'=>'NewTeam'])}",
                           target: "#{$site->getSiteID()}-actions"}); 
        });  
     
</script>
