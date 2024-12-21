{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $simulation->isLoaded()}
{$simulation->getCustomer()|upper}    

<table style="width: 52%;">       
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
{foreach $simulation->getProducts() as $product} 
    <tr>        
        <td>
             {$product->get('title')}         
        </td>
        <td>{$product->getFormattedQuantity()}</td>        
        <td>{$product->getFormattedSalePriceWithoutTax()}</td>
        <td>{$product->getFormattedTotalSalePriceWithoutTax()}</td>   
        <td>{$product->getFormattedTotalSalePriceWithTax()}</td>          
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
        <strong>{$simulation->getFormattedTotalSaleWithoutTax()}</strong>
    </td>
    <td>
         <strong>{$simulation->getFormattedTotalSaleWithTax()}</strong>
    </td>
</tr>
</table>

    <div style="margin-top: 25px;">
        <table style="display:inline;">
            <tr>
            <td>
                    {__('Configuration')}
                </td>
            </tr>
            <tr>
                <td>
                   {__('Prime')} 
                </td>
                <td>
                   {$simulation->getFormatter()->getPrime()}
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
                   {$simulation->getFormatter()->getTaxCreditLimit()}
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
                   {$simulation->getFormatter()->getNumberOfPeople()}
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
                   {$simulation->getFormatter()->getNumberOfChildren()}
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
                   {$simulation->getFormatter()->getTaxCreditLimit()}
                </td>

                <td>

                </td>
                <td>

                </td>

                <td>

                </td>
            </tr>
        </table>
  
        <table style="display:inline; margin-left: 128px;">
        <tr>
            <td>
               {__('Works amount')} 
            </td>
            <td>
               {$simulation->getFormattedTotalSaleWithTax()}
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
              {__('Prime')} 
           </td>
           <td>
              {$simulation->getFormatter()->getPrime()}
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
               {*__('Rest in charge after credit')*} 
               {__('Rest in charge after prime')} 
            </td>
            <td>
               {$simulation->getFormatter()->getRestInChargeAfterPrime()}
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
               {__('Tax credit 30%%')} 
            </td>
            <td>
               {$simulation->getFormatter()->getTaxCreditAmount()}
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
               {$simulation->getFormatter()->getRestInChargeAfterCredit()}
            </td>

            <td>

            </td>
            <td>

            </td>

            <td>

            </td>
        </tr>

    </table>
</div>
<script type="text/javascript">
 
 
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeSimulationForMeetingView-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$simulation->getMeeting()->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$simulation->getMeeting()->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       
     
</script>   


{else}
    {__('Simulation is invalid.')}        
{/if}    


