 <div style="border:1px solid {$form->getContract()->getEngine()->getDates()->getDate($form->getValue('field'))->getColor()}" class="CustomerContractDatesField-{$form->getContract()->get('id')}-{$form->getValue('field')}">     
           {if $form->hasDate()}{$form->getDate()->getText()}{else}{__('---')}{/if}      
   </div>
<script type="text/javascript">              
       $(".CustomerContractDatesField-{$form->getContract()->get('id')}-{$form->getValue('field')}").click(function () { 
        var params= { CustomerContractDatesField : {
                       field : '{$form->getValue('field')}',
                      id : '{$form->getContract()->get('id')}',
                      token : '{mfForm::getToken('CustomerContractEditDateFieldForm')}'
            } };       
        return $.ajax2({ 
                data : params,
                url:"{url_to('customers_contracts_ajax',['action'=>'EditDateFieldForContract'])}",
                errorTarget: ".customers-contract-dates-errors",                
                loading: "#tab-site-dashboard-customers-contract-dates-loading",
                target: ".CustomerContractDatesField-ctn[id={$form->getContract()->get('id')}][name={$form->getValue('field')}]"
                 }); 
    });
    
    
</script>