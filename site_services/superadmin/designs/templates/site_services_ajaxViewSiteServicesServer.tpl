{messages class="site-services-errors"}
<h3>{__('View server')}</h3>    
<div>
      <a href="#" id="SiteServicesServer-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>
        {*<img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>*}{__('Save')}</a>    
    <a href="#" class="btn" id="SiteServicesServer-Cancel" title="{__('Cancel')}" ><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('Cancel')}"/>{__('Cancel')}</a>   
</div>
{if $item->isLoaded()}
<table class="tab-form" cellpadding="0" cellspacing="0">
    
    <tr>
        <td class="label"><span>{__("Host")}{if $form->host->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.host->getError()}</div>               
             <input type="text" size="20" class="SiteServicesServer Input" name="host" value="{$item->get('host')}"/> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("IP")}{if $form->ip->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.ip->getError()}</div>               
             <input type="text" size="20" class="SiteServicesServer Input" name="ip" value="{$item->get('ip')}"/> 
        </td>
    </tr> 
      <tr>
        <td class="label"><span>{__("Name")}{if $form->name->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.name->getError()}</div>               
             <input type="text" size="20" class="SiteServicesServer Input" name="name" value="{$item->get('name')}"/> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Login")}{if $form->login_service->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.login_service->getError()}</div>               
             <input type="text" size="20" class="SiteServicesServer Input" name="login_service" value="{$item->get('login_service')}"/> 
        </td>
    </tr> 
    <tr>
        <td class="label"><span>{__("Password")}{if $form->password->getOption('required')}*{/if}</span></td>
        <td>
             <div>{$form.password->getError()}</div>               
             <input type="password" size="20" class="SiteServicesServer Input" name="password" value=""/> 
        </td>
    </tr> 
    
</table>  
{else}
    {__('Server K26 is invalid.')}
{/if}    
<script type="text/javascript">
    
    $(".SiteServicesServer").change(function () { $("#SiteServicesServer-Save").show(); });

    $(".SiteServicesServer").click(function () { $("#SiteServicesServer-Save").show(); });


    {* =====================  A C T I O N S =============================== *}   
        
    $("#SiteServicesServer-Cancel").click( function () {                     
            return $.ajax2({                  
                url: "{url_to('site_services_ajax',['action'=>'ListPartialSiteServicesServers'])}",
                 loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
           });  
    });
    
     $("#SiteServicesServer-Save").click( function () {      
         var params ={ 
                         SiteServicesServer: {
                                   id:  '{$item->get('id')}',
                                   token: '{$form->getCSRFToken()}'
                         }
                       };
           $(".SiteServicesServer.Select option:selected").each(function () { params.SiteServicesServer[$(this).parent().attr('name')]=$(this).val(); });
           $(".SiteServicesServer.Input").each(function () { params.SiteServicesServer[$(this).attr('name')]=$(this).val(); });
            return $.ajax2({   
                data : params,
                url: "{url_to('site_services_ajax',['action'=>'SaveSiteServicesServer'])}",
                loading: "#tab-dashboard-site-services-loading",
                            errorTarget: ".site-services-errors",
                            target: "#actions-site-services"
           });  
    });
</script>  
