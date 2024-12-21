{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $item->isLoaded()}
{$item->getCustomer()|upper}    
<div>
   <a href="#" id="DomoprimeSimulationForMeetingView-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeSimulationForMeetingView-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>

        <table>       
            <tr>
                <th>
                    {__('Designation')}
                </th>
                <th>
                    {__('Quantity')}
                </th>
                <th>
                    {__('Unit Sale Price HT')}
                </th>
                <th>
                    {__('Total Sale HT')}
                </th>
                  <th>
                    {__('Total Sale TTC')}
                </th>
            </tr>
{foreach $item->getProductsWithItems() as $product}
    <tr>
        <td>{$product->get('title')}</td>
        <td>{*$product->get('quantity')*}</td>        
        <td>{*$product->getSalePriceWithoutTax()*}</td>
        <td>{*$product->getTotalSalePriceWithoutTax()*}</td>   
        <td>{*$product->getTotalSalePriceWithTax()*}</td>   
    </tr>
    <tr>
        {foreach $product->getItems() as $product_item}
        <td>
             {$product_item->get('title')}         
        </td>
        <td>{$product_item->getFormattedQuantity()}</td>        
        <td>{$product_item->getFormattedSalePriceWithoutTax()}</td>
        <td>{$product_item->getFormattedTotalSalePriceWithoutTax()}</td>   
        <td>{$product_item->getFormattedTotalSalePriceWithTax()}</td>   
        {/foreach}    
    </tr>
{/foreach} 
<tr>
    <td>
        
    </td>
    <td>
        <strong>{__('Total')}</strong>
    </td>
    <td>
        
    </td>
    <td>
        <strong>{$item->getFormattedTotalSaleWithoutTax()}</strong>
    </td>
    <td>
         <strong>{$item->getFormattedTotalSaleWithTax()}</strong>
    </td>
</tr>
<tr>
    <td>
       {__('Prime')} 
    </td>
    <td>
       {$item->getFormatter()->getPrime()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
<tr>
    <td>
       {__('Tax limit credit')} 
    </td>
    <td>
       {$item->getFormatter()->getTaxCreditLimit()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
<tr>
    <td>
       {__('Number of people')} 
    </td>
    <td>
       {$item->getFormatter()->getNumberOfPeople()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
<tr>
    <td>
       {__('Number of children')} 
    </td>
    <td>
       {$item->getFormatter()->getNumberOfChildren()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
<tr>
    <td>
       {__('Tax credit available')} 
    </td>
    <td>
       {$item->getFormatter()->getTaxCreditAvailable()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
<tr>
    <td>
       {__('Rest in charge')} 
    </td>
    <td>
       {$item->getFormatter()->getRestInCharge()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
<tr>
    <td>
       {__('Rest in charge after credit')} 
    </td>
    <td>
       {$item->getFormatter()->getRestInChargeAfterCredit()}
    </td>
    
    <td>
        
    </td>
    <td>
        
    </td>
    
    <td>
        
    </td>
</tr>
        </table>
<script type="text/javascript">
 
 
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeSimulationForMeetingView-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$item->getMeeting()->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$item->getMeeting()->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       
     
</script>   


{else}
    {__('Simulation is invalid.')}        
{/if}    


