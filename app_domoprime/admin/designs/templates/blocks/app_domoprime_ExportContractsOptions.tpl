 {if $formFilter->options->hasValidator('with_cumac')}
<div>  
     <input class="{if $class}{$class}{else}CustomerContractExportOptions{/if} Checkbox" name="with_cumac" type="checkbox" {if $formFilter.options.with_cumac->getValue()}checked=""{/if}/>{__('Cumac')}   
</div>
{/if}    
