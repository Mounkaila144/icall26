<fieldset>
    <h3>{__('Financial information')}</h3>
    <table>
        <tr>
            <td>{__('Credit amount')}</td>
            <td>
                <div>{$form.financial.credit_amount->getError()}</div> 
                <input type="text" class="CustomerFinancial-{$meeting->get('id')}" name="credit_amount" value="{$meeting->getCustomer()->getFinancial()->get('credit_amount')}"/>
            </td>
             <td>
                {__('Credit used')}
            </td>
            <td>
                <div>{$form.financial.credit_used->getError()}</div> 
                  <input type="checkbox" class="CustomerFinancial-{$meeting->get('id')}" name="credit_used" {if $meeting->getCustomer()->getFinancial()->get('credit_used')=='YES'}checked=""{/if}"/>
            </td>
             <td>{__('Credit date')}
            </td>
            <td><div>{$form.financial.credit_date->getError()}</div> 
                 <input type="text" class="CustomerFinancial-{$meeting->get('id')}" name="credit_date" value="{$meeting->getCustomer()->getFinancial()->get('credit_date')}"/>
            </td>
        </tr>
    </table>
</fieldset>