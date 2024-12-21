{messages class="site-contract-errors-{$item->getContract()->get('id')}"}
<h3>{__("View product")|capitalize}</h3>
<div>
    <a href="#" class="btn" id="CustomerContracts-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" class="btn" id="CustomerContracts-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>   
</div>
{if $item->isLoaded()}
 <table id="Product-form">                
    <tr>
        <td>{__("Product")}
        </td>
        <td>                    
           <div class="product-errors-form">{$form.product_id->getError()}</div>
            {html_options name="product_id" class="Products-{$item->get('id')}" options=$form->product_id->getOption('choices') selected=$item->get('product_id')} 
        </td>
    </tr>            
    <tr>
        <td>{__("Details")}
        </td>
        <td>
            <div class="product-errors-form">{$form.details->getError()}</div>  
            <input type="text" id="" class="Products-{$item->get('id')}" name="details" value="{$item->get('details')|escape}" size="30"/>          
        </td>
    </tr>
</table>   
{else}      
    <span>{__('Meeting is invalid.')}</span> 
{/if}    

  <script type="text/javascript">
       
        $(".Products-{$item->get('id')}").click(function() { $("#CustomerContracts-Save").show(); });
    
        $(".Products-{$item->get('id')}").change(function() { $("#CustomerContracts-Save").show(); });
    
        $("#CustomerContracts-Save").click( function () {    
            var params= { ContractProduct: { id: "{$item->get('id')}",
                                            product_id: $(".Products-{$item->get('id')}[name=product_id] option:selected").val(),
                                            token :'{$form->getCSRFToken()}' } };
             $("input.Products-{$item->get('id')}[type=text]").each(function() { params.ContractProduct[this.name]=$(this).val(); });
            // alert("Params="+params.products.toSource()); return false;           
            return $.ajax2({     
                data : params,
                url: "{url_to('customers_contracts_ajax',['action'=>'SaveContractProduct'])}",
                errorTarget: ".customers-contract-site-errors",
                loading: "#tab-site-dashboard-site-customers-meeting-loading",                          
                target: "#tab-customer-contracts-products-{$item->getContract()->get('id')}"
           });
       });
       
       $("#CustomerContracts-Cancel").click( function () {                           
            return $.ajax2({     
                data : { Contract: {$item->getContract()->get('id')} },
                url: "{url_to('customers_contracts_ajax',['action'=>'ListContractProduct'])}",
                errorTarget: ".customers-contract-site-errors",
                loading: "#tab-site-dashboard-site-customers-contract-loading",                          
                target: "#tab-customer-contracts-products-{$item->getContract()->get('id')}"
           });
       });
        
</script>