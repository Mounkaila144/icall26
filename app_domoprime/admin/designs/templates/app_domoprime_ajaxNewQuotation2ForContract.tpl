{messages class="customers-contract-app-domoprime-quotation2-contract-errors"}
{if $contract->isLoaded()}
{$contract->getCustomer()|upper}    
<div>
   <a href="#" id="DomoprimeQuotationForContractNew2-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeQuotationForContractNew2-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>

<table> 
    <tr>
        {foreach $form->getProducts() as $product}
        <th>{$product->get('meta_title')}</th>
        {/foreach}
    </tr>
    <tr>
    {foreach $form->getProducts() as $product}              
            <td>
                <table>
                    <tr>
                        <td></td>
                        <td>{__('Article')}</td>
                         <td>{__('Quantity')}</td>
                    </tr>
        {foreach $product->getProductItems() as $item}
            <tr style="vertical-align:top">
                <td>
                    <input type="checkbox" data-json='{$item->getItems()->getSlaves()->toJson()}' data-product="{$product->get('id')}" id="{$item->get('id')}" class="DomoprimeQuotation2ForContract Fields Checkbox" {if $form->hasQuantityByItem($item)}checked=""{/if}/>
                </td>
                <td>
                  {$item->getReference()->ucfirst()}                   
                </td>         
                <td>
                     <input type="text" size="5" id="{$item->get('id')}" class="DomoprimeQuotation2ForContract Fields Input" value="{$form->getQuantityByItem($item)}"/>
                </td>
            </tr>
        {/foreach}
        </table>
        </td>      
    {/foreach} 
    </tr> 
</table>
<script type="text/javascript">
        $(".DomoprimeQuotation2ForContract.Checkbox").change(function () {            
            var elm = $(this);
            $.each($(this).data('json'),function (idx,id) { 
                $(".DomoprimeQuotation2ForContract[id="+id+"]").prop('checked',elm.prop('checked'));
            });
        });
       
          $(".DomoprimeQuotation2ForContract.Fields").click(function () {   $("#DomoprimeQuotationForContractNew2-Save").show();   });
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForContractNew2-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_ajax',['action'=>'ListPartialQuotationForContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation2-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                            target: "#tab-customer-contracts-quotations-{$contract->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       $('#DomoprimeQuotationForContractNew2-Save').click(function(){                             
            var  params= {      Contract: '{$contract->get('id')}',       
                                DomoprimeQuotation: {                         
                                   items : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };
         $(".DomoprimeQuotation2ForContract.Checkbox:checked").each(function () { 
               params.DomoprimeQuotation.items.push({ item_id: $(this).attr('id'), quantity: $(".DomoprimeQuotation2ForContract.Input[id="+$(this).attr('id')+"]").val()  }); 
         });                                                                  
          //alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_ajax',['action'=>'NewQuotation2ForContract'])}",
                           errorTarget: ".customers-contract-app-domoprime-quotation2-contract-errors",    
                           loading: "#tab-site-dashboard-customers-contract-loading",
                           target: "#tab-customer-contracts-quotations-{$contract->get('id')}" }); 
        }); 
     
</script>   


{else}
    {__('Contract is invalid.')}        
{/if}    


