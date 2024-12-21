{if $formFilter->equal->hasValidator('class_energy_sector')}
    <div>
       <div style="width:100px" class="displayInLine">{__('Class/Energy/Zone')}</div>  
       {html_options class="widthSelect CustomerContracts-equal"  name="class_energy_sector" options=$formFilter->equal.class_energy_sector->getOption('choices') selected=(string)$formFilter.equal.class_energy_sector}             
    </div>
{/if}
