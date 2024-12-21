{messages class="DomoprimeClassRegionPrice-errors"}
{if $class->isLoaded()}
<h3>{__("New price for class [%s]",$class->getI18n()->get('value'))}</h3>
<div>
    <a href="#" id="DomoprimeClassRegionPrice-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeClassRegionPrice-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td class="label">{__('Region')}</td>
        <td>
            <div class="error-form">{$form.region_id->getError()}</div>     
            {html_options class="DomoprimeClassRegionPrice Select" name="region_id" options=$form->region_id->getOption('choices') selected=$item->get('region_id')}
        </td>
    </tr>   
     <tr class="full-with">
        <td class="label">{__('Number of people')}</td>
        <td>
            <div class="error-form">{$form.number_of_people->getError()}</div>     
            <input type="text" class="DomoprimeClassRegionPrice Input" size="10" name="number_of_people" value="{$item->get('number_of_people')}"/>
        </td>
    </tr>
    <tr class="full-with">
        <td class="label">{__('Price')}</td>
        <td>
            <div class="error-form">{$form.price->getError()}</div>     
            <input type="text" class="DomoprimeClassRegionPrice Input" size="10" name="price" value="{$item->get('price')}"/>
        </td>
    </tr>
</table>    
   
  
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeClassRegionPrice").click(function() {  $('#DomoprimeClassRegionPrice-Save').show(); });           
         
    
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeClassRegionPrice-Cancel').click(function(){              
             return $.ajax2({ data: { DomoprimeClass :'{$class->get('id')}' },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialRegionPriceForClass'])}",
                              errorTarget: ".DomoprimeClassRegionPrice-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
       $('#DomoprimeClassRegionPrice-Save').click(function(){                             
            var  params= {       DomoprimeClass :'{$class->get('id')}',      
                                DomoprimeClassRegionPrice: {                                    
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".DomoprimeClassRegionPrice.Input").each(function() {  params.DomoprimeClassRegionPrice[$(this).attr('name')]=$(this).val();  }); 
          $(".DomoprimeClassRegionPrice.Select option:selected").each(function() {  params.DomoprimeClassRegionPrice[$(this).parent().attr('name')]=$(this).val();  }); // Get foreign key                            
          return $.ajax2({ data : params,                            
                           errorTarget: ".DomoprimeClassRegionPrice-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",       
                           url: "{url_to('app_domoprime_ajax',['action'=>'NewRegionPriceForClass'])}",
                           target: "#actions" 
                        }); 
        });  
</script>
{else}
    {__('Product is invalid.')}
{/if}    
