{messages class="DomoprimeEnergy-errors"}
<h3>{__("View energy")}</h3>
<div>
    <a href="#" id="DomoprimeEnergy-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeEnergy-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {__('Cancel')}</a>
</div>
{if $item_i18n->getEnergy()->isLoaded()}
<table class="tab-form">

    <tr>
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
     <tr class="full-with">
         <td class="label"><span>{__("Name")}</span>
        </td>
        <td><div id="DomoprimeEnergy-error_name" class="error-form">{$form.energy.name->getError()}</div>  
            <input type="text" class="DomoprimeEnergy" name="name" size="48" value="{$item_i18n->getEnergy()->get('name')}"/> 
        </td>
    </tr>            
    <tr class="full-with">
         <td class="label"><span>{__("Value")}</span></td>
         <td>
            <div id="DomoprimeEnergy-error_value" class="error-form">{$form.energy_i18n.value->getError()}</div>
            <input type="text" size="40" class="DomoprimeEnergyI18n" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->energy_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>
  {else}
      {__('Energy is invalid.')}
{/if}
<script type="text/javascript">
    
       
     
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeEnergy,.DomoprimeEnergyI18n").click(function() {  $('#DomoprimeEnergy-Save').show(); });    
    
    
    
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeEnergy-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item_i18n->get('lang')}", token: "{mfForm::getToken('DomoprimeEnergyFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialEnergy'])}",
                              errorTarget: ".DomoprimeEnergy-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#DomoprimeEnergy-Save').click(function(){                             
            var  params= {            
                                DomoprimeEnergyI18n: { 
                                   energy_i18n : { lang: "{$item_i18n->get('lang')}",energy_id: "{$item_i18n->get('energy_id')}"    },
                                   energy : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeEnergyI18n").each(function() { params.DomoprimeEnergyI18n.energy_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeEnergy").each(function() {  params.DomoprimeEnergyI18n.energy[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                           
                           errorTarget: ".DomoprimeEnergy-errors",
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveEnergyI18n'])}",
                           target: "#actions" }); 
        });  
     
</script>

    
    