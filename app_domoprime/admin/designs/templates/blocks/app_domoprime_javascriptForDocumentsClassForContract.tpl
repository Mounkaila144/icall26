<script type="text/javascript">
 
          
           $(".CustomerContracts-DocumentsFormClass").click(function() {                  
                addTabField("customers-contract","document-form-"+$(this).attr('id'),$(this).attr('name')+" - {__('Documents')}");                      
                return $.ajax2({     
                    data : { Contract: $(this).attr('id') },
                    url: "{url_to('app_domoprime_ajax',['action'=>'ListDocumentClassForContract'])}",                                             
                    errorTarget: ".customers-contract-errors",
                    loading: "#tab-site-dashboard-customers-contract-loading",  
                    target: "#tab-site-panel-dashboard-customers-contract-document-form-"+$(this).attr('id')
               }); 
           });
           
                     
</script>  