{messages class="ContractAttributions-errors"}
<table>    
    <tr>
        <td>{__('Team')}
        </td>
        <td>{if $contract->hasTeam()}
                <span>{$contract->getTeam()->get('name')}</span>                
            {else}
                 {__('No team affected.')}
            {/if}  
        </td>
    </tr>
 
{foreach $contract->getContributors() as $contributor}
    <tr>
        <td>{__($contributor->get('type'))}</td>
        <td>{if $contributor->hasUser()}
                <span>{$contributor->getUser()}</span>
               <span>{$contributor->getUserAttribution()->getUserAttributionI18n()->get('value')}</span>  
            {else}
                 {__('No user affected.')}
            {/if}    
        </td>
    </tr>    
{/foreach}  
</table>
{if $user->hasCredential([['superadmin','admin','contract_attributions_modify']])}
<a href="#" id="ContractAttributions-Modify" class="btn">{__('Modify')}</a>  
{/if}
<script type="text/javascript">
 
    $("#ContractAttributions-Modify").click(function(){
       return $.ajax2({                    
                data : { Contract: "{$contract->get('id')}" },
                url: "{url_to('customers_contracts_ajax',['action'=>'ModifyAttributions'])}",
                errorTarget: ".ContractAttributions-errors",
                loading: "#tab-site-dashboard-site-customers-contract-loading",                          
                target: "#tab-customer-contracts-attributions-{$contract->get('id')}"
           });  // tab-customer-contracts-attributions
    
    });
</script> 