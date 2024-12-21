  {if $form->hasActionInValidator('generate_cumac')}
<tr>
       <td>
          <input type="checkbox" class="CustomerContractMultipleActions" name="generate_cumac" value="" {if $form->hasAction('generate_cumac')}checked=""{/if}/>
        </td>
        <td>{__('Generate Cumac')}</td>
        <td>            
        </td>       
    </tr>   
    {/if}
      {if $form->hasActionInValidator('generate_billings')}
<tr>
       <td>
          <input type="checkbox" class="CustomerContractMultipleActions" name="generate_billings" value="" {if $form->hasAction('generate_billings')}checked=""{/if}/>
        </td>
        <td>{__('Generate billings')}</td>
        <td>            
        </td>       
    </tr>   
    {/if}
          {if $form->hasActionInValidator('delete_cumac')}
<tr>
       <td>
          <input type="checkbox" class="CustomerContractMultipleActions" name="delete_cumac" value="" {if $form->hasAction('delete_cumac')}checked=""{/if}/>
        </td>
        <td>{__('Delete cumac calculation')}</td>
        <td>            
        </td>       
    </tr>   
    {/if}
