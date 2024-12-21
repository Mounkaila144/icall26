 
      <a href="#" id="Domoprime-Configuration" class="btn">
         <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Install configuration')}        
      </a>    
       
<script type="text/javascript">        
                               
         $('#Domoprime-Configuration').click(function(){ 
                return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'InstallConfiguration'])}",                                 
                                 errorTarget: ".Domoprime-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function (resp)
                                            {
                                                
                                            }    
                              }); 
        });
</script> 
