{messages class="UserFunction-errors"}
<h3>{__("View Function")|capitalize}</h3>
<div>
    <a href="#" id="UserFunction-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="UserFunction-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table>
  {*  <tr>
        <td>{__('id')}</td>
        <td>{if $item->isLoaded()} 
            <span>{$item->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr> *}
    <tr>
        <td></td>
        <td><img id="{$item->get('lang')}" name="lang" src="{url("/flags/`$item->get('lang')`.png","picture")}" title="{format_country($item->get('lang'))}" />       
        </td>
    </tr>
    <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div id="UserFunction-error_value">{$form.function.name->getError()}</div>
            <input type="text" size="48" class="UserFunction" name="name" value="{$item->get('name')}"/>    
            {if $form->function.name->getOption('required')}*{/if} 
         </td>
    </tr>       
    <tr>
         <td><span>{__("function")}</span></td>
         <td>
            <div id="UserFunction-error_value">{$form.function_i18n.value->getError()}</div>
            <input type="text" size="48" class="UserFunctionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->function_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>


<script type="text/javascript">
          
     {* =================== F I E L D S ================================ *}
     $(".UserFunction,.UserFunctionI18n").click(function() {  $('#UserFunction-Save').show(); });    
        
    
     {* =================== A C T I O N S ================================ *}
     $('#UserFunction-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('UsersFunctionFormFilter')}" } },                              
                              url : "{url_to('users_ajax',['action'=>'ListPartialFunction'])}",
                              errorTarget: ".UserFunction-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#UserFunction-Save').click(function(){                             
            var  params= {            
                                UserFunctionI18n: { 
                                   function : { },
                                   function_i18n : { lang: "{$item->get('lang')}",function_id: "{$item->get('function_id')}"    },                                 
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserFunctionI18n").each(function() { params.UserFunctionI18n.function_i18n[this.name]=$(this).val(); });  
          $("input.UserFunction").each(function() { params.UserFunctionI18n.function[this.name]=$(this).val(); });  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".UserFunction-errors",
                           url: "{url_to('users_ajax',['action'=>'SaveFunctionI18n'])}",
                           target: "#actions" }); 
        });  
     
</script>