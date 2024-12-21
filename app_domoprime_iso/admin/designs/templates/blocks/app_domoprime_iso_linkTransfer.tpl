{if $user->hasCredential([['superadmin']])}    
      <a href="#" id="Domoprime-Transfer" class="btn">
         <i class="fa fa-cog" style=" margin-right: 10px"></i>{__('Transfer form => request (Meeting)')}
         <span id="TransferRequest">{$number_of_requests}</span>/{$number_of_forms}
      </a>    
{/if}            
<script type="text/javascript">        
                               
         $('#Domoprime-Transfer').click(function(){ 
                return $.ajax2({ url:"{url_to('app_domoprime_iso_ajax',['action'=>'Transfer'])}",                                 
                                 errorTarget: ".Domoprime-errors",
                                 loading: "#tab-site-dashboard-x-settings-loading",
                                 success : function (resp)
                                            {
                                                $("#TransferRequest").html(resp.number_of_request);
                                            }    
                              }); 
        });
</script>     
