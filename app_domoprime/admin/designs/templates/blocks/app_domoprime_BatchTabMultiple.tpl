<table>
<tr>      
        <td>{__('Generate PDF billings')}            
        </td>
        <td>                        
                <button id="GenerateBillingsBatch-Button">{__('Generate')}</button>                                       
        </td>       
    </tr>          
</table>           
<script type="text/javascript">
    $("#GenerateBillingsBatch-Button").click(function () {   
        var params = { DomoprimeBillingsPDF : { selection: {$form->getSelection()->toJson()} , token : '{mfForm::getToken('ExportBillingsPdfForm')}' }  };
        return $.ajax2({     
                data : params,
                url: "{url_to('app_domoprime_ajax',['action'=>'ExportBillingsPdfBatch'])}",  
                errorTarget: ".contract-multiple-errors",
              //  loading: "#GenerateBillings-Loading",   
                success: function (resp)
                         {
                             
                         }              
           });
    });
</script>   