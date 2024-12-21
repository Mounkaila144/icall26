<fieldset class="tab-form">
{messages class="customers-contract-app-domoprime-quotation-contract-errors"}
{if $contract->isLoaded()}
{if $quotation->isLoaded()}
{$quotation->getCustomer()|upper}    
<div>
   <a href="javascript:void(0);" id="DomoprimeQuotationForViewContractView-Save" class="btn btn-default" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="javascript:void(0);" id="DomoprimeQuotationForViewContractView-Cancel" class="btn btn-default">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{__('Reference')}:{$quotation->getReference()}
 <table>
     <tr class="DomoprimeQuotationForViewContract full-with"> 
        <td>
            <div>{$form.dated_at->getError()}</div>
            <div>
            {__('Date')}
            <input type="text" class="DomoprimeQuotationForViewContract Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$quotation->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
            </div>
        </td>
    </tr> 
     {if $form->hasValidator('fixed_prime')}
     <tr>
        <td>  
             <div>{$form.fixed_prime->getError()}</div>
             <div>
                {__('Fixed prime')}{if $form->fixed_prime->getOption('required')}*{/if}
                <input  type="text" class="DomoprimeQuotationForViewContract Fields Input" value="{$quotation->getFormatter()->getFixedPrime()->getText("#.00")}" name="fixed_prime"/>
             </div>
        </td>
    </tr> 
    {/if}  
</table>          

{foreach $form->getProducts() as $product name=products_new} 
    {if not $smarty.foreach.products_new.last}
    <table style="width: 30%;display: inline-block;vertical-align: top;">
    <tr class="DomoprimeQuotationForViewContract-Products full-with" id="{$product->get('id')}"> 
        <td>
            <strong>{$product->get('meta_title')|upper}</strong>
        </td>
    </tr>
    <tr class="full-with">
        <td>  
            {__('Quantity')}
             <input  type="text" class="DomoprimeQuotationForViewContract Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity'],'#.00')}" name="quantity"/>
        </td>
    </tr>    
    <tr class="full-with">
        <td>
             {foreach $product->getProductItems() as $item}
            <div>                
               <input  type="checkbox" class="DomoprimeQuotationForViewContract ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
            </div>
        {/foreach}  
        </td>
    </tr>
    </table>
        {else}
    <table style="width: 38%;display: inline-block;vertical-align: top;">
    <tr class="DomoprimeQuotationForViewContract-Products full-with" id="{$product->get('id')}"> 
        <td>
            <strong>{$product->get('meta_title')|upper}</strong>
        </td>
    </tr>
    <tr class="full-with">
        <td>  
            {__('Quantity')}
             <input  type="text" class="DomoprimeQuotationForViewContract Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity'],'#.00')}" name="quantity"/>
        </td>
    </tr> 
    <tr class="full-with">
        <td>
             {foreach $product->getProductItems() as $item}
            <div>                
               <input  type="checkbox" class="DomoprimeQuotationForViewContract ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
            </div>
        {/foreach}  
        </td>
    </tr>
    </table>
        {/if}
{/foreach}   


<script type="text/javascript">
          $(".DomoprimeQuotationForViewContract.Date").datepicker();
   
          $(".DomoprimeQuotationForViewContract.Fields").click(function () {   $("#DomoprimeQuotationForViewContractView-Save").show();   });
            
 
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForViewContractView-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Contract: '{$contract->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewContract'])}" , 
                            errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",    
                            loading: "#tab-site-dashboard-customers-contract-loading",
                             target: "#quotations-target-{$contract->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       
      $('#DomoprimeQuotationForViewContractView-Save').click(function(){                             
            var  params= {      Contract: '{$contract->get('id')}',       
                                DomoprimeQuotation: { 
                                   id : '{$quotation->get('id')}',
                                   products : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };
         $(".DomoprimeQuotationForViewContract.Input").each(function () { params.DomoprimeQuotation[$(this).attr('name')]=$(this).val(); });                                                           
         $(".DomoprimeQuotationForViewContract-Products").each(function() { 
                   var item= { product_id: $(this).attr('id'),                               
                               items: [] };   
                   $(".DomoprimeQuotationForViewContract.Products-"+$(this).attr('id')).each(function () { item[$(this).attr('name')]=$(this).val(); });
                   $(".DomoprimeQuotationForViewContract.ProductItems-"+$(this).attr('id')+":checked").each(function () { item.items.push($(this).attr('id')); });
                   params.DomoprimeQuotation.products.push(item);
           });        
          //alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveQuotationFromRequestForViewContract'])}",
                            loading: "#tab-site-dashboard-customers-contract-loading",
                           errorTarget: ".customers-contract-app-domoprime-quotation-contract-errors",
                           target: "#quotations-target-{$contract->get('id')}"  }); 
        }); 
</script>   


{else}
    {__('Quotation is invalid.')}        
{/if}    

{else}
    {__('Contract is invalid.')}
{/if}    
</fieldset>




