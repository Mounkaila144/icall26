 {if $user->hasCredential([['superadmin','admin','app_domoprime_iso_contract_generate_calculation']])} 
   <a href="#" style="{if $item->isHold()}opacity:0.3{/if}" title="{__('Generate Cumac')}" class="DomoprimeIso-Contract-Generate-Cumac CustomerContractActions {if $item->isHold()}Hold{/if}" id="{$item->get('id')}">
       <i class="fa fa-calculator" style="color:blue;font-size:16px"/></a>      
{/if}

