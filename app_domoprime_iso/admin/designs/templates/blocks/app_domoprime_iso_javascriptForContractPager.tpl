<script type="text/javascript">
    
     $(".CustomerContracts-Transfer").click( function () {               
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('app_domoprime_iso_ajax',['action'=>'TransferForContract'])}",                                             
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                success : function (resp)
                    {
                        
                    }
           });           
    });
    
     
</script>
