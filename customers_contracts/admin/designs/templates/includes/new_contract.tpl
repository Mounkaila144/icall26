<table class="tab-form"> 
    <tr>      
        <td class="label">{__('Contract date')}</td>
        <td>                       
                <div class="error-form">{$form.contract.opened_at->getError()}</div>            
                <input type="text" class="CustomerContractForNewContract date" name="opened_at" value="{if $form->hasErrors()}{$contract->get('opened_at')}{else}{format_date($contract->get('opened_at'),"a")}{/if}"/>           
        </td>
    </tr>
     <tr>
        <td class="label">{__('Amount with taxes')}</td>
        <td>                    
                <div class="error-form">{$form.contract.total_price_with_taxe->getError()}</div>
                <input type="text" class="CustomerContractForNewContract" name="total_price_with_taxe" value="{format_number($contract->getPriceWithTax(),"#.00")}"/>
                <span class="label">{__('Tax')}</span>{html_options class="CustomerContractForNewContract options" name="tax_id" options=$form->contract.tax_id->getOption('choices') selected=$contract->get('tax_id')}           
        </td>
    </tr>
    <tr>
        <td class="label">{__('Amount without taxes')}</td>
        <td>                                      
                <div class="error-form">{$form.contract.total_price_without_taxe->getError()}</div>
               <input type="text" class="CustomerContractForNewContract" name="total_price_without_taxe" value="{format_number($contract->getPriceWithoutTax(),"#.00")}"/>                                       
        </td>
    </tr>
    {if $settings_contract->get('tax_amount_display')=='YES'}
    <tr>
        <td class="label">{__('Amount taxe')}</td>
        <td>           
            <div id="tax_amount">{format_number($contract->getTaxAmount(),"#.00")}</div>
        </td>
    </tr>
    {/if}
    <tr>
        <td class="label">{__('Financial partner')}</td>
        <td>                      
            <div></div>
            {html_options_format format="__" class="CustomerContractForNewContract options" name="financial_partner_id" options=$form->contract.financial_partner_id->getOption('choices') selected=$contract->get('financial_partner_id')}           
        </td>
    </tr>   
    <tr>
        <td class="label">{__('State')}</td>
        <td>                                  
                {html_options class="CustomerContractForNewContract options" name="state_id" options=$form->contract.state_id->getOption('choices') selected=$contract->get('state_id')}             
        </td>
    </tr>   
    <tr>        
        <td class="label">{__('Study sending date')}</td>
        <td>            
            <div class="error-form">{$form.contract.apf_at->getError()}</div>
            <input type="text" class="CustomerContractForNewContract date" name="apf_at" value="{format_date($contract->get('apf_at'),"a")}"/>           
        </td>
    </tr>
    <tr>
        <td class="label">{__('OPC sending date')}</td>
        <td>                        
            <div class="error-form">{$form.contract.opc_at->getError()}</div> 
           <input type="text" class="CustomerContractForNewContract date" name="opc_at" value="{format_date($contract->get('opc_at'),"a")}"/>        
        </td>
    </tr>
        <tr>        
        <td class="label">{__('Payment date')}</td>
        <td>
            <div class="error-form">{$form.contract.payment_at->getError()}</div>
            <input type="text" class="CustomerContractForNewContract date" name="payment_at" value="{format_date($contract->get('payment_at'),"a")}"/>            
        </td>
    </tr>
    <tr>
        <td class="label">{__('Reference')}</td>
        <td>            
             <div class="error-form">{$form.contract.reference->getError()}</div>             
             <input type="text" class="CustomerContractForNewContract" name="reference" value="{$contract->get('reference')}"/>            
        </td>
    </tr>
</table>
<script type="text/javascript">
            
    function ttcTohtForNew()
    {               
      var n=$('.CustomerContractForNewContract[name=total_price_with_taxe]').val().replace(/,/,".") / (1 + $(".CustomerContractForNewContract[name=tax_id] option:selected").html().replace(/%/,"").replace(/,/,".") /100);            
      $('.CustomerContractForNewContract[name=total_price_without_taxe]').val((isNaN(n) ? '':truncate(n)));
      ttcToTaxForNew();
    }
    
    function htTottcForNew()
   { 
       var n=$('.CustomerContractForNewContract[name=total_price_without_taxe]').val().replace(/,/,".") * (1 + $(".CustomerContractForNewContract[name=tax_id] option:selected").html().replace(/%/,"").replace(/,/,".") /100);                     
       $('.CustomerContractForNewContract[name=total_price_with_taxe]').val((isNaN(n) ? '':truncate(n)));
       ttcToTaxForNew();
    }
    
    function ttcToTaxForNew()
    {
        var n=$('.CustomerContractForNewContract[name=total_price_without_taxe]').val().replace(/,/,".") * $(".CustomerContractForNewContract[name=tax_id] option:selected").html().replace(/%/,"").replace(/,/,".") /100;                     
        $('#tax_amount').html((isNaN(n) ? '':truncate(n))); 
    }
    
    function truncate(n)
    {
        var pos=n.toString().search("\\.");
        return (pos>0)?n.toString().slice(0,pos+(2+1)).replace(/\./,","):n;
    }
       
    
    $('.CustomerContractForNewContract[name=total_price_without_taxe]').keyup(function () {
        if (isNaN($(this).val().replace(/,/,".")))         
            alert("{__('#0# is not a number')}".format($(this).val()));            
        else
           htTottcForNew();   
    });
    
    $('.CustomerContractForNewContract[name=total_price_with_taxe]').keyup(function () {
        if (isNaN($(this).val().replace(/,/,".")))         
           alert("{__('#0# is not a number')}".format($(this).val()));            
        else
           ttcTohtForNew();   
    });
        
     
    {if $settings_contract->get('ttc_change_by_tax')=='YES'}
     $('.CustomerContractForNewContract[name=tax_id]').change(function () {
          htTottcForNew();          
     });
    {else}
     $('.CustomerContract[name=tax_id]').change(function () {
          ttcTohtForNew();          
     });
    {/if} 
</script> 