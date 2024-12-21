{if $user->hasCredential([['superadmin']])}    
      <a href="#" id="Domoprime-TransferContract" class="btn">
         <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Transfer form => request (Contract)')}
         <span id="TransferRequestContracts">{$number_of_requests}</span>/{$number_of_forms}
      </a>    
{/if}            
<script type="text/javascript">        
                               
         $('#Domoprime-TransferContract').click(function(){ 
                return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'TransferContract'])}",                                 
                                 errorTarget: ".Domoprime-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function (resp)
                                            {
                                                $("#TransferRequestContracts").html(resp.number_of_request);
                                            }    
                              }); 
        });
</script> 
