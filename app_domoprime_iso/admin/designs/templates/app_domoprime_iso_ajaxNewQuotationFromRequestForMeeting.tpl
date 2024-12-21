{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>
   <a href="#" id="DomoprimeQuotationPlusForMeetingNew-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeQuotationPlusForMeetingNew-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
 {if $form->getProducts()->isEmpty()}
     <div> {__('No surface')}</div>
 {else}    
    <table>
        <tr class="DomoprimeQuotationForMeeting"> 
            <td>
                  <div>{$form.dated_at->getError()}</div>
                <div>
                {__('Date')}
                <input type="text" class="DomoprimeQuotationForMeeting Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$quotation->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
                </div>
            </td>
        </tr>   
    {foreach $form->getProducts() as $product}    
        <tr class="DomoprimeQuotationForMeeting-Products" id="{$product->get('id')}"> 
            <td>
                <strong>{$product->get('meta_title')|upper}</strong>
            </td>
        </tr>
        <tr>
            <td>  
                {__('Quantity')}
                 <input  type="text" class="DomoprimeQuotationForMeeting Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity'],"#.0")}" name="quantity"/>
            </td>
        </tr> 
        <tr>
            <td>
                 {foreach $product->getProductItems() as $item}
                <div>                
                   <input  type="checkbox" class="DomoprimeQuotationForMeeting ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
                </div>
            {/foreach}  
            </td>
        </tr>
    {/foreach}
    {/if}
    </table>
<script type="text/javascript">
          $(".DomoprimeQuotationForMeeting.Date").datepicker();
 
          $(".DomoprimeQuotationForMeeting.Fields").click(function () {   $("#DomoprimeQuotationPlusForMeetingNew-Save").show();   });
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationPlusForMeetingNew-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       $('#DomoprimeQuotationPlusForMeetingNew-Save').click(function(){                             
            var  params= {      Meeting: '{$meeting->get('id')}',       
                                DomoprimeQuotation: {                         
                                   products : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };
         $(".DomoprimeQuotationForMeeting.Input").each(function () { params.DomoprimeQuotation[$(this).attr('name')]=$(this).val(); });
         $(".DomoprimeQuotationForMeeting-Products").each(function() { 
                   var item= { product_id: $(this).attr('id'),                               
                               items: [] };                     
                   $(".DomoprimeQuotationForMeeting.Products-"+$(this).attr('id')).each(function () { item[$(this).attr('name')]=$(this).val(); });
                   $(".DomoprimeQuotationForMeeting.ProductItems-"+$(this).attr('id')+":checked").each(function () { item.items.push($(this).attr('id')); });
                   params.DomoprimeQuotation.products.push(item);
           });        
          //alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'NewQuotationFromRequestForMeeting'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           errorTarget: ".DomoprimeEnergy-errors",
                           target: "#tab-customer-meetings-iso-quotations-{$meeting->get('id')}" }); 
        }); 
     
</script>   


{else}
    {__('Meeting is invalid.')}        
{/if}    


