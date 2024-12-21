{if $form->hasActionInValidator('meeting_iso_generate_cumac')}
<tr>
    <td>
       <input type="checkbox" class="CustomerMeetingMultipleActions" name="iso_generate_cumac" value="" {if $form->hasAction('iso_generate_cumac')}checked=""{/if}/>
     </td>
     <td>{__('Generate Cumac')}</td>
     <td>            
     </td>       
</tr>   
{/if}      
    
