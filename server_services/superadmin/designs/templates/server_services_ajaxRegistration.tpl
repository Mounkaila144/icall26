{component name="/dashboard/sublink"} 
<div id="actions">
{messages class="service-server-errors"}
<div>
    <a href="#" id="SiteServiceRegistration-Register" class="btn" style="display:none"><i class="fa fa-cog" style="color:#000; margin-right:10px;"></i>
       {__('Register')}</a>       
</div>
 
 <fieldset>   
     <h3>{__('Master Server')}</h3>
     <table cellspacing="0" width="100%">  
          <tr>
             <td>
                 {__('Master server host')}{if $form->master_host->getOption('required')}*{/if}
             </td>
             <td>
                <input type="text" class="SiteServiceRegistration Input" name="master_host" value=""/>
             </td>
         </tr>
          <tr>
             <td>
                 {__('Master server password')}{if $form->master_password->getOption('required')}*{/if}
             </td>
             <td>
                <input type="text" class="SiteServiceRegistration Input" name="master_password" value=""/>
             </td>
         </tr>
     </table>
 </fieldset>
<fieldset>   
    <h3>{__('Server user registration')}</h3>
    <table cellspacing="0" width="100%">  
         <tr>
             <td>
                 {__('Name')}{if $form->name->getOption('required')}*{/if}
             </td>
             <td>
                <input type="text" class="SiteServiceRegistration Input" name="name" value="{$settings->getServerName()}"/>
             </td>
         </tr>                  
          <tr>
             <td>
                 {__('Password')}{if $form->password->getOption('required')}*{/if}
             </td>
             <td>
                <input type="text" class="SiteServiceRegistration Input" name="password" value=""/>
             </td>
         </tr>        
     </table>
</fieldset>    
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".SiteServiceRegistration").click(function() {  $('#SiteServiceRegistration-Register').show(); });    
    
     
    
      $('#SiteServiceRegistration-Register').click(function(){                             
            var  params= {                  
                                ServerRegistration: {                                   
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".SiteServiceRegistration.Input").each(function() { params.ServerRegistration[this.name]=$(this).val(); });           
        //      alert("Params="+params.toSource());   return ;         
          return $.ajax2({ data : params,                            
                           url: "{url_to('server_services_ajax',['action'=>'Registration'])}",
                           errorTarget: ".service-server-errors",
                           loading : "#tab-dashboard-superadmin-loading",
                           target: "#tab-dashboard-superadmin-content"}); 
        });  
     
     
       
</script>
</div>


