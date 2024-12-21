<script type="text/javascript">
 
          
           $(".CustomerContracts-GenerateDocuments").click(function() {                                
            return $.ajax2({     
                data : { Contract: $(this).attr('id') },
                url: "{url_to('app_domoprime_ajax',['action'=>'GenerateDocumentsForContract'])}",                                             
                errorTarget: ".customers-contract-errors",
                loading: "#tab-site-dashboard-customers-contract-loading",  
                
           }); 
           });
</script>   
