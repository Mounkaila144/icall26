{if $form->isValid()}
{messages class="meeting-mutual-calculation-errors"}
<h3>{__('Meeting calculation')}</h3>    
<table class="tabl-list  footable table" cellpadding="0" cellspacing="0"> 
    <thead> 
    <tr class="list-header">   
        <th class="footable-first-column" data-toggle="true">
            <span>{__('Meeting')}</span>
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Commission')}</span>               
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Decommission')}</span>  
        </th>
        <th data-hide="phone" style="display: table-cell;">
            <span>{__('Calculation date')}</span>                 
        </th> 
    </tr>
    </thead>
    <tr class="MutualCalculationMeeting list" id="MutualCalculationMeeting">        
        <td>{$engine_calculation->getMeeting()->getCustomer()|upper}</td>
        <td>{$engine_calculation->getCommissionI18n()}</td>
        <td>{$engine_calculation->getDecommissionI18n()}</td>
        <td>{$engine_calculation->getDateCalculation()}</td>  
    </tr>     
</table> 
<table class="tabl-list footable table">
    <thead>
        <tr class="list-header">
            <th>{__('Mutual')}</th>
            <th>{__('Products')}</th>
            <th>{__('Commission')}</th>
            <th>{__('Decommission')}</th>
        </tr>
    </thead>
    <tbody>
        {foreach $engine_calculation->getMutualCalculations() as $mutual_calculation}
            <tr class="list">
                <td rowspan="{$mutual_calculation->getProductCalculations()->count()+1}">{$mutual_calculation->getMutualPartnerForEngine()}</td> 
            </tr>
            {foreach $mutual_calculation->getProductCalculations() as $product}
            <tr class="list">
                <td>{$product->geMutualProductForEngine()}</td>
                <td>{$product->getCommissionI18n()}</td>
                <td>{$product->getDecommissionI18n()}</td>
            </tr>
            {/foreach}
        {/foreach}
    </tbody>
</table>  
  
<script type="text/javascript">

    
</script>  
{/if}