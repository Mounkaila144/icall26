<div>
            <a href="#" class="btn" id="{$site->getSiteID()}-CustomerContracts-NewProduct" title="{__('new product')}" ><img  src="{url('/icons/new.gif','picture')}" alt="{__('new')}"/>{__('New product')}</a>
</div>
{if $contract->hasContractProducts()}   
    <table id="CustomerContracts-Product-List" class="tabl-list">
        <tr class="list-header">
            <th>{__('Product')}
            </th>
            <th>{__('Detail')}
            </th>
            <th>{__('Actions')}
            </th>
        </tr>
    {foreach $contract->getContractProducts() as $contract_product}
        <tr class="CustomerContractsProduct list" id="CustomerContractsProduct-{$contract_product->get('id')}">
            <td> {$contract_product->getProduct()->get('meta_title')}     
            </td>
            <td>{$contract_product->get('details')} 
            </td>   
            <td>
                <a href="#" title="{__('Edit')}" class="CustomerContracts-ViewProduct" id="{$contract_product->get('id')}">
                     <img  src="{url('/icons/edit.gif','picture')}" alt='{__("Edit")}'/></a> 
                 <a href="#" title="{__('Delete')}" class="CustomerContracts-DeleteProduct" id="{$contract_product->get('id')}"  name="{$contract_product->getProduct()->get('meta_title')}">
                   <img  src="{url('/icons/delete.gif','picture')}" alt='{__("Delete")}'/>
                </a>   
            </td>
        </tr>
    {/foreach}    
    </table>    
{else}
    <span>{__('No product available.')}</span>
{/if}    
<script type="text/javascript">
        
       $(".CustomerContracts-DeleteProduct").click( function () {    
            if (!confirm('{__("Product \"#0#\" will be deleted. Confirm ?")}'.format(this.name))) return false; 
            return $.ajax2({     
                data : { ContractProduct: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'DeleteContractProduct'])}",
               // errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                errorTarget:".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",
                success: function (resp)
                         {
                             if (resp.action=='DeleteContractProduct')
                             {
                                 $("#CustomerContractsProduct-"+resp.id).remove();    
                                 if ($(".CustomerContractsProduct").length==0)
                                 {
                                      $("#CustomerContracts-Product-List").after("{__("No product")}");
                                 }    
                             }    
                         }
           });
       });
       
       $(".CustomerContracts-ViewProduct").click( function () {                           
            return $.ajax2({     
                data : { ContractProduct: $(this).attr('id') },
                url: "{url_to('customers_contracts_ajax',['action'=>'ViewContractProduct'])}",
               // errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                errorTarget:".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                           
                target: "#tab-customer-contracts-products-{$contract->get('id')}"
           });
       });
       
        $("#{$site->getSiteID()}-CustomerContracts-NewProduct").click( function () {                           
            return $.ajax2({     
                data : { Contract: "{$contract->get('id')}" },
                url: "{url_to('customers_contracts_ajax',['action'=>'NewContractProduct'])}",
                // errorTarget: ".{$site->getSiteID()}-customers-contract-site-errors",
                errorTarget:".site-contract-errors-{$contract->get('id')}",
                loading: "#tab-site-{$site->getSiteID()}-dashboard-site-customers-contract-loading",                          
                target: "#tab-customer-contracts-products-{$contract->get('id')}"
           });
       });
        
    </script>