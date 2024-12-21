{messages class="customers-contract-app-domoprime-quotation-contract-errors"}
{if $contract->isLoaded()}
{if $item->isLoaded()}
{$item->getCustomer()|upper}    
<div>
   <a href="#" id="DomoprimeQuotationForContractView-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeQuotationForContractView-Cancel" class="btn">
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
        </table>
<script type="text/javascript">
 
 
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForContractView-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       
     
</script>   


{else}
    {__('Quotation is invalid.')}        
{/if}    

{else}
    {__('Contract is invalid.')}
{/if}    

