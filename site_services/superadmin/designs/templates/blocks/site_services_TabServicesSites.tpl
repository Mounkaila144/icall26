<a href="#" id="ServiceSites" class="ServiceSiteActions"><div class="serviceSites-Action">
        <img src="{url('/icons/web32x32.png','picture')}" width="32px" height="32px"/>
        <div class="actionName">{__($tab->get('title'))}</div>
    </div>
</a>
    <script type="text/javascript">
    
     $(".ServiceSiteActions[id=ServiceSites]").click(function () {                     
        return $.ajax2({  
                   data: { Selection : { sites: $("#actions-site-services").data("sites_selected"),token:'{mfForm::getToken('SiteServiceSiteSelectedForm')}' } },
                   url: '{url_to('site_services_ajax',['action'=>'ListPartialSiteServices'])}' ,                             
                   target : "#actions-site-services",
                   errorTarget: ".tabs-site-services-errors",
                   loading: "#tab-dashboard-site-services-loading"                             
                }); 
     });
</script>