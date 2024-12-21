<table>    
    {if $form->attributions->hasValidator('team_id')}
    <tr>
        <td>{__('Team')}
        </td>
        <td>
          {html_options name="team_id" class="ContractContributorsNewContract" options=$form->attributions.team_id->getOption('choices') selected=$contract->get('team_id')}
        </td>       
    </tr>
    {/if}
       {foreach $form->attributions.contributors->getFields() as $field}
           <tr class="ContractContributorsForNewContractList" name="{$field}">
                <td>{__($field)}</td>
                <td>
                    {html_options name="user_id" class="ContractContributorsForNewContract ContractContributorsForNewContract-`$field`" options=$form->attributions.contributors[$field]['user_id']->getOption('choices') selected=$form.attributions.contributors[$field]['user_id']}             
                    {html_options name="attribution_id" class="ContractContributorsForNewContract ContractContributorsForNewContract-`$field`" options=$form->attributions.contributors[$field]['attribution_id']->getOption('choices') selected=$form->attributions.contributors[$field]['attribution_id']}
                </td>        
            </tr> 
       {/foreach}      
</table> 