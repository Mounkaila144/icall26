<fieldset>
    <h3>{__('Financial information')}</h3>
    <table>
        <tr>
            <td>{__('Credit amount')}</td>
            <td>
                <div>{$form.financial.credit_amount->getError()}</div> 
                <input type="text" class="CustomerFinancial" name="credit_amount" value="{$item->getCustomer()->getFinancial()->get('credit_amount')}"/>
            </td>
             <td>
                {__('Credit used')}
            </td>
            <td>
                <div>{$form.financial.credit_used->getError()}</div> 
                  <input type="checkbox" class="CustomerFinancial" name="credit_used" {if $item->getCustomer()->getFinancial()->get('credit_used')=='YES'}checked=""{/if}"/>
            </td>
            <td>{__('Credit date')}
            </td>
            <td><div>{$form.financial.credit_date->getError()}</div> 
                 <input type="text" class="CustomerFinancial" name="credit_date" value="{$item->getCustomer()->getFinancial()->get('credit_date')}"/>
            </td>
        </tr>
    </table>
</fieldset>
            
         