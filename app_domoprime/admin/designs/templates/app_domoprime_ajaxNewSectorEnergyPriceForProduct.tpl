{messages class="DomoprimeSectorEnergyProduct-errors"}
{if $product->isLoaded()}
<h3>{__("New price for product [%s]",$product->get('meta_title'))}</h3>
<div>
    <a href="#" id="DomoprimeSectorEnergyProduct-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeSectorEnergyProduct-Cancel" class="btn">
        <i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form" cellpadding="0" cellspacing="0">
    <tr class="full-with">
        <td class="label">{__('Sector')}</td>
        <td>
            <div class="error-form">{$form.sector_id->getError()}</div>     
            {html_options class="DomoprimeSectorEnergyProduct Select" name="sector_id" options=$form->sector_id->getOption('choices') selected=$item->get('sector_id')}
        </td>
    </tr>
    <tr class="full-with">
        <td class="label">{__('Energy')}</td>
        <td>
            <div class="error-form">{$form.energy_id->getError()}</div>     
            {html_options class="DomoprimeSectorEnergyProduct Select" name="energy_id" options=$form->energy_id->getOption('choices') selected=$item->get('energy_id')}
        </td>
    </tr>
    <tr class="full-with">
        <td class="label">{__('Price')}</td>
        <td>
            <div class="error-form">{$form.price->getError()}</div>     
            <input type="text" class="DomoprimeSectorEnergyProduct Input" size="10" name="price" value="{$item->get('price')}"/>
        </td>
    </tr>
</table>    
   
  
<script type="text/javascript">
    
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeSectorEnergyProduct").click(function() {  $('#DomoprimeSectorEnergyProduct-Save').show(); });           
         
    
     
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeSectorEnergyProduct-Cancel').click(function(){              
             return $.ajax2({ data: { Product :'{$product->get('id')}' },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialSectorEnergyForProduct'])}",
                              errorTarget: ".DomoprimeSectorEnergyProduct-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions"}); 
      });
      
       $('#DomoprimeSectorEnergyProduct-Save').click(function(){                             
            var  params= {      Product :'{$product->get('id')}',      
                                DomoprimeSectorEnergyProduct: {                                    
                                   token :'{$form->getCSRFToken()}'
                                } };        
          $(".DomoprimeSectorEnergyProduct.Input").each(function() {  params.DomoprimeSectorEnergyProduct[$(this).attr('name')]=$(this).val();  }); 
          $(".DomoprimeSectorEnergyProduct.Select option:selected").each(function() {  params.DomoprimeSectorEnergyProduct[$(this).parent().attr('name')]=$(this).val();  }); // Get foreign key                            
          return $.ajax2({ data : params,                            
                           errorTarget: ".DomoprimeSectorEnergyProduct-errors",
                           loading: "#tab-site-dashboard-x-settings-loading",       
                           url: "{url_to('app_domoprime_ajax',['action'=>'NewSectorEnergyPriceForProduct'])}",
                           target: "#actions" 
                        }); 
        });  
</script>
{else}
    {__('Product is invalid.')}
{/if}    