{messages class="customers-contract-app-domoprime-quotation-contract-errors"}
{if $contract->isLoaded()}
{if $quotation->isLoaded()}
{$quotation->getCustomer()|upper}    
<div>
   <a href="#" id="DomoprimeQuotationForContractView-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeQuotationForContractView-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{__('Reference')}:{$quotation->getReference()}
 <table>
     <tr class="DomoprimeQuotationForContract"> 
        <td>
            <div>{$form.dated_at->getError()}</div>
            <div>
            {__('Date')}
            <input type="text" class="DomoprimeQuotationForContract Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$quotation->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
            </div>
        </td>
    </tr>
    {if $form->hasValidator('fixed_prime')}
     <tr>
        <td>  
             <div>{$form.fixed_prime->getError()}</div>
             <div>
                {__('Fixed prime')}{if $form->fixed_prime->getOption('required')}*{/if}
                <input  type="text" class="DomoprimeQuotationForContract Fields Input" value="{$quotation->getFormatter()->getFixedPrime()->getText("#.00")}" name="fixed_prime"/>
             </div>
        </td>
    </tr> 
    {/if}
    {if $form->hasValidator('header')}
    <tr class="DomoprimeQuotationForContract"> 
        <td>
            <div>{$form.header->getError()}</div>
            <div>
            {__('Header')}{if $form->header->getOption('required')}*{/if}
           <input type="text" size="40" class="DomoprimeQuotationForContract Fields Input" name="header" value="{$quotation->get('header')}"/>
            </div>
        </td>
    </tr>
    {/if}
{foreach $form->getProducts() as $product}    
    <tr class="DomoprimeQuotationForContract-Products" id="{$product->get('id')}"> 
        <td>
            <strong>{$product->get('meta_title')|upper}</strong>
        </td>
    </tr>
    <tr>
        <td>  
            {__('Quantity')}
             <input  type="text" class="DomoprimeQuotationForContract Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity'],'#.00')}" name="quantity"/>
        </td>
    </tr> 
    <tr>
        <td>
             {foreach $product->getProductItems() as $item}
            <div>                
               <input  type="checkbox" {if $item->isMandatory()}disabled=""{/if} class="DomoprimeQuotationForContract ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item) || $item->isMandatory()}checked=""{/if}/>{$item->get('reference')}
            </div>
        {/foreach}  
        </td>
    </tr>
{/foreach}    
</table>
 {if $form->hasValidator('footer')}
    <tr class="DomoprimeQuotationForContract"> 
        <td>
            <div>{$form.footer->getError()}</div>
            <div>
            {__('Footer')}{if $form->footer->getOption('required')}*{/if}
            <textarea cols="40" rows="4" class="DomoprimeQuotationForContract Fields Input" name="footer">{$quotation->get('footer')}</textarea>
            </div>
        </td>
    </tr>
    {/if}
<script type="text/javascript">
          $(".DomoprimeQuotationForContract.Date").datepicker();
   
          $(".DomoprimeQuotationForContract.Fields").click(function () {   $("#DomoprimeQuotationForContractView-Save").show();   });
            
 
         
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
      
       
      $('#DomoprimeQuotationForContractView-Save').click(function(){                             
            var  params= {      Contract: '{$contract->get('id')}',       
                                DomoprimeQuotation: { 
                                   id : '{$quotation->get('id')}',
                                   products : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };
         $(".DomoprimeQuotationForContract.Input").each(function () { params.DomoprimeQuotation[$(this).attr('name')]=$(this).val(); });                                                          
         $(".DomoprimeQuotationForContract-Products").each(function() { 
                   var item= { product_id: $(this).attr('id'),                               
                               items: [] };   
                   $(".DomoprimeQuotationForContract.Products-"+$(this).attr('id')).each(function () { item[$(this).attr('name')]=$(this).val(); });
                   $(".DomoprimeQuotationForContract.ProductItems-"+$(this).attr('id')+":checked").each(function () { item.items.push($(this).attr('id')); });
                   params.DomoprimeQuotation.products.push(item);
           });        
          //alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveQuotationForContract'])}",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                           errorTarget: ".DomoprimeEnergy-errors",
                           target: "#tab-customer-contracts-quotations-{$contract->get('id')}" }); 
        }); 
</script>   


{else}
    {__('Quotation is invalid.')}        
{/if}    

{else}
    {__('Contract is invalid.')}
{/if}    

