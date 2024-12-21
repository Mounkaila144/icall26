{messages class="{$site->getSiteID()}-CustomerUnion-errors"}
<h3>{__("View union")|capitalize}</h3>
<div>
    <a href="#" id="CustomerUnion-Save" style="display:none"><img  src="{url('/icons/save.gif','picture')}" alt="{__('save')}"/>{__('save')}</a>
    <a href="#" id="CustomerUnion-Cancel"><img  src="{url('/icons/cancel.gif','picture')}" alt="{__('cancel')}"/>{__('cancel')}</a>
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
        <td><span>{__("name")}</span>
        </td>
        <td><div id="CustomerUnion-error_name">{$form.union.name->getError()}</div>  
            <input type="text" class="CustomerUnion" name="name" size="48" value="{$item->getCustomerUnion()->get('name')}"/> 
        </td>
    </tr>            
    <tr>
         <td><span>{__("value")}</span></td>
         <td>
            <div id="CustomerUnion-error_value">{$form.union_i18n.value->getError()}</div>
            <input type="text" size="10" class="CustomerUnionI18n" name="value" value="{$item->get('value')}"/>    
            {if $form->union_i18n.value->getOption('required')}*{/if} 
         </td>
    </tr>   
</table>
<script type="text/javascript">     
     
     {* =================== F I E L D S ================================ *}
     $(".CustomerUnion,.CustomerUnionI18n").click(function() {  $('#CustomerUnion-Save').show(); });    
    
     {* =================== A C T I O N S ================================ *}
     $('#CustomerUnion-Cancel').click(function(){                           
             return $.ajax2({ data: { filter: { lang:"{$item->get('lang')}", token: "{mfForm::getToken('CustomersUnionFormFilter')}" } },                              
                              url : "{url_to('customers_ajax',['action'=>'ListPartialUnion'])}",
                              errorTarget: ".{$site->getSiteID()}-CustomerUnion-errors",
                              loading: "#tab-site-{$site->getSiteID()}-dashboard-site-x-settings-loading",                         
                              target: "#{$site->getSiteID()}-actions" }); 
      });
      
      $('#CustomerUnion-Save').click(function(){                             
            var  params= {            
                                CustomerUnionI18n: { 
                                   union_i18n : { lang: "{$item->get('lang')}",union_id: "{$item->get('union_id')}"    },
                                   union : { },
                                   token :'{$form->getCSRFToken()}'
                                } };
          $("input.CustomerUnionI18n").each(function() { params.CustomerUnionI18n.union_i18n[this.name]=$(this).val(); });
          $("input.CustomerUnion").each(function() {  params.CustomerUnionI18n.union[this.name]=$(this).val();  });  // Get foreign key  
          //    alert("Params="+params.toSource());   return ;       
          return $.ajax2({ data : params,  
                           files: ".CustomerUnion-files",
                           errorTarget: ".{$site->getSiteID()}-CustomerUnion-errors",
                           url: "{url_to('customers_ajax',['action'=>'SaveUnionI18n'])}",
                           target: "#{$site->getSiteID()}-actions" }); 
        });  
     
</script>