<a href="#" id="ServiceServers" class="ServiceSiteActions">
    <div class="serviceSites-Action"><img src="{url('/icons/server.png','picture')}" width="32px" height="32px"/>
        <div class="actionName">{__($tab->get('title'))}</div>
    </div>
</a>
<script type="text/javascript">
    
     $(".ServiceSiteActions[id=ServiceServers]").click(function () {                   
        return $.ajax2({  
                   data: { Selection : { servers: $("#actions-site-services").data("servers_selected"),token:'{mfForm::getToken('SiteServiceServerSelectedForm')}' } },
                   url: '{url_to('site_services_ajax',['action'=>'ListPartialSiteServicesServers'])}' ,                             
                   target : "#actions-site-services",
                   errorTarget: ".tabs-site-services-errors",
                   loading: "#tab-dashboard-site-services-loading"                             
                }); 
     });
</script>