<input type="text" class="CustomerContractDatesFieldModify-{$form->getContract()->get('id')}-{$form->getValue('field')}" size="10" value="{if $form->hasDate()}{$form->getDate()->getText()}{/if}"/>
<a href="javascript:void();" id="CustomerContractDatesFieldActions-Cancel-{$form->getContract()->get('id')}-{$form->getValue('field')}"><i class="fa fa-remove"/></a>
<a href="javascript:void();" id="CustomerContractDatesFieldActions-Save-{$form->getContract()->get('id')}-{$form->getValue('field')}"><i class="fa fa-save"/></a>

<script type="text/javascript">
        
     $(".CustomerContractDatesFieldModify-{$form->getContract()->get('id')}-{$form->getValue('field')}").datepicker();
     
     $("#CustomerContractDatesFieldActions-Cancel-{$form->getContract()->get('id')}-{$form->getValue('field')}").click(function () {                
         var params= { CustomerContractDatesField : {
                      field : '{$form->getValue('field')}',
                      id : '{$form->getContract()->get('id')}',
                      token : '{mfForm::getToken('CustomerContractEditDateFieldForm')}'
            } };
        return $.ajax2({                 
                data : params,
                url:"{url_to('customers_contracts_ajax',['action'=>'ViewDateFieldForContract'])}",
                errorTarget: ".customers-contract-dates-errors",                
                loading: "#tab-site-dashboard-customers-contract-dates-loading",
                target: ".CustomerContractDatesField-ctn[id={$form->getContract()->get('id')}][name={$form->getValue('field')}]"
                 }); 
     });
     
     
      $("#CustomerContractDatesFieldActions-Save-{$form->getContract()->get('id')}-{$form->getValue('field')}").click(function () { 
         var params= { CustomerContractDatesField : {
                      field : '{$form->getValue('field')}',
                      id : '{$form->getContract()->get('id')}',
                      value : $(".CustomerContractDatesFieldModify-{$form->getContract()->get('id')}-{$form->getValue('field')}").val(),
                      token : '{mfForm::getToken('CustomerContractDateFieldForm')}'
            } };
        return $.ajax2({                 
                data : params,
                url:"{url_to('customers_contracts_ajax',['action'=>'SaveDateFieldForContract'])}",
                errorTarget: ".customers-contract-dates-errors",                
                loading: "#tab-site-dashboard-customers-contract-dates-loading",               
                success : function (resp)
                        {
                            if (resp.error) {  return  };
                            $(".CustomerContractDatesField-ctn[id={$form->getContract()->get('id')}][name={$form->getValue('field')}]").html(resp);
                            console.log("{$form->getContract()->get('dates_is_valid')}");
                            {if $form->getContract()->get('dates_is_valid')=='YES'}                                
                            $(".CustomerContractDatesField[id={$form->getContract()->get('id')}][name=dates_is_valid]").html("{__('YES')}");
                            {/if}
                        }
                 }); 
     });
</script>