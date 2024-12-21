<fieldset>
{messages class="customers-meeting-app-domoprime-quotation-meeting-errors"}
{if $meeting->isLoaded()}
{if $quotation->isLoaded()}
    <h3>{__('View quotation')} </h3>
<div>
   <a href="javascript:void(0);" id="DomoprimeQuotationForViewMeetingView-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="javascript:void(0);" id="DomoprimeQuotationForViewMeetingView-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
{__('Reference')}:{$quotation->getReference()}
 <table>
     <tr class="DomoprimeQuotationForViewMeeting" style="width: 100%;"> 
        <td>
            <div>{$form.dated_at->getError()}</div>
            <div>
            {__('Date')}
            <input type="text" class="DomoprimeQuotationForViewMeeting Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$quotation->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
            </div>
        </td>
    </tr>
    </table>
{foreach $form->getProducts() as $product name=meeting_products_view}  
        {if not $smarty.foreach.meeting_products_view.last}
            <table style="width: 30%;display: inline-block;vertical-align: top;"> 
    <tr class="DomoprimeQuotationForViewMeeting-Products" id="{$product->get('id')}" style="width: 100%;"> 
        <td>
            <strong>{$product->get('meta_title')|upper}</strong>
        </td>
    </tr>
    <tr style="width: 100%;">
        <td>  
            {__('Quantity')}
             <input  type="text" class="DomoprimeQuotationForViewMeeting Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity'],'#.00')}" name="quantity"/>
        </td>
    </tr> 
    <tr style="width: 100%;">
        <td>
             {foreach $product->getProductItems() as $item}
            <div>                
               <input  type="checkbox" class="DomoprimeQuotationForViewMeeting ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
            </div>
        {/foreach}  
        </td>
    </tr>
    </table>
    {else}
     <table style="width: 38%;display: inline-block;vertical-align: top;"> 
         <tr class="DomoprimeQuotationForViewMeeting-Products" style="width: 100%;" id="{$product->get('id')}"> 
        <td>
            <strong>{$product->get('meta_title')|upper}</strong>
        </td>
    </tr>
    <tr style="width: 100%;">
        <td>  
            {__('Quantity')}
             <input  type="text" class="DomoprimeQuotationForViewMeeting Products-{$product->get('id')} Fields" value="{format_number((string)$form.products[$product@index]['quantity'],'#.00')}" name="quantity"/>
        </td>
    </tr> 
    <tr style="width: 100%;">
        <td>
             {foreach $product->getProductItems() as $item}
            <div>                
               <input  type="checkbox" class="DomoprimeQuotationForViewMeeting ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
            </div>
        {/foreach}  
        </td>
    </tr>
    </table>
    {/if}
{/foreach}    
</table>

<script type="text/javascript">
          $(".DomoprimeQuotationForViewMeeting.Date").datepicker();
   
          $(".DomoprimeQuotationForViewMeeting.Fields").click(function () {   $("#DomoprimeQuotationForViewMeetingView-Save").show();   });
            
 
         
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeQuotationForViewMeetingView-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialQuotationFromRequestForViewMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                             target: "#quotations-target-{$meeting->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       
      $('#DomoprimeQuotationForViewMeetingView-Save').click(function(){                             
            var  params= {      Meeting: '{$meeting->get('id')}',       
                                DomoprimeQuotation: { 
                                   id : '{$quotation->get('id')}',
                                   products : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };
         $(".DomoprimeQuotationForViewMeeting.Input").each(function () { params.DomoprimeQuotation[$(this).attr('name')]=$(this).val(); });                                                           
         $(".DomoprimeQuotationForViewMeeting-Products").each(function() { 
                   var item= { product_id: $(this).attr('id'),                               
                               items: [] };   
                   $(".DomoprimeQuotationForViewMeeting.Products-"+$(this).attr('id')).each(function () { item[$(this).attr('name')]=$(this).val(); });
                   $(".DomoprimeQuotationForViewMeeting.ProductItems-"+$(this).attr('id')+":checked").each(function () { item.items.push($(this).attr('id')); });
                   params.DomoprimeQuotation.products.push(item);
           });        
          //alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveQuotationFromRequestForViewMeeting'])}",
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                           errorTarget: ".customers-meeting-app-domoprime-quotation-meeting-errors",
                           target: "#quotations-target-{$meeting->get('id')}"  }); 
        }); 
</script>   


{else}
    {__('Quotation is invalid.')}        
{/if}    

{else}
    {__('Meeting is invalid.')}
{/if}    
</fieldset>




