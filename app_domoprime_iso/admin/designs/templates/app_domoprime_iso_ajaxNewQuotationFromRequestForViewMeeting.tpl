{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $meeting->isLoaded()}
    <h3>{__('New quotation')}</h3>
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
        <tr class="DomoprimeQuotationForMeeting" style="width: 100%;"> 
            <td>
                  <div>{$form.dated_at->getError()}</div>
                <div>
                {__('Date')}
                <input type="text" class="DomoprimeQuotationForMeeting Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$quotation->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
                </div>
            </td>
        </tr>
    </table>
                
        {if $form->getProducts()->isEmpty()}
        <table>
         <tr style="width: 100%;"> 
            <td>
                {__('No surface')}
            </td>
        </tr>
         </table>
        {else}    
    {foreach $form->getProducts() as $product name=meeting_products_niew}  
        {if not $smarty.foreach.meeting_products_niew.last}
         <table style="width: 30%;display: inline-block;vertical-align: top;"> 
        <tr class="DomoprimeQuotationForMeeting-Products" style="width: 100%;" id="{$product->get('id')}"> 
            <td>
                <strong>{$product->get('meta_title')|upper}</strong>
            </td>
        </tr>
        <tr class="" style="width: 100%;">
            <td>  
                {__('Quantity')}
                 <input  type="text" class="DomoprimeQuotationForMeeting Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity']->getValue(),"#.0")}" name="quantity"/>
            </td>
        </tr> 
        <tr class="" style="width: 100%;">
            <td>
                 {foreach $product->getProductItems() as $item}
                <div>                
                   <input  type="checkbox" class="DomoprimeQuotationForMeeting ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
                </div>
            {/foreach}  
            </td>
        </tr>
         </table>
        {else}
        <table style="width: 38%;display: inline-block;vertical-align: top;"> 
        <tr class="DomoprimeQuotationForMeeting-Products " style="width: 100%;" id="{$product->get('id')}"> 
            <td>
                <strong>{$product->get('meta_title')|upper}</strong>
            </td>
        </tr>
        <tr class="" style="width: 100%;">
            <td>  
                {__('Quantity')}
                 <input  type="text" class="DomoprimeQuotationForMeeting Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity']->getValue(),"#.0")}" name="quantity"/>
            </td>
        </tr> 
        <tr class="" style="width: 100%;">
            <td>
                 {foreach $product->getProductItems() as $item}
                <div>                
                   <input  type="checkbox" class="DomoprimeQuotationForMeeting ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
                </div>
            {/foreach}  
            </td>
        </tr>
         </table>
        {/if}
    {/foreach}
    {/if}
    </table>
{/if}
<script type="text/javascript">
          $(".DomoprimeQuotationForMeeting.Date").datepicker();
 
          $(".DomoprimeQuotationForMeeting.Fields").click(function () {   $("#DomoprimeQuotationPlusForMeetingNew-Save").show();   });
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationPlusForMeetingNew-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#quotations-target-{$meeting->get('id')}" 
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
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'NewQuotationFromRequestForViewMeeting'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           errorTarget: ".DomoprimeEnergy-errors",
                            target: "#quotations-target-{$meeting->get('id')}"  }); 
        }); 
     
</script>   


{else}
    {__('Meeting is invalid.')}        
{/if}    



