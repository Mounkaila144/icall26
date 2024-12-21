{if $user->hasCredential([['superadmin']])}    
      <a href="#" id="Domoprime-Models" class="btn">
         <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Models')}        
      </a>    
{/if}            
<script type="text/javascript">        
                               
         $('#Domoprime-Models').click(function(){ 
                return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'InstallModels'])}",                                 
                                 errorTarget: ".Domoprime-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function (resp)
                                            {
                                             
                                            }    
                              }); 
        });
</script>     
