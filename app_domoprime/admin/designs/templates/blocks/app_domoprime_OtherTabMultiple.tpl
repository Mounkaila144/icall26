<table>
<tr>      
        <td>{__('Generate PDF billings')} ({__('Max %s',$settings->get('multiple_billings_max'))})              
        </td>
        <td>            
            {if  $form->getSelection()->count() > $settings->get('multiple_billings_max')}
                  ({__('Selection is too large max (%s)',$settings->get('multiple_billings_max'))})
            {else}
                <button id="GenerateBillings-Button">{__('Generate')}</button>  
                <a id="GenerateBillings-Link" style="display:none" href="#" target="_blank"><i class="fa fa-download"></i></a>
                <img id="GenerateBillings-Loading" style="display:none;" src="{url('/icons/loader.gif','picture')}" alt="loader" height="16px" width="16px"/>
            {/if}   
        </td>       
    </tr>          
</table>           
<script type="text/javascript">
    $("#GenerateBillings-Button").click(function () {   
        var params = { DomoprimeBillingsPDF : { selection: {$form->getSelection()->toJson()} , token : '{mfForm::getToken('ExportBillingsPdfForm')}' }  };
        return $.ajax2({     
                data : params,
                url: "{url_to('app_domoprime_ajax',['action'=>'ExportBillingsPdf'])}",  
                errorTarget: ".contract-multiple-errors",
                loading: "#GenerateBillings-Loading",   
                success: function (resp)
                         {
                             if (resp.action=='DomoprimeBillingsPDF')
                             {    
                                $("#GenerateBillings-Link").attr('href',resp.url);
                                $("#GenerateBillings-Link").show();
                               // $("#GenerateBillings-Button").hide();
                             }
                         }              
           });
    });
</script>    
