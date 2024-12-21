{messages class="{$site->getSiteID()}-UserFunction-errors"}
<h3>{__("View Function")|capitalize}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-UserFunction-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-UserFunction-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
</div>
<table>
    <tr>
        <td>{__('id')}</td>
        <td>{if $item->isLoaded()} 
            <span>{$item->get('id')}</span>  
            {else}
             <span>{__('New')}</span>  
            {/if} 
        </td>
    </tr>
    <tr>
        <td></td>
        <td><img id="{$item->get('lang')}" name="lang" src="{url("/flags/`$item->get('lang')`.png","picture")}" title="{format_country($item->get('lang'))}" />       
        </td>
    </tr>
    <tr>
         <td><span>{__("name")}</span></td>
         <td>
            <div id="UserFunction-error_value">{$form.function.name->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserFunction" name="name" value="{$item->getUserFunction()->get('name')}"/>    
            {if $form->function.name->getOption('required')}*{/if} 
         </td>
    </tr>       
    <tr>
         <td><span>{__("function")}</span></td>
         <td>
            <div id="UserFunction-error_value">{$form.function_i18n.value->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserFunctionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->function_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>


<script type="text/javascript">
          
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-UserFunction,.{$site->getSiteID()}-UserFunctionI18n").click(function() {  $('#{$site->getSiteID()}-UserFunction-Save').show(); });    
        
    
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-UserFunction-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('UsersFunctionFormFilter')}" } },                              
                              url : "{url_to('users_site_ajax',['action'=>'ListPartialFunction'])}",
                              errorTarget: ".{$site->getSiteID()}-UserFunction-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#{$site->getSiteID()}-UserFunction-Save').click(function(){                             
            var  params= {            
                                UserFunctionI18n: { 
                                   function : { },
                                   function_i18n : { lang: "{$item->get('lang')}",function_id: "{$item->get('function_id')}"    },                                 
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-UserFunctionI18n").each(function() { params.UserFunctionI18n.function_i18n[this.name]=$(this).val(); });  
          $("input.{$site->getSiteID()}-UserFunction").each(function() { params.UserFunctionI18n.function[this.name]=$(this).val(); });  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-UserFunction-errors",
                           url: "{url_to('users_site_ajax',['action'=>'SaveFunctionI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>