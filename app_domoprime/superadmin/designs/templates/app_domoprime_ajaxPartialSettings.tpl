<h3>{__('Settings')}</h3>    
<div>
    {*<a href="#" class="btn" id="{$site->getSiteID()}-ProcessSurface">{__('Process surface')}</a> *}
</div>     
<script type="text/javascript">
 
       
       $("#{$site->getSiteID()}-ProcessSurface").click( function () {                       
                return $.ajax2({ loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",
                                url:"{url_to('app_domoprime_ajax',['action'=>'ProcessSurface'])}",
                                errorTarget: ".{$site->getSiteID()}-site-errors",
                                success : function (resp)
                                          {
                                              
                                          }   
                });
         });	
</script>    
