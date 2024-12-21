{messages class="DomoprimeOccupation-errors"}
<h3>{__("View occupation")}</h3>
<div>
    <a href="#" id="DomoprimeOccupation-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeOccupation-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
</div>
<table class="tab-form">
    <tr>
        <td class="label">{__('id')}</td>
        <td>{if $item_i18n->isLoaded()} 
            <span>{$item_i18n->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr>
    <tr>
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
     <tr>
        <td class="label"><span>{__("Name")}</span>
        </td>
        <td><div id="DomoprimeOccupation-error_name" class="error-form">{$form.occupation.name->getError()}</div>  
            <input type="text" class="DomoprimeOccupation" name="name" size="48" value="{$item_i18n->getOccupation()->get('name')}"/> 
        </td>
    </tr>       
    <tr>
         <td class="label"><span>{__("Value")}</span></td>
         <td>
            <div id="DomoprimeOccupation-error_value" class="error-form">{$form.occupation_i18n.value->getError()}</div>
            <input type="text" class="DomoprimeOccupationI18n" name="value" size="40" value="{$item_i18n->get('value')}"/>    
            {if $form->occupation_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>
<script type="text/javascript">         
     
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeOccupation,.DomoprimeOccupationI18n").click(function() {  $('#DomoprimeOccupation-Save').show(); });            
    
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeOccupation-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item_i18n->get('lang')}", token: "{mfForm::getToken('DomoprimeOccupationFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialOccupation'])}",
                              errorTarget: ".DomoprimeOccupation-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#DomoprimeOccupation-Save').click(function(){                             
            var  params= {            
                                DomoprimeOccupationI18n: { 
                                   occupation_i18n : { lang: "{$item_i18n->get('lang')}",occupation_id: "{$item_i18n->get('occupation_id')}"    },
                                   occupation : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeOccupationI18n").each(function() { params.DomoprimeOccupationI18n.occupation_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeOccupation").each(function() {  params.DomoprimeOccupationI18n.occupation[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".DomoprimeOccupation-errors",
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveOccupationI18n'])}",
                           target: "#actions" }); 
        });  
     
</script>

