{component name="/dashboard/sublink"} 
<div id="actions">
{messages class="service-server-errors"}
<h3>{__("Master server services API settings")}</h3>
<div>
    <a href="#" id="SiteServiceSettings-Save" class="btn" style="display:none"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
       {__('Save')}</a>       
</div>
 
     <div>                        
       <div class="errors_settings">{$form.master_host->getError()}</div>     
       <label>{__('Master host')}</label>    
         <input type="text" class="SiteServiceSettings Input" size="40" name="master_host" value="{$settings->get('master_host')}"/>            
         <a href="#" id="SiteServiceSettings-Ping"><i class="fa fa-share-alt"></i></a>
    </div>      
           <div>                        
       <div class="errors_settings">{$form.authorized_ips->getError()}</div>     
       <label>{__('Authorized ips')}</label>    
       <textarea type="text" class="SiteServiceSettings Input" size="40" name="authorized_ips">{$settings->getAuthorizedIps()}</textarea>
    </div> 
<script type="text/javascript">
     
     {* =================== F I E L D S ================================ *}
     $(".SiteServiceSettings").click(function() {  $('#SiteServiceSettings-Save').show(); });    
    
     
    
      $('#SiteServiceSettings-Save').click(function(){                             
            var  params= {                  
                                Settings: {                                   
                                   token :'{$form->getCSRFToken()}'
                                } };
          $(".SiteServiceSettings.Input").each(function() { params.Settings[this.name]=$(this).val(); });           
        //      alert("Params="+params.toSource());   return ;         
          return $.ajax2({ data : params,                            
                           url: "{url_to('server_services_ajax',['action'=>'Settings'])}",
                           errorTarget: ".service-server-errors",
                           loading : "#tab-dashboard-superadmin-loading",
                           target: "#tab-dashboard-superadmin-content"}); 
        });  
     
     
       $('#SiteServiceSettings-Ping').click(function(){                                          
          return $.ajax2({  url: "{url_to('server_services_ajax',['action'=>'Ping'])}",
                           errorTarget: ".service-server-errors",                           
                           loading : "#tab-dashboard-superadmin-loading",
                  }); 
        });  
     
</script>
</div>

