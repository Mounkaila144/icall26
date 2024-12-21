{messages class="DomoprimeClass-errors"}
<h3>{__("View class")}</h3>
<div>
    <a href="#" id="DomoprimeClass-Save" class="btn" style="display:none">
        <i class="fa fa-floppy-o" style="color:#000; margin-right:10px;"></i>{__('Save')}</a>
    <a href="#" id="DomoprimeClass-Cancel" class="btn"><i class="fa fa-times" style="color:#000;margin-right:10px;"></i>
        {__('Cancel')}</a>
</div>
{if $item_i18n->getClass()->isLoaded()}
<table class="tab-form">

    <tr>
        <td></td>
        <td><img id="{$item_i18n->get('lang')}" name="lang" src="{url("/flags/`$item_i18n->get('lang')`.png","picture")}" title="{format_country($item_i18n->get('lang'))}" />       
        </td>
    </tr>
     <tr class="full-with">
         <td class="label"><span>{__("Name")}</span>
        </td>
        <td><div id="DomoprimeClass-error_name" class="error-form">{$form.class.name->getError()}</div>  
            <input type="text" class="DomoprimeClass" name="name" size="48" value="{$item_i18n->getClass()->get('name')}"/> 
        </td>
    </tr>            
    <tr class="full-with">
         <td class="label"><span>{__("Value")}</span></td>
         <td>
            <div id="DomoprimeClass-error_value" class="error-form">{$form.class_i18n.value->getError()}</div>
            <input type="text" size="40" class="DomoprimeClassI18n" name="value" value="{$item_i18n->get('value')}"/>    
            {if $form->class_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
     <tr class="full-with">
        <td class="label"><span>{__("Coef")}</span></td>
        <td>
            <div class="error-form">{$form.class.coef->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="coef" value="{$item_i18n->getClass()->get('coef')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple" value="{$item_i18n->getClass()->get('multiple')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple floor")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple_floor->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple_floor" value="{$item_i18n->getClass()->get('multiple_floor')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple top")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple_top->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple_top" value="{$item_i18n->getClass()->get('multiple_top')}"/> 
        </td>
    </tr>
     <tr class="full-with">
        <td class="label"><span>{__("Multiple wall")}</span></td>
        <td>
            <div class="error-form">{$form.class.multiple_wall->getError()}</div>               
             <input type="text" size="20" class="DomoprimeClass" name="multiple_wall" value="{$item_i18n->getClass()->get('multiple_wall')}"/> 
        </td>
    </tr>
</table>
  {else}
      {__('Class is invalid.')}
{/if}
<script type="text/javascript">
    
       
     
     {* =================== F I E L D S ================================ *}
     $(".DomoprimeClass,.DomoprimeClassI18n").click(function() {  $('#DomoprimeClass-Save').show(); });    
    
    
    
     {* =================== A C T I O N S ================================ *}
     $('#DomoprimeClass-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item_i18n->get('lang')}", token: "{mfForm::getToken('DomoprimeClassFormFilter')}" } },                              
                              url : "{url_to('app_domoprime_ajax',['action'=>'ListPartialClass'])}",
                              errorTarget: ".DomoprimeClass-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#DomoprimeClass-Save').click(function(){                             
            var  params= {            
                                DomoprimeClassI18n: { 
                                   class_i18n : { lang: "{$item_i18n->get('lang')}",class_id: "{$item_i18n->get('class_id')}"    },
                                   class : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.DomoprimeClassI18n").each(function() { params.DomoprimeClassI18n.class_i18n[this.name]=$(this).val(); });
          $("input.DomoprimeClass").each(function() {  params.DomoprimeClassI18n.class[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                           
                           errorTarget: ".DomoprimeClass-errors",
                           url: "{url_to('app_domoprime_ajax',['action'=>'SaveClassI18n'])}",
                           target: "#actions" }); 
        });  
     
</script>

    
    