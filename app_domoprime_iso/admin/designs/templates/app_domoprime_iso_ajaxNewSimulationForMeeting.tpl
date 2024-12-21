{messages class="customers-meeting-app-domoprime-simulation-meeting-errors"}
{if $meeting->isLoaded()}
{$meeting->getCustomer()|upper}    
<div>
   <a href="#" id="DomoprimeSimulationForMeetingNew-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeSimulationForMeetingNew-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table>
    <tr class="DomoprimeSimulationForMeeting"> 
        <td>
              <div>{$form.dated_at->getError()}</div>
            <div>
            {__('Date')}
            <input type="text" class="DomoprimeSimulationForMeeting Fields Date Input" name="dated_at" value="{if $form->hasErrors()}{$form.dated_at}{else}{$simulation->getFormatter()->getDatedAt()->getFormatted()}{/if}"/>
            </div>
        </td>
    </tr>
    {if $form->getProducts()->isEmpty()}
     <tr> 
        <td>
            {__('No surface')}
        </td>
    </tr>
    {else}    
{foreach $form->getProducts() as $product}    
    <tr class="DomoprimeSimulationForMeeting-Products" id="{$product->get('id')}"> 
        <td>
            <strong>{$product->get('meta_title')|upper}</strong>
        </td>
    </tr>
    <tr>
        <td>  
            {__('Quantity')}
             <input  type="text" class="DomoprimeSimulationForMeeting Products-{$product->get('id')} Fields" value="{$form.products[$product@index]['quantity']}" name="quantity"/>
        </td>
    </tr> 
    <tr>
        <td>
             {foreach $product->getProductItems() as $item}
            <div>                
               <input  type="checkbox" class="DomoprimeSimulationForMeeting ProductItems-{$product->get('id')} Fields" name="{$product->get('id')}"  id="{$item->get('id')}" {if $form->isChecked($product,$item)}checked=""{/if}/>{$item->get('reference')}
            </div>
        {/foreach}  
        </td>
    </tr>
{/foreach}
{/if}
</table>
<script type="text/javascript">
          $(".DomoprimeSimulationForMeeting.Date").datepicker();
 
          $(".DomoprimeSimulationForMeeting.Fields").click(function () {   $("#DomoprimeSimulationForMeetingNew-Save").show();   });
            
          {* =====================  P A G E R  A C T I O N S =============================== *}  
      
           $("#DomoprimeSimulationForMeetingNew-Cancel").click(function() {                  
               return $.ajax2({                     
                            data : { Meeting: '{$meeting->get('id')}' },
                            url:"{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialSimulationForMeeting'])}" , 
                            errorTarget: ".customers-meeting-app-domoprime-simulation-meeting-errors",    
                            loading: "#tab-site-dashboard-customers-meeting-loading",
                            target: "#tab-customer-meetings-simulations-{$meeting->get('id')}" 
                         }); 
           });
    
       
          {* =====================  A C T I O N S =============================== *}  
      
       $('#DomoprimeSimulationForMeetingNew-Save').click(function(){                             
            var  params= {      Meeting: '{$meeting->get('id')}',       
                                DomoprimeSimulation: {                         
                                   products : [ ],
                                   token :'{$form->getCSRFToken()}'
                                } };
         $(".DomoprimeSimulationForMeeting.Input").each(function () { params.DomoprimeSimulation[$(this).attr('name')]=$(this).val(); });
         $(".DomoprimeSimulationForMeeting-Products").each(function() { 
                   var item= { product_id: $(this).attr('id'),                               
                               items: [] };                     
                   $(".DomoprimeSimulationForMeeting.Products-"+$(this).attr('id')).each(function () { item[$(this).attr('name')]=$(this).val(); });
                   $(".DomoprimeSimulationForMeeting.ProductItems-"+$(this).attr('id')+":checked").each(function () { item.items.push($(this).attr('id')); });
                   params.DomoprimeSimulation.products.push(item);
           });        
          //alert("Params="+params.toSource());   return ;        
          return $.ajax2({ data : params,                          
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'NewSimulationForMeeting'])}",
                           loading: "#tab-site-dashboard-x-settings-loading",
                           errorTarget: ".DomoprimeEnergy-errors",
                           target: "#tab-customer-meetings-simulations-{$meeting->get('id')}" }); 
        }); 
     
</script>   


{else}
    {__('Meeting is invalid.')}        
{/if}    

