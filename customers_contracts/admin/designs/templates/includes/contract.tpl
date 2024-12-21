<table>
   {* <tr>
        <td>{__('id')}
        </td>
        <td>{$contract->get('id')}
        </td>
    </tr> *}
    <tr>      
        <td>{__('Contract date')}</td>
        <td>
            {if $user->hasCredential([['superadmin','admin','contract_modify']])}                           
                <div>{$form.opened_at->getError()}</div>            
                <input type="text" class="CustomerContract date" name="opened_at" value="{format_date($contract->get('opened_at'),"a")}"/>
            {else}
                 <div>{format_date($contract->get('opened_at'),"a")}</div>
            {/if}
        </td>
    </tr>
     <tr>
        <td>{__('Amount with taxes')}</td>
        <td>
            {if $user->hasCredential([['superadmin','admin','contract_modify']])}               
            <div>{$form.total_price_with_taxe->getError()}</div>
            <input type="text" class="CustomerContract" name="total_price_with_taxe" value="{format_number($contract->get('total_price_with_taxe'),"#.00")}"/>
            {__('Tax')}{html_options_format format="pourcentage" class="CustomerContract options" name="tax_id" options=$form->tax_id->getOption('choices') selected=$contract->get('tax_id')}
            {else}
            <div>{format_number($contract->get('total_price_with_taxe'),"#.00")}</div>
           
            {/if}
        </td>
    </tr>
    <tr>
        <td>{__('Amount without taxes')}</td>
        <td>
            {if $user->hasCredential([['superadmin','admin','contract_modify']])}                  
             <div>{$form.total_price_without_taxe->getError()}</div>
            <input type="text" class="CustomerContract" name="total_price_without_taxe" value="{format_number($contract->get('total_price_without_taxe'),"#.00")}"/>
            {else} 
             <div>{format_number($contract->get('total_price_without_taxe'),"#.00")}
                </div>            
            {/if}
        </td>
    </tr>
    <tr>
        <td>{__('Financial partner')}</td>
        <td>
            {if $user->hasCredential([['superadmin','admin','contract_modify']])}                   
            <div></div>
            {html_options_format format="__" class="CustomerContract options" name="financial_partner_id" options=$form->financial_partner_id->getOption('choices') selected=$contract->get('financial_partner_id')}
            {else} 
            <div>{if $contract->hasPartner()}{$contract->getPartner()}{else}{__('Not defined')}{/if}</div>            
            {/if}
        </td>
    </tr>
    <tr>
        <td>{__('State')}</td>
        <td>  
            {if $user->hasCredential([['superadmin','admin','contract_modify']])}             
                {html_options class="CustomerContract options" name="state_id" options=$form->state_id->getOption('choices') selected=$contract->get('state_id')}
             {else}   
                    <div>{$contract->getStatus()->getCustomerContractStatusI18n()}</div>            
            {/if}
        </td>
    </tr>
    <tr>        
        <td>{__('Payment date')}</td>
        <td>{if $user->hasCredential([['superadmin','admin','contract_modify']])}               
            <div>{$form.payment_at->getError()}</div>
            <input type="text" class="CustomerContract date" name="payment_at" value="{format_date($contract->get('payment_at'),"a")}"/>
            {else}
             <div>{format_date($contract->get('payment_at'),"a")}</div>            
            {/if}
        </td>
    </tr>
    <tr>
        <td>{__('OPC sending date')}</td>
        <td>
            {if $user->hasCredential([['superadmin','admin','contract_modify']])}                 
            <div>{$form.opc_at->getError()}</div> 
           <input type="text" class="CustomerContract date" name="opc_at" value="{format_date($contract->get('opc_at'),"a")}"/>
           {else}  
            <div>{format_date($contract->get('opc_at'),"a")}</div>            
           {/if}
        </td>
    </tr>
    <tr>
        <td>{__('Reference')}</td>
        <td>
             {if $user->hasCredential([['superadmin','admin','contract_modify']])}                  
             <div>{$form.reference->getError()}</div>             
             <input type="text" class="CustomerContract" name="reference" value="{$contract->get('reference')}"/>
             {else}  
              <div>{$contract->get('reference')}</div>             
             {/if}
        </td>
    </tr>
</table>