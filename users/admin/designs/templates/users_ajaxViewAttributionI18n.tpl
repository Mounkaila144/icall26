{messages class="UserAttribution-errors"}
<h3>{__("View Attribution")|capitalize}</h3>
<div>
    <a href="#" id="UserAttribution-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="UserAttribution-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
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
            <div id="UserAttribution-error_value">{$form.attribution.name->getError()}</div>
            <input type="text" size="48" class="UserAttribution" name="name" value="{$item->get('name')}"/>    
            {if $form->attribution.name->getOption('required')}*{/if} 
         </td>
    </tr>       
    <tr>
         <td><span>{__("attribution")}</span></td>
         <td>
            <div id="UserAttribution-error_value">{$form.attribution_i18n.value->getError()}</div>
            <input type="text" size="48" class="UserAttributionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->attribution_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>


<script type="text/javascript">
          
     {* =================== F I E L D S ================================ *}
         
     $(".UserAttribution,.UserAttributionI18n").click(function() {  $('#UserAttribution-Save').show(); });    
        
    
     {* =================== A C T I O N S ================================ *}
     $('#UserAttribution-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('UsersAttributionFormFilter')}" } },                              
                              url : "{url_to('users_ajax',['action'=>'ListPartialAttribution'])}",
                              errorTarget: ".UserAttribution-errors",
                              loading: "#tab-site-dashboard-x-settings-loading",                         
                              target: "#actions" }); 
      });
      
      $('#UserAttribution-Save').click(function(){                             
            var  params= {            
                                UserAttributionI18n: { 
                                   attribution : { },
                                   attribution_i18n : { lang: "{$item->get('lang')}",attribution_id: "{$item->get('attribution_id')}"    },                                 
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.UserAttributionI18n").each(function() { params.UserAttributionI18n.attribution_i18n[this.name]=$(this).val(); });  
          $("input.UserAttribution").each(function() { params.UserAttributionI18n.attribution[this.name]=$(this).val(); });  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".UserAttribution-errors",
                           url: "{url_to('users_ajax',['action'=>'SaveAttributionI18n'])}",
                           target: "#actions" }); 
        });  
     
</script>