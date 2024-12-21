<tr>
    <td>
    <input type="checkbox" class="CustomerContractDocumentExportMultipleActions" name="domoprime_export_pdf" value="" {if $form->hasAction('domoprime_export_pdf')}checked=""{/if}/>
    {__('Attestation')}
    </td>
    <td>
        
    </td>
</tr>   
<tr>
    <td>
    <input type="checkbox" class="CustomerContractDocumentExportMultipleActions" name="domoprime_quotation_pdf" value="" {if $form->hasAction('domoprime_quotation_pdf')}checked=""{/if}/>
    {__('Quotation')}
    </td>
    <td>
        
    </td>
</tr>  
<tr>
    <td>
    <input type="checkbox" class="CustomerContractDocumentExportMultipleActions" name="domoprime_billing_pdf" value="" {if $form->hasAction('domoprime_billing_pdf')}checked=""{/if}/>
    {__('Billing')}
    </td>
    <td>
        
    </td>
</tr>      