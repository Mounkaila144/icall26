{messages class="{$site->getSiteID()}-UserAttribution-errors"}
<h3>{__("View Attribution")|capitalize}</h3>
<div>
    <a href="#" id="{$site->getSiteID()}-UserAttribution-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="{$site->getSiteID()}-UserAttribution-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
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
            <div id="UserAttribution-error_value">{$form.attribution.name->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserAttribution" name="name" value="{$item->get('name')}"/>    
            {if $form->attribution.name->getOption('required')}*{/if} 
         </td>
    </tr>       
    <tr>
         <td><span>{__("attribution")}</span></td>
         <td>
            <div id="UserAttribution-error_value">{$form.attribution_i18n.value->getError()}</div>
            <input type="text" size="48" class="{$site->getSiteID()}-UserAttributionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->attribution_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>


<script type="text/javascript">
          
     {* =================== F I E L D S ================================ *}
     $(".{$site->getSiteID()}-UserAttribution,.{$site->getSiteID()}-UserAttributionI18n").click(function() {  $('#{$site->getSiteID()}-UserAttribution-Save').show(); });    
        
    
     {* =================== A C T I O N S ================================ *}
     $('#{$site->getSiteID()}-UserAttribution-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('UsersAttributionFormFilter')}" } },                              
                              url : "{url_to('users_site_ajax',['action'=>'ListPartialAttribution'])}",
                              errorTarget: ".{$site->getSiteID()}-UserAttribution-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#{$site->getSiteID()}-UserAttribution-Save').click(function(){                             
            var  params= {            
                                UserAttributionI18n: { 
                                   attribution : { },
                                   attribution_i18n : { lang: "{$item->get('lang')}",attribution_id: "{$item->get('attribution_id')}"    },                                 
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.{$site->getSiteID()}-UserAttributionI18n").each(function() { params.UserAttributionI18n.attribution_i18n[this.name]=$(this).val(); });  
          $("input.{$site->getSiteID()}-UserAttribution").each(function() { params.UserAttributionI18n.attribution[this.name]=$(this).val(); });  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,                            
                           errorTarget: ".{$site->getSiteID()}-UserAttribution-errors",
                           url: "{url_to('users_site_ajax',['action'=>'SaveAttributionI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>