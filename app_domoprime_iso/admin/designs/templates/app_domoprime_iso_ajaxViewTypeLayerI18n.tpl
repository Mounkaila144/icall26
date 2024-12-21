{messages class="DomoprimeTypeLayer-errors"}
<h3>{__("View type layer")}</h3>
<div>
    <a href="#" id="DomoprimeTypeLayer-Save" class="btn"><i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeTypeLayer-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>{__('Cancel')}</a>
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
        <td><div id="DomoprimeTypeLayer-error_name" class="error-form">{$form.type.name->getError()}</div>  
            <input type="text" class="DomoprimeTypeLayer" name="name" size="48" value="{$item_i18n->getType()->get('name')}"/> 
        </td>
    </tr>       
    <tr>
         <td class="label"><span>{__("Value")}</span></td>
         <td>
            <div id="DomoprimeTypeLayer-error_value" class="error-form">{$form.type_i18n.value->getError()}</div>
            <input type="text" class="DomoprimeTypeLayerI18n" name="value" size="40" value="{$item_i18n->get('value')}"/>    
            {if $form->type_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>
<script type="text/javascript">         
     
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeTypeLayer,.DomoprimeTypeLayerI18n").click(function() {  $('#DomoprimeTypeLayer-Save').show(); });            
    
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeTypeLayer-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item_i18n->get('lang')}", token: "{mfForm::getToken('DomoprimeTypeLayerFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_iso_ajax',['action'=>'ListPartialTypeLayer'])}",
                              errorTarget: ".DomoprimeTypeLayer-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#DomoprimeTypeLayer-Save').click(function(){                             
            var  params= {            
                                DomoprimeTypeLayerI18n: { 
                                   type_i18n : { lang: "{$item_i18n->get('lang')}",type_id: "{$item_i18n->get('type_id')}"    },
                                   type : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeTypeLayerI18n").each(function() { params.DomoprimeTypeLayerI18n.type_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeTypeLayer").each(function() {  params.DomoprimeTypeLayerI18n.type[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".DomoprimeTypeLayer-errors",
                           url: "{url_to('app_domoprime_iso_ajax',['action'=>'SaveTypeLayerI18n'])}",
                           target: "#actions" }); 
        });  
     
</script>
